<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['name'];

    protected $fillable = ['type','name'];

    public $timestamps = false;


}
