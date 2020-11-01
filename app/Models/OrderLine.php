<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'price'
    ];

    protected $appends = ['amount'];


    public function getAmountAttribute()
    {
        return (int)$this->qty * ((float)$this->price / 100);
    }


    /** RELATIONS **/

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
