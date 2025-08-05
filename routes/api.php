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
        Route::resource('type', TypeController::class);

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
        });


    });

});
