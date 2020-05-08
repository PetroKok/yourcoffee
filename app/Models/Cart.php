<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['customer_id', 'product_id', 'price', 'qty'];

    protected $appends = ['amount'];

    /** RELATIONS **/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    /** FUNC **/

    public function setQty(int $qty)
    {
        $this->qty += $qty;
        $this->save();
    }

    public function getAmountAttribute()
    {
        return (int)$this->qty * (float)$this->price;
    }
}
