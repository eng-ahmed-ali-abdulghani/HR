<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;

    // السماح بالتعبئة الجماعية لهذه الحقول
    protected $fillable = [
        'excuse_datetime',
        'excuse_duration_hours',
        'employee_id',
        'excuse_type_id',
        'reason',
        'expected_attendance_time',
        'submitted_by_id',
        'notes',
        'leader_approval_status',
        'status',
        'is_due_to_official_mission',
    ];

    // تحويل بعض الحقول تلقائيًا لـ Carbon
    protected $casts = [
        'excuse_datetime' => 'datetime',
        'expected_attendance_time' => 'datetime',
        'leader_approval_status' => 'boolean',
        'is_due_to_official_mission' => 'boolean',
    ];


    // الموظف صاحب العذر
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // نوع العذر
    public function type()
    {
        return $this->belongsTo(Type::class, 'excuse_type_id');
    }

    // الشخص الذي قدّم العذر (HR أو مدير)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }
}
