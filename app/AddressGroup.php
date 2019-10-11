<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class AddressGroup extends Model
{

    use HasUUID;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'address',
        'items',
    ];

    public function account(){
        return $this->belongsTo(Account::class, 'address', 'address');
    }

}
