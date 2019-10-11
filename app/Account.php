<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
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

    public function nodeTransactions(){
        return $this->hasMany(NodeTransaction::class, 'account_id', 'id');
    }

}
