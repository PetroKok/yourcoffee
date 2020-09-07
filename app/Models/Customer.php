<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $fillable = ['name', 'surname', 'phone', 'email', 'password', 'registered', 'google_id', 'facebook_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const REGISTERED = true;
    const UNREGISTERED = false;

    public function isRegistered()
    {
        return $this->registered ? true : false;
    }


    /** Relations **/

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
