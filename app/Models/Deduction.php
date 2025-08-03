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

    // الموظف المتأثر بالخصم
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // نوع الخصم
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // من قام بإدخال الخصم (HR أو النظام)
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // القائد الذي وافق أو رفض
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // مسؤول HR
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
