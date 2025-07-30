<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Vacation;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\VacationResource;
use Illuminate\Support\Facades\Auth;

class VacationService
{

    use ApiResponseHelper;

    public function index()
    {
        $user = auth()->user();
        $currentYear = Carbon::now()->year;

        // جلب الإجازات الخاصة بالموظف خلال السنة الحالية
        $vacations = Vacation::with(['type', 'replacementEmployee', 'submittedBy', 'approvedBy'])->where('employee_id', $user->id)->whereYear('start_date', $currentYear)
            ->orderBy('start_date', 'desc')->get();

        // حساب إجمالي عدد الأيام
        $totalDays = $vacations->sum(function ($vacation) {
            $start = Carbon::parse($vacation->start_date);
            $end = Carbon::parse($vacation->end_date);
            return $start->diffInDays($end) + 1;
        });

        return response()->json([
            'year' => $currentYear,
            'total_days_used' => $totalDays,
            'vacations' => VacationResource::collection($vacations),
        ]);
    }

    public function store($data)
    {
        $vacation = Vacation::create([
            'start_date' => $data['start_date'], 'end_date' => $data['end_date'],
            'notes' => $data['notes'], 'reason' => $data['reason'],
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'],
            'submitted_by_id' => Auth::id(), 'employee_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Vacation request created successfully.',
            'data' => new VacationResource($vacation)
        ], 201);
    }

    public function destroy($id)
    {
        $vacation = Vacation::find($id);
        $vacation->delete();
    }


}
