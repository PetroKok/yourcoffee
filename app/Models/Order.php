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
        'DELIVERY' => 'DELIVERY',  // доставка
        'SELF-PICKUP' => 'SELF-PICKUP', // самовивіз
    ];

    const PAY_TYPE = [
        'CASH' => 'CASH',  // оплата готівкою
        'CARD' => 'CARD', // оплата картою
    ];

    const STATUS = [
        'CREATED' => 'CREATED', // створене замовлення

        'PREPARING' => 'PREPARING',  // взято в роботу, готується

        'DELIVERING' => 'DELIVERING', // приготували, якщо доставка - доставляється.
        'WAIT_FOR_PICK_UP' => 'WAIT_FOR_PICK_UP', // приготували, чекають поки кдієнт забере.

        'DONE' => 'DONE', // успішна доставка, або клієнт сам забрав

        'CANCELED' => 'CANCELED', // відміна замовлення

        'SPECIFY' => 'SPECIFY', // потребує уточнення, клієнту зателефонуються у випадку непередбачуваних ситуацій.

        'FRAUD' => 'FRAUD', // шахрайство
    ];
}
