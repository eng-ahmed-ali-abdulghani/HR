<?php

namespace App\Services;

use App\Http\Resources\DeductionResource;
use App\Models\Deduction;
use App\Traits\CheckRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeductionService
{
    use  CheckRole;

    public function getAllDeductionsForAllEmployees()
    {
        $now = now();
        // جلب كل الخصومات لجميع الموظفين (مرتبة من الأحدث إلى الأقدم)
        $deductions = Deduction::latest()->get();

        // العدد الكلي للخصومات
        $totalCount = $deductions->count();

        // عدد الخصومات في الشهر الحالي فقط
        $monthlyCount = $deductions->filter(function ($deduction) use ($now) {
            return $deduction->created_at &&
                $deduction->created_at->month === $now->month &&
                $deduction->created_at->year === $now->year;
        })->count();

        // مجموع أيام الخصم
        $totalDeductionDays = $deductions->sum('deduction_days');

        return response()->json([
            'code' => 200,
            'message' => 'تم جلب الخصومات بنجاح',
            'data' => [
                'total_count' => $totalCount,
                'monthly_count' => $monthlyCount,
                'total_deduction_days' => $totalDeductionDays,
                'deductions' => DeductionResource::collection($deductions),
            ]
        ]);
    }

    public function getDeductionByEmployee($employeeId)
    {
        $now = Carbon::now();
        $deductions = Deduction::where('employee_id', $employeeId)->latest()->get();
        $totalCount = $deductions->count();
        $monthlyCount = $deductions->filter(function ($deduction) use ($now) {
            return optional($deduction->created_at)->month === $now->month &&
                optional($deduction->created_at)->year === $now->year;
        })->count();
        $totalDeductionDays = $deductions->sum('deduction_days');
        return [
            'code' => 200,
            'message' => 'تم جلب الخصومات بنجاح',
            'data' => [
                'total_count' => $totalCount,
                'monthly_count' => $monthlyCount,
                'total_deduction_days' => $totalDeductionDays,
                'deductions' => DeductionResource::collection($deductions),
            ]
        ];
    }

    public function makeDeduction($data)
    {
        $authUser = Auth::user();

        $deduction = Deduction::create(['deduction_days' => $data['deduction_days'],
            'employee_id' => $data['employee_id'], 'type_id' => $data['type_id'],
            'reason' => $data['reason'], 'notes' => $data['notes'],
            'submitted_by_id' => $authUser->id,
        ]);
        $this->handleApprovalByUserRole($deduction, $authUser, 'approved');
        return [
            'code' => 200,
            'message' => __('messages.deduction_created'),
            'data' => null,
        ];
    }
}
