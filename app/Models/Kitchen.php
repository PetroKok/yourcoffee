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

    const CLOSED = 0;
    const OPENED = 1;

    public function city_relation()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
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
                "field" => 'city_relation.name',
            ]
        ];
    }
}
