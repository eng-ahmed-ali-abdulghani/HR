<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kind'];

    public function excuses()
    {
        return $this->hasMany('App\Models\Excuse');
    }

    public function vacations()
    {
        return $this->hasMany('App\Models\Vacation');
    }

}
