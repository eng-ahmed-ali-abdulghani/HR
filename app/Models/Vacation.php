<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'employee_id',
        'type_id',
        'reason',
        'replacement_employee_id',
        'submitted_by_id',
        'approved_by_id',
        'notes',
        'is_leader_approved',
        'status',
    ];

    // الموظف صاحب الإجازة
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // نوع الإجازة
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // الموظف البديل
    public function replacementEmployee()
    {
        return $this->belongsTo(User::class, 'replacement_employee_id');
    }

    // من قدّم الطلب
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }

    // من قام بالموافقة
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
