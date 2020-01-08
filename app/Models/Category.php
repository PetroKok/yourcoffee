<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'position',
        'image',
        'parent_category_id',
    ];


    /** START RELATIONSHIP **/

    // code

    /** END RELATIONSHIP **/

    public function scopeFields()
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
