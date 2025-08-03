<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{VacationController,
    DeductionController,
    ExcuseController,
    HomeController,
    AuthController,
    LeaderController,
    TypeController,AttendanceController};


Route::group(['middleware' => ["SetLang"]], function () {

    //Login
    Route::post('login', [AuthController::class, 'Login']);

    Route::group(['middleware' => ["auth:sanctum"]], function () {
        // Auth
        Route::post('user/update', [AuthController::class, 'update']);
        Route::get('user/logout', [AuthController::class, 'logout']);

        //Home
        Route::get('home', [HomeController::class, 'home']);

        // Vacations
        Route::resource('vacation', VacationController::class);

        // Excuses
        Route::resource('excuse', ExcuseController::class);

        // Deductions
        Route::resource('deductions', DeductionController::class);

        // Deductions
        Route::resource('attendances', AttendanceController::class);

        //leader
        Route::controller(LeaderController::class)->prefix('leader')->group(function () {
            Route::get('get-employees', 'getLeaderEmployees');
            Route::get('accept-request-vacation/{id}', 'acceptRequestVacation');
            Route::get('accept-request-excuse/{id}', 'acceptRequestExcuse');
            Route::get('get-request-vacation/user/{id}', 'getRequestVacationForUser');
            Route::get('get-request-excuse/user/{id}', 'getRequestExcuseForUser');
        });

        Route::get('get-type', [TypeController::class, 'GetType']);

    });

});
