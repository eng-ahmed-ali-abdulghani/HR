<?php

use App\Http\Controllers\Web\{AttendanceController};
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;


# ----------------- Admin Auth Routes -----------------
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('login', 'LoginForm')->name('login');
    Route::post('login/submit', 'loginSubmit')->name('login.submit');
});


Route::middleware(['auth'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('attendance', AttendanceController::class);

});

