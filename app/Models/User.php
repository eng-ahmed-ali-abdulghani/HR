<?php

namespace App\Models;


use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Imageable;

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
        'allowed_vacation_days',
        'sallary',
        'start_date',
        'end_date',
        'department_id',
        'company_id',
        'user_type',
        'fcm_token',
        'fingerprint_employee_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'allowed_vacation_days' => 'decimal:2',
        'sallary' => 'decimal:2',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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

}
