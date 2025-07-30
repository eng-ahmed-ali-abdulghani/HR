<?php

namespace App\Services;

use App\Models\Excuse;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\ExcuseResource;
use Illuminate\Support\Carbon;

class ExcuseService
{

    use ApiResponseHelper;

    public function index()
    {

        $user = auth()->user();
        $user_id = $user->id;
        $start_date = $user->start_date;

        $now = Carbon::now();

        // الإجمالي: من يوم التعيين حتى الآن
        $allExcuses = Excuse::with(['employee', 'type', 'submittedBy'])->where('employee_id', $user_id)
            ->whereDate('start_date', '>=', $start_date)->orderBy('start_date', 'desc')
            ->get();

        // عدد الإذنات خلال الشهر الحالي
        $monthlyExcusesCount = $allExcuses->filter(function ($excuse) use ($now) {
            return $excuse->start_date->month === $now->month &&
                $excuse->start_date->year === $now->year;
        })->count();

        // إجمالي الإذنات منذ التعيين
        $totalExcusesCount = $allExcuses->count();

        return [
            'from_date' => $start_date,
            'monthly_excuses_count' => $monthlyExcusesCount,
            'total_excuses_count' => $totalExcusesCount,
            'excuses' => ExcuseResource::collection($allExcuses),
        ];

    }


    public function store($data)
    {
        $excuse = Excuse::create([
            'start_date' => $data['start_date'], 'end_date' => $data['end_date'],
            'notes' => $data['notes'], 'reason' => $data['reason'],
            'type_id' => $data['type_id'],
            'replacement_employee_id' => $data['replacement_employee_id'],
            'submitted_by_id' => Auth::id(), 'employee_id' => Auth::id(),
        ]);

        return new ExcuseResource($excuse);
    }

    public function destroy($id)
    {
        $vacation = Excuse::find($id);
        $vacation->delete();
    }

}
