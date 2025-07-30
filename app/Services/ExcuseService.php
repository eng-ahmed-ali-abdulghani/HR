<?php

namespace App\Services;

use App\Models\Status;
use App\Models\Excuse;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\ExcuseResource;

class ExcuseService{

    use ApiResponseHelper;
    public function MakeExcuse($request)
    {
        $pednig_status = Status::where('name_en','Pending')->first()->id;
        $excuse = new Excuse ;
        $excuse->date = $request->date;
        $excuse->hours = $request->hours;
        $excuse->user_id = $request->user_id;
        $excuse->type_id = $request->type_id;
        $excuse->reason_id = $request->reason_id;
        $excuse->actor_id = $request->user()->id;
        $excuse->note = $request->note == null ? null : $request->note;
        $excuse->mission = $request->mission  == null ? false : true;
        $excuse->leader_approve = $request->leader_approve  == null ? false : true;
        $excuse->statu_id = $request->statu_id == null ? $pednig_status : $request->statu_id;
        $excuse->save();
        return new ExcuseResource($excuse);
    }

    public function getYourExcuses($request)
    {
        $user_id = auth()->user()->id;

        // Get year and month from the request
        $year = $request->year;
        $month = $request->month;

        // Query the excuses with optional year and month filtering
        $excuses = Excuse::with(['user', 'type', 'reason', 'statu', 'actor'])
            ->where('user_id', $user_id)
            ->when($year, function ($query, $year) {
                $query->whereYear('date', $year);
            })
            ->when($month, function ($query, $month) {
                $query->whereMonth('date', $month);
            })
            ->get();
        return ExcuseResource::collection($excuses);
    }

}
