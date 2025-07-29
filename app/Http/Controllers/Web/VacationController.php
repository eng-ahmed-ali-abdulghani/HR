<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\VacationService;
use App\Http\Controllers\Controller;

class VacationController extends Controller
{
    protected $vacationService;
    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }
    public function newRequests ()
    {
        $vacations = $this->vacationService->VacationRequets();
        return view('dachboard.Pages.Vacations.newRequests', compact('vacations'));
    }
}
