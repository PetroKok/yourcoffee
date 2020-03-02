<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model implements TranslatableContract, FieldsInterface
{
    use Translatable;

    protected $table = 'ingredients';

    protected $fillable = ['image', 'pic', 'price'];
    protected $translatedAttributes = ['name', 'description'];

    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.category.title'),
                "field" => 'name',
            ],
            [
                "title" => trans('admin.category.position'),
                "field" => 'price',
            ],
        ];
    }

    /** START MUTATORS **/

    public function getImageAttribute($image)
    {
        return config('files.ingredients_path') . '/' . $image;
    }

    public function getPicAttribute($pic)
    {
        return config('files.ingredients_path') . '/' . $pic;
    }

    /** END MUTATORS **/
}
