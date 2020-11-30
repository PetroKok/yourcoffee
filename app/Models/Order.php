<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method create(array $data)
 */
class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'city_id',
        'city',
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
        'sandbox',
        'phone',
        'name',
        'incoming_order_id',
    ];

    protected $appends = ['amount'];

    const ORDER_TYPE = [
        'SELF-PICKUP' => 'SELF-PICKUP', // самовивіз
        'DELIVERY' => 'DELIVERY',  // доставка
    ];

    const SERVICE_MODE_POSTER = [
        '????' => '1', // в закладі
        'SELF-PICKUP' => '2', // самовивіз
        'DELIVERY' => '3',  // доставка
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


    public function getAmountAttribute()
    {
        $amount = 0;
        foreach ($this->lines as $line) {
            $amount += (int)$line->qty * (float)$line->price;
        }
        return $amount;
    }

    public function setIncomingOrderId(int $incoming_order_id)
    {
        $this->incoming_order_id = $incoming_order_id;
        $this->save();
    }

    /** RELATIONS **/

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id', 'id');
    }

    public function city_relation(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
