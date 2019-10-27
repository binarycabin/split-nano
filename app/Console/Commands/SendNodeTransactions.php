<?php

namespace App\Console\Commands;

use App\NodeTransaction;
use App\Services\Nano\Nano;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendNodeTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:send-node-transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send queued node transactions to the network';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nano = new Nano();
        $unprocessedNodeTransactions = NodeTransaction::whereNull('hash')->get();
        Log::info('Found ' . $unprocessedNodeTransactions->count() . ' to process...');
        foreach ($unprocessedNodeTransactions as $unprocessedNodeTransaction) {
            $account = $unprocessedNodeTransaction->account;
            Log::info($unprocessedNodeTransaction->uuid);

            $accountInfoResponse = $nano->call('account_info', [
                'account' => $account->address,
            ]);

            Log::info(json_encode($accountInfoResponse));

            if (empty($accountInfoResponse->error)) {

                //See if we can send it (previous hash has not been used by another Node Transaction)
                //This is needed in case the Node is not caught up yet
                $frontierUsed = NodeTransaction::where('hash', $accountInfoResponse->frontier)->first();

                Log::info('History');
                $accountHistory = $nano->call('account_history', [
                    'account' => $account->address,
                    'count' => 1,
                ]);

                Log::info(json_encode($accountHistory));

                //$this->info('FrontierUsed:');
                //dump($frontierUsed);
                //if (!$frontierUsed) {
                    $amount = $unprocessedNodeTransaction->amount;
                    $destinationAddress = $unprocessedNodeTransaction->destination_address;

                    Log::info('Send ' . $amount . ' To: ' . $destinationAddress);


                    $destinationAccountHistory = $nano->call('account_history', [
                        'account' => $destinationAddress,
                        'count' => 1,
                    ]);

                    Log::info(json_encode($destinationAccountHistory));

                    if (!empty($accountHistory->history[0])) {
                        $previous = $accountHistory->history[0]->hash;
                    } else {
                        $previous = $accountHistory->previous;
                    }

                    Log::info('Previous: '.$previous);

                    $representative = config('split.nano.representative');
                    Log::info('Rep: '.$representative);


                    /*
                    $workResponse = $nano->call('work_generate', [
                        'hash' => $accountInfoResponse->frontier,
                        //'difficulty' => 'ffffffd21c3933f3',
                    ]);
                    dump($workResponse);
                    */

                    $newBalance = $accountInfoResponse->balance - $amount;
                    $newBalanceString = sprintf('%.0f', $newBalance);

                    $blockCreateResponse = $nano->call('block_create', [
                        "json_block" => "true",
                        'type' => 'state',
                        'previous' => $previous,
                        //'account' => $destinationAddress,
                        'representative' => $representative,
                        'balance' => $newBalanceString,
                        'link' => $destinationAddress,
                        'key' => $account->secret_key,
                    ]);

                    Log::info(json_encode($blockCreateResponse));
                    if(!empty($blockCreateResponse->block)){
                        $processResponse = $nano->call('process', [
                            "json_block" => "true",
                            'block' => $blockCreateResponse->block,
                        ]);

                        Log::info(json_encode($processResponse));

                        if (empty($processResponse->error) && !empty($processResponse->hash)) {
                            $unprocessedNodeTransaction->hash = $processResponse->hash;
                            $unprocessedNodeTransaction->save();
                            Log::info('HASH SAVED!');
                        }

                    }


                //}
            }
        }
    }
}
