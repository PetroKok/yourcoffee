<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [];



    const ORDER_TYPE = [
        'delivery' => 'delivery',  // доставка
        'self-pickup' => 'self-pickup', // самовивіз
    ];
}
