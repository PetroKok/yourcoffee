<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class City extends Model implements TranslatableContract, FieldsInterface
{
    use Translatable;

    protected $table = 'cities';

    protected $fillable = [];

    protected $translatedAttributes = ['name'];

    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.city.name'),
                "field" => 'name',
            ]
        ];
    }

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class, 'kitchen_city', 'city_id', 'kitchen_id')
            ->withPivot(['price_delivery', 'time_delivery']);
    }
}
