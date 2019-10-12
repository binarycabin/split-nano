<?php

namespace App;

use App\Services\Nano\Nano;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use BinaryCabin\NanoUnits\NanoUnits;
use Illuminate\Database\Eloquent\Model;

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
        $response = $nano->call('pending', [
            'account' => $this->address,
        ]);
        dump('receivePending...');
        dump($response);
        if (!empty($response->blocks)) {
            foreach ($response->blocks as $block) {
                dump($this->address);
                dump($block);
                $blockInfoResponse = $nano->call('block_info', [
                    'json_block' => 'true',
                    'hash' => $block,
                ]);
                dump($blockInfoResponse);
                $accountInfoResponse = $nano->call('account_info', [
                    'account' => $this->address,
                ]);
                dump($accountInfoResponse);
                $existingBalance = $accountInfoResponse->balance ?? 0;
                $newBalance = $blockInfoResponse->amount + $existingBalance;
                $newBalanceString = sprintf('%.0f', $newBalance);
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
                dump($createBlockData);
                $blockCreateResponse = $nano->call('block_create', $createBlockData);
                dump($blockCreateResponse);
                $processResponse = $nano->call('process', [
                    "json_block" => "true",
                    'block' => $blockCreateResponse->block,
                ]);
                dump($processResponse);

                /*$workResponse = $nano->call('work_generate', [
                    'hash' => $accountInfoResponse->frontier,
                    //'difficulty' => 'ffffffd21c3933f3',
                ]);
                dump($workResponse);*/

                $receiveResponse = $nano->call('receive', [
                    'account' => $this->address,
                ]);
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
