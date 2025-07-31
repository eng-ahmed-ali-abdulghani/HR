<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['locale', 'name', 'type_id'];

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
