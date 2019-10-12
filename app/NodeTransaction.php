<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class NodeTransaction extends Model
{

    use HasUUID;

    protected $fillable = [
        'uuid',
        'amount',
        'account_id',
        'destination_address',
        'hash',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

}
