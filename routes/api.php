<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{VacationController, DeductionController, ExcuseController,HomeController, AuthController, LeaderController};


Route::group(['middleware' => ["SetLang"]], function () {

    //Login
    Route::post('login', [AuthController::class, 'Login']);

    Route::group(['middleware' => ["auth:sanctum"]], function () {

        // Auth
        Route::post('user/update', [AuthController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);

        //Home
        Route::get('home', [HomeController::class, 'home']);

        // Vacations
        Route::resource('vacation', VacationController::class);

        // Excuses
        Route::resource('excuse', ExcuseController::class);

        // Deductions
        Route::resource('deductions', DeductionController::class);

        //leader
        Route::get('leader/get-employees', [LeaderController::class, 'getLeaderEmployees']);
        Route::get('leader/accept-request-vacation/{id}', [LeaderController::class, 'acceptRequestVacation']);
        Route::get('leader/accept-request-excuse/{id}', [LeaderController::class, 'acceptRequestExcuse']);
        Route::get('leader/get-request-vacation/user/{id}', [LeaderController::class, 'getRequestVacationForUser']);
        Route::get('leader/get-request-excuse/user/{id}', [LeaderController::class, 'getRequestExcuseForUser']);


    });

});
