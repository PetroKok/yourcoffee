<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract, FieldsInterface
{
    use Translatable;

    protected $table = 'categories';

    public $translatedAttributes = [
        'title'
    ];

    protected $fillable = [
        'position',
        'image',
        'parent_id',
    ];

    /** START RELATIONSHIP **/

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /** END RELATIONSHIP **/


    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.category.title'),
                "field" => 'title',
            ],
            [
                "title" => trans('admin.category.position'),
                "field" => 'position',
            ],
        ];
    }

    /** START MUTATORS **/

    public function getImageAttribute($image)
    {
        return config('files.categories_path') . '/' . $image;
    }

    /** END MUTATORS **/
}
