<?php

namespace App\Http\Controllers\Api;

use App\Models\Vacation;
use App\Services\VacationService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Vacations\StoreVacationRequest;

class VacationController extends Controller
{
    use ApiResponseHelper;

    protected $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index()
    {
        $vacations = $this->vacationService->index();
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function store(StoreVacationRequest $request)
    {
        // التحقق من وجود إجازة بنفس التاريخ لنفس المستخدم
        $vacationExists = Vacation::whereDate('start_date', $request->start_date)->where('employee_id', $request->user()->id)->exists();

        if ($vacationExists) {
            return $this->setCode(409)->setMessage(__('messages.vacation_booked'))->send();
        }
        // حفظ الإجازة باستخدام الخدمة
        $vacation = $this->vacationService->store($request->validated());

        return $this->setCode(201)->setMessage(__('messages.success'))->setData($vacation)->send();
    }


    public function destroy($id)
    {
        $user_id = auth()->user()->id;

        $vacation = Vacation::where('user_id', $user_id)->where('id', $id)->first();

        if (!$vacation) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }

        if ($vacation->status === 'approved') {
            return $this->setCode(403)->setMessage(__('messages.forbiden'))->send();
        }

        $this->vacationService->destroy($id);

        return $this->setCode(200)->setMessage(__('messages.cancel_vacation'))->send();
    }

}
