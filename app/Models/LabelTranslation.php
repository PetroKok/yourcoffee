<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabelTranslation extends Model
{
    protected $fillable = ['name'];
    protected $table = 'labels_l10n';
    public $timestamps = false;
}
