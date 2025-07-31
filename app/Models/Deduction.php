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
        'is_approved',
    ];

    protected $casts = [
        'is_automatic' => 'boolean',
        'is_approved' => 'boolean',
        'deduction_days' => 'decimal:2',
    ];


    /**
     * الموظف المتأثر بالخصم
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * نوع الخصم
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * من قام بإضافة الخصم (HR أو النظام)
     */
    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by_id');
    }
}
