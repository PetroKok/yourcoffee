<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $fillable = ['name', 'surname', 'phone', 'email', 'email_verified_at', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
