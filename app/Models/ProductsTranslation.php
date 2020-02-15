<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    protected $table = 'products_translations';
    protected $fillable = ['title', 'description', 'content'];
    public $timestamps = false;
}
