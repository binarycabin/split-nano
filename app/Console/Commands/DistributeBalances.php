<?php

namespace App\Console\Commands;

use App\AddressGroup;
use App\NodeTransaction;
use App\Services\Nano\Nano;
use Illuminate\Console\Command;

class DistributeBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:distribute-balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse accounts with a balance and send to their owners';

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
        $addressGroups = AddressGroup::all();
        foreach ($addressGroups as $addressGroup) {
            $this->info('Check ' . $addressGroup->address);
            $recipients = [];
            if (!empty($addressGroup->items)) {
                $recipients = json_decode($addressGroup->items);
            }
            if (!empty($recipients)) {
                $this->info('Get Balance:');
                $balanceInformation = $addressGroup->account->getBalanceInformation();
                if (!empty($balanceInformation->node) && !empty($balanceInformation->node->pending)) {
                    $addressGroup->account->receivePending();
                    $balanceInformation = $addressGroup->account->getBalanceInformation();
                }
                $balance = $balanceInformation->node->balance ?? 0;
                if ($balance > 100) { //TODO - this is dumb
                    dump($addressGroup->account->seed_index);
                    //split raw accordingly
                    $this->info('Processing ' . $balance . ' Raw');
                    /*
                     * Check any active from acct
                     * We need to do this because sending from the same account multiple times in a row will
                     * result in a Gap error (node not fully caught up)
                     *
                     *
                     * Instead, we queue up batches and wait until the batches are done before we start up another
                     * */
                    $existingUnprocessedNodeTransaction = NodeTransaction::where('account_id',
                        $addressGroup->account->id)
                        ->whereNull('hash')
                        ->first();
                    if (!$existingUnprocessedNodeTransaction) {
                        $this->info('Processing Recipients');
                        //TODO - maybe collect all of these before saving node transactions to ensure we get all in case of error
                        foreach ($recipients as $recipient) {
                            $percent = intval($recipient->percentage);
                            $percentDecimal = $percent / 100; //TODO
                            $amount = floor($balance * $percentDecimal);
                            $amountString = sprintf('%.0f', $amount);
                            $nodeTransaction = NodeTransaction::create([
                                'amount' => $amountString,
                                'account_id' => $addressGroup->account->id,
                                'destination_address' => $recipient->address,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
