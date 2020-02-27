<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'category_l10n';
    protected $fillable = ['title'];
    public $timestamps = false;
}
