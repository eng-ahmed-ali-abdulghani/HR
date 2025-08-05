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


        return $this->response(201, __('messages.deduction_created'),
            [
                'total_count' => $totalCount,
                'monthly_count' => $monthlyCount,
                'total_deduction_days' => $totalDeductionDays,
                'deductions' => DeductionResource::collection($deductions),
            ]
        );

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

        return $this->response(201, 'تم جلب الخصومات بنجاح',
            [
                'total_count' => $totalCount,
                'monthly_count' => $monthlyCount,
                'total_deduction_days' => $totalDeductionDays,
                'deductions' => DeductionResource::collection($deductions),
            ]
        );
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

        return $this->response(201, __('messages.deduction_created'));
    }

    public function cancelledDeduction($id)
    {
        $deduction = $this->checkDeduction($id);
        if (is_array($deduction)) return $deduction;

        if ($deduction->ceo_status === 'approved') {
            return $this->response(403, __('messages.forbiden'));
        }
        $deduction->delete();
        return $this->response(200, __('messages.request_cancelled'));
    }

    private function checkDeduction($id)
    {
        $deduction = Deduction::find($id);
        return $deduction ?: $this->response(404, __('messages.not_found'));
    }

    private function response($code, $message, $data = null)
    {
        return compact('code', 'message', 'data');
    }
}
