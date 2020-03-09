<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Label extends Model implements TranslatableContract, FieldsInterface
{
    use Translatable;

    protected $fillable = ['color', 'position'];
    protected $table = 'labels';
    public $translatedAttributes = ['name'];

    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.label.name'),
                "field" => 'name',
            ],
            [
                "title" => trans('admin.label.position'),
                "field" => 'position',
            ]
        ];
    }
}
