<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Imageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'title',
        'code',
        'password',
        'phone',
        'gender',
        'age',
        'birth_date',
        'vacations',
        'sallary',
        'start_date',
        'end_date',
        'department_id',
        'company_id',
        'shift_id',
        'user_type',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'department',
        'company',
        'shift',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function excuses()
    {
        return $this->hasMany(Excuse::class, 'user_id');
    }

    public function actedExcuses()
    {
        return $this->hasMany(Excuse::class, 'actor_id');
    }
    public function vacations()
    {
        return $this->hasMany(Vacation::class, 'user_id');
    }

    public function actedVacations()
    {
        return $this->hasMany(Vacation::class, 'actor_id');
    }
    public function alterVacations()
    {
        return $this->hasMany(Vacation::class, 'alternative_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

}
