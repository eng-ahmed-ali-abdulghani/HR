<?php

namespace App\Services;

use App\Models\Statu;
use App\Models\Vacation;
use App\Helpers\ApiResponseHelper;
use App\Http\Resources\VacationResource;

class VacationService{

    use ApiResponseHelper;
    public function MakeVacation($request)
    {
        // dd($request->day);
        $pednig_status = Statu::where('name_en','Pending')->first()->id;
        $vacation = new Vacation ;
        $vacation->date = $request->date;
        $vacation->day = $request->day;
        $vacation->user_id = $request->user_id;
        $vacation->alternative_id = $request->alternative_id;
        $vacation->type_id = $request->type_id;
        $vacation->reason_id = $request->reason_id;
        $vacation->actor_id = $request->user()->id;
        $vacation->note = $request->note == null ? null : $request->note;
        $vacation->leader_approve = $request->leader_approve  == null ? false : true;
        $vacation->statu_id = $request->statu_id == null ? $pednig_status : $request->statu_id;
        $vacation->save();
        return new VacationResource($vacation);
    }

    public function getYourVacations($request)
    {
        $user_id = auth()->user()->id;

        // Get year and month from the request
        $year = $request->year;
        $month = $request->month;

        // Query the vacations with optional year and month filtering
        $vacations = Vacation::with(['user', 'type', 'reason', 'statu', 'actor' , 'alternative'])
            ->where('user_id', $user_id)
            ->when($year, function ($query, $year) {
                $query->whereYear('date', $year);
            })
            ->when($month, function ($query, $month) {
                $query->whereMonth('date', $month);
            })
            ->get();
        return VacationResource::collection($vacations);
    }

    public function cancelVacation($id){
        $vacation = Vacation::find($id);
        $vacation->delete();
    }
    public function getAllVacation($request){
        $year = $request->year;
        $month = $request->month;
        $day = $request->day;
    }
    public function VacationRequets(){
        $statu_id = Statu::where('name_en','Pending')->first()->id ;
        $vacations = Vacation::where('statu_id',$statu_id)->get();
        return VacationResource::collection($vacations);
    }

}
