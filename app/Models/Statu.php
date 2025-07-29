<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en'];

    public function excuses ()
    {
        return $this->hasMany('App\Models\Excuse');
    }
    public function vacations ()
    {
        return $this->hasMany('App\Models\Vacation');
    }

}
