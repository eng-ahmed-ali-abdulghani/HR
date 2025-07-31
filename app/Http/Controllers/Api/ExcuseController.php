<?php

namespace App\Http\Controllers\Api;


use App\Models\Excuse;
use App\Services\ExcuseService;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Excuses\StoreExcuseRequest;
use Illuminate\Support\Facades\Auth;

class ExcuseController extends Controller
{
    use ApiResponseHelper;

    protected $excuseService;

    public function __construct(ExcuseService $excuseService)
    {
        $this->excuseService = $excuseService;
    }

    public function index()
    {
        $employee = auth()->user();
        $excuses = $this->excuseService->getExcuseForEmployee($employee);
        return $this->setCode(200)->setMessage('Success')->setData($excuses)->send();
    }

    public function store(StoreExcuseRequest $request)
    {
        $data = $request->validated();
        $excuseExists = Excuse::where('employee_id', Auth::id())->exists();

        if ($excuseExists) {
            return $this->setCode(409)->setMessage(__('messages.vacation_booked'))->send();
        }
        // حفظ الإجازة باستخدام الخدمة
        $vacation = $this->excuseService->store($data);

        return $this->setCode(201)->setMessage(__('Success'))->setData($vacation)->send();
    }

    public function destroy($id)
    {
        $user_id = auth()->user()->id;

        $excuse = Excuse::where('employee_id', $user_id)->where('id', $id)->first();

        if (!$excuse) {
            return $this->setCode(404)->setMessage(__('messages.not_found'))->send();
        }

        if ($excuse->status === 'approved') {
            return $this->setCode(403)->setMessage(__('messages.forbiden'))->send();
        }

        $this->excuseService->destroy($id);

        return $this->setCode(200)->setMessage('تم الغاء طلب الاذن ')->send();
    }
}
