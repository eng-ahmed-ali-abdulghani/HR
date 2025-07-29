<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ExcuseController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ReasonController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\VacationController;


Route::group(['middleware' => ["SetLang"]], function () {

    //Login
    Route::post('user/login', [AuthController::class, 'Login']);

    //types
    Route::get('types', [TypeController::class, 'index']);

    //reasons
    Route::get('reasons', [ReasonController::class, 'index']);

    //Departments
    Route::get('departments', [DepartmentController::class, 'index']);

    //Departments
    Route::get('department/{id}', [DepartmentController::class, 'show']);

    //Reasons
    Route::get('/home', [HomeController::class, 'home']);


    Route::group(['middleware' => ["auth:sanctum"]], function () {

        // Auth
        Route::post('user/update', [AuthController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);

        // Excuses
        Route::post('user/make/excuse', [ExcuseController::class, 'store']);
        Route::post('user/excuses', [ExcuseController::class, 'index']);

        // Vacations
        Route::post('user/make/vacation', [VacationController::class, 'store']);
        Route::post('user/vacations', [VacationController::class, 'index']);
        Route::get('user/delete/vacation/{id}', [VacationController::class, 'delete']);

    });

});
