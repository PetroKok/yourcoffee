<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $table = 'products_l10n';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
