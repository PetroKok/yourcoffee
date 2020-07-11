<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'city_id',
        'door_code',
        'address',
        'entrance',
        'pay_type',
        'floor',
        'created_at',
        'comment',
        'status',
        'apartment',
        'updated_at',
        'type',
        'city',
        'sandbox',
        'phone',
        'name'
    ];


    const ORDER_TYPE = [
        'delivery' => 'delivery',  // доставка
        'self-pickup' => 'self-pickup', // самовивіз
    ];

    const PAY_TYPE = [
        'cash' => 'cash',  // оплата готівкою
        'card' => 'card', // оплата картою
    ];
}
