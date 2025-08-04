<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{VacationController,
    DeductionController,
    ExcuseController,
    HomeController,
    AuthController,
    LeaderController,
    TypeController,
    AttendanceController,
    CeoController
};


Route::group(['middleware' => ["SetLang"]], function () {

    //Login
    Route::post('login', [AuthController::class, 'Login']);

    Route::group(['middleware' => ["auth:sanctum"]], function () {
        // Auth
        Route::post('user/update', [AuthController::class, 'update']);
        Route::get('user/profile', [AuthController::class, 'profile']);
        Route::get('user/logout', [AuthController::class, 'logout']);
        Route::get('get-users', [AuthController::class, 'getUsers']);

        //Home
        Route::get('home', [HomeController::class, 'home']);

        // Type
        Route::get('get-type', [TypeController::class, 'GetType']);

        // Vacations
        Route::resource('vacation', VacationController::class);

        // Excuses
        Route::resource('excuse', ExcuseController::class);

        // Deductions
        Route::resource('deductions', DeductionController::class);

        // Deductions
        Route::resource('attendance', AttendanceController::class);

        //leader
        Route::controller(LeaderController::class)->prefix('leader')->group(function () {

            Route::get('get-employees', 'getEmployees');

            Route::post('change-status-vacation', 'changeStatusVacation');
            Route::post('change-status-excuse', 'changeStatusExcuse');

            Route::get('get-vacation/user/{id}', 'getVacationForUser');
            Route::get('get-excuse/user/{id}', 'getExcuseForUser');

            Route::post('make-deduction', 'makeDeduction');


        });

        // CEO
        Route::controller(CeoController::class)->prefix('ceo')->group(function () {

            Route::post('change-status-vacation', 'changeStatusVacation');
            Route::post('change-status-excuse', 'changeStatusExcuse');

            Route::get('get-vacation/user/{id}', 'getVacationForUser');
            Route::get('get-excuse/user/{id}', 'getExcuseForUser');

            Route::post('make-deduction', 'makeDeduction');
        });


    });

});
