<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientsTranslation extends Model
{
    protected $table = 'ingredient_l10n';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
