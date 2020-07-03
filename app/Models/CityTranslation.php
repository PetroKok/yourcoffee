<?php

namespace App\Models;

use App\Models\Interfaces\FieldsInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $table = 'cities_l10n';

    protected $fillable = ['name'];

    public $timestamps = false;
}
