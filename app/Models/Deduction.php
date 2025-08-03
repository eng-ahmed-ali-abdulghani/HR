<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'deduction_days',
        'employee_id',
        'type_id',
        'reason',
        'submitted_by_id',
        'notes',
        'is_automatic',
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

    // الموظف المتأثر بالخصم
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // نوع الخصم
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // من قام بإدخال الخصم (HR أو النظام)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // القائد الذي وافق
    public function leaderApprover()
    {
        return $this->belongsTo(User::class, 'leader_approved_id');
    }

    // مسؤول HR
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
