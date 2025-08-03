<?php

use App\Http\Controllers\Web\{AttendanceController, LoginController};
use Illuminate\Support\Facades\Route;


# ----------------- Admin Auth Routes -----------------
Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('login', 'LoginForm')->name('login');
    Route::post('login/submit', 'loginSubmit')->name('login.submit');
});


Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');


