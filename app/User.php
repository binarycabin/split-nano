<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addressGroups()
    {
        return $this->hasMany(AddressGroup::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return strtolower($this->email) == strtolower(config('split.admin_user_email'));
    }

}
