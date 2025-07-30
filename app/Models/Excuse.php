<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;

    protected $table = 'excuses';

    protected $fillable = ['start_date', 'end_date', 'employee_id', 'type_id', 'reason', 'submitted_by_id', 'notes',
        'leader_approval_status', 'status', 'is_due_to_official_mission',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'leader_approval_status' => 'boolean',
        'is_due_to_official_mission' => 'boolean',
    ];


    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }


    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }


    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
