<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    /** START RELATIONSHIP **/

    // code

    /** END RELATIONSHIP **/

    public function scopeFields(){
        $fields = [
            [
                "title" => 'ID',
                "field" => 'id',
            ],
            [
                "title" => trans('admin.table.category.title'),
                "field" => 'title',
            ],
            [
                "title" => trans('admin.table.created_at'),
                "field" => 'created_at',
            ],
        ];
        return $fields;
    }

    /** START MUTATORS **/

    // code

    /** END MUTATORS **/
}
