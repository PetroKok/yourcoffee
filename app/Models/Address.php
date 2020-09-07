<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'customer_id',
        'city_id',
        'address',
        'apartment',
        'entrance',
        'floor',
        'door_code',
        'main'
    ];

    /** RELATIONS **/

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
