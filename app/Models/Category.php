<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [];

    const FIELDS = [
        'id', 'title', 'created_at', 'actions'
    ];

    /** START RELATIONSHIP **/

    // code

    /** END RELATIONSHIP **/



    /** START MUTATORS **/

    // code

    /** END MUTATORS **/
}
