<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExcuseController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\VacationController;

Route::group(['middleware' => ["SetLang"]], function () {

    //Login
    Route::post('login', [AuthController::class, 'Login']);

    Route::group(['middleware' => ["auth:sanctum"]], function () {

        // Auth
        Route::post('user/update', [AuthController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);

        //Home
        Route::get('/home', [HomeController::class, 'home']);

        // Vacations
        Route::resource('vacation', VacationController::class);

        // Excuses
        Route::resource('excuse', ExcuseController::class);

        // Deductions
        Route::resource('deductions', ExcuseController::class);


    });

});
