<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $translatedAttributes = ['title', 'description', 'content'];
    protected $table = 'products';
}
