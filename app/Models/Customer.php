<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $fillable = ['name', 'surname', 'phone', 'email', 'email_verified_at', 'password', 'registered'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    const REGISTERED = true;
    const UNREGISTERED = false;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function isRegistered()
    {
        return $this->registered ? true : false;
    }
}
