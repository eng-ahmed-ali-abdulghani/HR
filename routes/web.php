<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\{VacationController,UserController};
use Illuminate\Support\Facades\Route;


# ----------------- Admin Auth Routes -----------------
Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('login', 'LoginForm')->name('login');
    Route::post('login/submit', 'loginSubmit')->name('login.submit');
});

# ----------------- Protected Admin Routes -----------------
Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin');
    Route::get('/vacations/newRequests', [VacationController::class, 'newRequests'])->name('vacations.newRequest');

    Route::resource('user', UserController::class);

});

