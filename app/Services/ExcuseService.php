<?php

namespace App\Services;

use App\Models\Excuse;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\ExcuseResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExcuseService
{

    use ApiResponseHelper;

    public function getExcuseForEmployee($employee)
    {
        $start_date = \Carbon\Carbon::parse($employee->start_date);
        $now = \Carbon\Carbon::now();

        // اجلب الإذنات من يوم التعيين حتى الآن
        $allExcuses = Excuse::where('employee_id', $employee->id)->whereDate('start_date', '>=', $start_date)->orderBy('start_date', 'desc')->get();

        // عدد الإذنات خلال الشهر الحالي
        $monthlyExcusesCount = $allExcuses->filter(function ($excuse) use ($now) {
            return $excuse->start_date instanceof \Carbon\Carbon &&
                $excuse->start_date->month === $now->month &&
                $excuse->start_date->year === $now->year;
        })->count();

        // إجمالي عدد الإذنات
        $totalExcusesCount = $allExcuses->count();

        return [
            'from_date' => $start_date->toDateString(),
            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $totalExcusesCount,
            'excuses' => ExcuseResource::collection($allExcuses),
        ];
    }


    public function store($data)
    {
        $employee = Auth::user();
        // يمكن إضافة تحقق من وجود بيانات مطلوبة هنا أو استخدام FormRequest
        Excuse::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'notes' => $data['notes'] ?? null,
            'reason' => $data['reason'] ?? null,
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'] ?? null,
            'submitted_by_id' => $employee->id,
            'employee_id' => $employee->id,
        ]);
        return 'تم تقديم طلب العذر بنجاح.';
    }


    public function destroy($id)
    {
        $vacation = Excuse::find($id);
        $vacation->delete();
    }

}
