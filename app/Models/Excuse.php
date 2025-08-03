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
        'is_leader_approved',
        'leader_approved_id',
        'is_hr_approved',
        'hr_approved_id',
        'is_ceo_approved',
        'ceo_approved_id',
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
        return $this->belongsTo(Type::class);
    }

    // مقدم الطلب (HR أو قائد)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // القائد الذي وافق أو رفض
    public function leaderApprover()
    {
        return $this->belongsTo(User::class, 'leader_approved_id');
    }

    // مسؤول الموارد البشرية
    public function hrApprover()
    {
        return $this->belongsTo(User::class, 'hr_approved_id');
    }

    // المدير التنفيذي
    public function ceoApprover()
    {
        return $this->belongsTo(User::class, 'ceo_approved_id');
    }
}
