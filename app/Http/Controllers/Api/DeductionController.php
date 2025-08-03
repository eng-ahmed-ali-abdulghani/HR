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

        $deductions = Deduction::where('employee_id', $employeeId)->latest()->get();

        $totalCount = $deductions->count();

        $monthlyCount = $deductions->filter(function ($deduction) use ($now) {
            return optional($deduction->created_at)->month === $now->month &&
                optional($deduction->created_at)->year === $now->year;
        })->count();

        $totalDeductionDays = $deductions->sum('deduction_days');

        return $this->setCode(200)
            ->setMessage('تم جلب الخصومات بنجاح')
            ->setData([
                'total_count' => $totalCount,
                'monthly_count' => $monthlyCount,
                'total_deduction_days' => $totalDeductionDays,
                'deductions' => DeductionResource::collection($deductions),
            ])->send();
    }



}
