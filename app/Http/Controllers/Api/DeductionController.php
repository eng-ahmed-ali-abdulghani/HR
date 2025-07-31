<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeductionResource;
use App\Models\Deduction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeductionController extends Controller
{
    use ApiResponseHelper;


    public function index()
    {
        $employeeId = Auth::id();
        $now = Carbon::now();

        // جميع الخصومات
        $deductions = Deduction::where('employee_id', $employeeId)->latest()->get();

        // عدد الخصومات الكلي
        $totalCount = $deductions->count();

        // عدد خصومات هذا الشهر
        $monthlyCount = $deductions->filter(function ($deduction) use ($now) {
            return $deduction->created_at->month === $now->month &&
                $deduction->created_at->year === $now->year;
        })->count();

        // مجموع أيام الخصم
        $totalDeductionDays = $deductions->sum('deduction_days');

        $data = [
            'total_count' => $totalCount,
            'monthly_count' => $monthlyCount,
            'total_deduction_days' => $totalDeductionDays,
            'deductions' => DeductionResource::collection($deductions),
        ];
        return $this->setCode(200)->setMessage('Success')->setData($data)->send();

    }


}
