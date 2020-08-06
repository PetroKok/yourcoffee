<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract, FieldsInterface
{
    use Translatable;

    protected $table = 'products';
    protected $fillable = ['price', 'category_id', 'image'];
    protected $translatedAttributes = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFields(): array
    {
        return [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.product.name'),
                "field" => 'name',
            ],
            [
                "title" => trans('admin.product.price'),
                "field" => 'price',
            ],
            [
                "title" => trans('admin.product.category'),
                "field" => 'category.title',
            ],
        ];
    }

    public function getImageAttribute($image)
    {
        return '/storage' . config('files.products_path') . '/' . $image;
    }
}
