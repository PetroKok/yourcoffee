<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $table = 'locales';
    protected $fillable = ['locale', 'name', 'is_primary'];
    public $timestamps = false;
}
