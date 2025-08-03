<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Vacation;
use App\Http\Resources\VacationResource;
use Illuminate\Support\Facades\Auth;

class VacationService
{

    public function getVactionForEmployee($employee)
    {
        $start_date = \Carbon\Carbon::parse($employee->start_date); // تأكد من أنه Carbon
        $allowed_vacation_days = $employee->allowed_vacation_days;

        // جلب الإجازات المرتبطة بالموظف من تاريخ بداية عمله
        $vacations = Vacation::where('employee_id', $employee->id)->whereDate('start_date', '>=', $start_date)->orderByDesc('start_date')->get();
        // احتساب أيام الإجازات المعتمدة فقط
        $totalDays = $vacations->filter(fn($v) => $v->ceo_status === 'approved')->sum(function ($vac) {
            return \Carbon\Carbon::parse($vac->start_date)->diffInDays(\Carbon\Carbon::parse($vac->end_date)) + 1;
        });

        $remainingDays = max(0, $allowed_vacation_days - $totalDays);

        return [
            'from_date' => $start_date->toDateString(),
            'allowed_days' => $allowed_vacation_days,
            'total_days_used' => $totalDays,
            'remaining_days' => $remainingDays,
            'vacations' => VacationResource::collection($vacations),
        ];
    }


    public function store($data)
    {
        $employee = Auth::user();

        // تأكد من تحويل التاريخ إلى كائن Carbon
        $start_date = \Carbon\Carbon::parse($employee->start_date);
        $allowed_days = $employee->allowed_vacation_days;

        // احسب عدد أيام الإجازات المعتمدة منذ بداية العمل
        $usedDays = Vacation::where('employee_id', $employee->id)
            ->where('ceo_status', 'approved')
            ->whereDate('start_date', '>=', $start_date)
            ->get()
            ->sum(function ($vac) {
                return \Carbon\Carbon::parse($vac->start_date)->diffInDays(\Carbon\Carbon::parse($vac->end_date)) + 1;
            });

        // احسب عدد الأيام المطلوبة في الطلب الحالي
        $requestedDays = \Carbon\Carbon::parse($data['start_date'])->diffInDays(\Carbon\Carbon::parse($data['end_date'])) + 1;

        // تحقق من توفر الأيام
        if ($usedDays + $requestedDays > $allowed_days) {
            return [
                'code' => 401,
                'message' => 'لا يمكن تقديم الإجازة، لقد استنفدت كل أيام الإجازة المسموح بها.',
                'data' => null,
            ];
        }

        // إنشاء سجل الإجازة
        $vacation = Vacation::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'notes' => $data['notes'] ?? null,
            'reason' => $data['reason'] ?? null,
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'] ?? null,
            'submitted_by_id' => $employee->id,
            'employee_id' => $employee->id,
        ]);

        return [
            'code' => 201,
            'message' => 'تم تقديم طلب الإجازة بنجاح.',
            'data' => new VacationResource($vacation),
        ];
    }


    public function destroy($id)
    {
        $vacation = Vacation::find($id);
        $vacation->delete();
    }


}
