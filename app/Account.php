<?php

namespace App;

use App\Services\Nano\Nano;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\NanoUnits\NanoUnits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Account extends Model
{
    use HasUUID;

    protected $fillable = [
        'uuid',
        'address',
        'seed_key',
        'seed_index',
        'public_key',
        'secret_key',
    ];

    public function getBalanceInformation()
    {
        $balances = new \stdClass();
        $balances->node = $this->getNodeBalance();
        $balances->spent = 0;
        $balances->available = $balances->node->balance ?? 0;
        $balances->available = $balances->available - $balances->spent;
        $balances->available = number_format($balances->available, 0, '', '');
        $balances->availableTicker = NanoUnits::convert('raw', 'ticker', $balances->available);
        return $balances;
    }

    private function getNodeBalance()
    {
        $nano = new Nano();
        $response = $nano->call('account_balance', [
            'account' => $this->address,
        ]);
        return $response;
    }

    public function receivePending()
    {
        $nano = new Nano();
        Log::info('receivePending...');
        $response = $nano->call('pending', [
            'account' => $this->address,
        ]);
        Log::info(json_encode($response));
        if (!empty($response->blocks)) {
            foreach ($response->blocks as $block) {
                Log::info($this->address);
                Log::info(json_encode($block));
                $blockInfoResponse = $nano->call('block_info', [
                    'json_block' => 'true',
                    'hash' => $block,
                ]);
                Log::info(json_encode($blockInfoResponse));
                $accountInfoResponse = $nano->call('account_info', [
                    'account' => $this->address,
                ]);
                Log::info(json_encode($accountInfoResponse));
                $existingBalance = $accountInfoResponse->balance ?? 0;
                Log::info('Existing Balance: '.$existingBalance);
                //$newBalance = $blockInfoResponse->amount + $existingBalance;
                $newBalance = bcadd($blockInfoResponse->amount, $existingBalance);
                Log::info('New Balance: '.$newBalance);
                $newBalanceString = (string) $newBalance;//sprintf('%.0f', $newBalance);
                Log::info('New Balance String: '.$newBalanceString);
                $createBlockData = [
                    'json_block' => 'true',
                    'type' => 'state',
                    'account' => $this->address,
                    'representative' => config('split.nano.representative'),
                    'balance' => $newBalanceString,
                    'link' => $block,
                    'key' => $this->secret_key,
                ];
                if (isset($accountInfoResponse->error)) {
                    $createBlockData['previous'] = '0';
                } else {
                    $createBlockData['previous'] = $accountInfoResponse->frontier;
                }
                Log::info(json_encode($createBlockData));
                $blockCreateResponse = $nano->call('block_create', $createBlockData);
                Log::info('Create Block:');
                Log::info(json_encode($blockCreateResponse));
                Log::info('Process:');
                $processResponse = $nano->call('process', [
                    "json_block" => "true",
                    'block' => $blockCreateResponse->block,
                ]);
                Log::info(json_encode($processResponse));

                /*$workResponse = $nano->call('work_generate', [
                    'hash' => $accountInfoResponse->frontier,
                    //'difficulty' => 'ffffffd21c3933f3',
                ]);
                dump($workResponse);*/

                /*
                $receiveResponse = $nano->call('receive', [
                    'account' => $this->address,
                ]);
                Log::info(json_encode($receiveResponse));
                */
            }
        }
        return $response;
    }

    public function getQRPath()
    {
        return url('qr/' . $this->address . '.png');
    }

    public function getBalanceDetailsAttribute()
    {
        //TODO - cache
        return $this->getBalanceInformation();
    }

    public function getBalanceAttribute()
    {
        $balanceDetails = $this->balance_details;
        if ($balanceDetails) {
            return $balanceDetails->node->balance ?? 0;
        }
        return 0;
    }

    public static function getUnused()
    {
        $account = static::whereNull('updated_at')->first();
        $account->touch();
        return $account;
    }

    public function nodeTransactions()
    {
        return $this->hasMany(NodeTransaction::class, 'account_id', 'id');
    }

}
