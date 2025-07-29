<?php

namespace App\Http\Controllers\Api;

use App\Models\Statu;
use App\Models\Vacation;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $vacations = $this->vacationService->getYourVacations($request);
        return $this->setCode(200)->setMessage('Success')->setData($vacations)->send();
    }

    public function store(StoreVacationRequest $request)
    {
        // dd($request->all());
        $vacation = Vacation::where('date', $request->date)->where('user_id',$request->user()->id)->first();
        if($vacation){
            return $this->setCode(404)->setMessage(__('messages.vacation_booked'))->send();
        }
        $vacation = $this->vacationService->MakeVacation($request);
        return $this->setCode(200)->setMessage('Success')->setData($vacation)->send();
    }
    public function delete($id)
    {
        // dd($request->all());
        $user_id = auth()->user()->id;
        $vacation = Vacation::where('user_id', $user_id)->where('id', $id)->first();
        if (!$vacation) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }
        if($vacation->statu_id === Statu::where('name_en','Approved')->first()->id)
        {
            return $this->setCode(404)->setMessage(__('messages.forbiden'))->send();
        }
        $this->vacationService->cancelVacation($id);
        return $this->setCode(200)->setMessage(__('messages.cancel_vacation'))->send();
    }
}
