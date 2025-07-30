<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = ['start_shift', 'end_shift'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
