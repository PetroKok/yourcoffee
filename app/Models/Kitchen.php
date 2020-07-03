<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model implements FieldsInterface
{
    protected $fillable = [
        'title',
        'description',
        'address',
        'phone',
        'email',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'kitchen_city', 'kitchen_id', 'city_id')
            ->withPivot(['price_delivery', 'time_delivery']);
    }

    public function saveDeliveryPrice($data)
    {
        $this->cities()->sync($data['delivery']);
    }

    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.kitchen.title'),
                "field" => 'title',
            ],
            [
                "title" => trans('admin.kitchen.address'),
                "field" => 'address',
            ],
            [
                "title" => trans('admin.kitchen.phone'),
                "field" => 'phone',
            ],
            [
                "title" => trans('admin.kitchen.email'),
                "field" => 'email',
            ],
            [
                "title" => trans('admin.kitchen.city'),
                "field" => 'city.name',
            ]
        ];
    }
}