<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'employee_id',
        'replacement_employee_id',
        'type_id',
        'reason',
        'submitted_by_id',
        'notes',
        'leader_status',
        'leader_id',
        'hr_status',
        'hr_id',
        'ceo_status',
        'ceo_id',
    ];

    /**
     * العلاقات
     */

    // الموظف صاحب العذر
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // الموظف البديل
    public function replacementEmployee()
    {
        return $this->belongsTo(User::class, 'replacement_employee_id');
    }

    // نوع العذر
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // مقدم الطلب (HR أو قائد)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // القائد الذي وافق أو رفض
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // مسؤول الموارد البشرية
    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id');
    }

    // المدير التنفيذي
    public function ceo()
    {
        return $this->belongsTo(User::class, 'ceo_id');
    }
}
