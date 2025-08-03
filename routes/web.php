<?php

use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\{AttendanceController};
use Illuminate\Support\Facades\Route;


# ----------------- Admin Auth Routes -----------------
Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('login', 'LoginForm')->name('login');
    Route::post('login/submit', 'loginSubmit')->name('login.submit');
});



Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    // Attendance routes
    Route::prefix('attendance')->name('attendance.')->group(function () {
        // Main attendance listing page
        Route::get('/', [AttendanceController::class, 'index'])->name('index');

        // Store new attendance record
        Route::post('/', [AttendanceController::class, 'store'])->name('store');

        // Bulk import attendance data
        Route::post('/import', [AttendanceController::class, 'bulkImport'])->name('import');

        // Attendance reports
        Route::get('/report', [AttendanceController::class, 'report'])->name('report');

        // Export attendance data
        Route::get('/export', [AttendanceController::class, 'export'])->name('export');
    });

    // User-specific attendance routes
    Route::prefix('users')->name('users.')->group(function () {
        // User attendance details
        Route::get('/{user}/attendance', [AttendanceController::class, 'userDetails'])->name('attendance');

        // Export user-specific attendance
        Route::get('/{user}/attendance/export', [AttendanceController::class, 'exportUserAttendance'])->name('attendance.export');
    });


});

// API routes for AJAX requests (routes/api.php)
Route::prefix('api/dashboard')->name('api.dashboard.')->middleware(['auth:sanctum'])->group(function () {
    // Quick attendance actions
    Route::post('/attendance/checkin', [AttendanceController::class, 'quickCheckin'])->name('attendance.checkin');
    Route::post('/attendance/checkout', [AttendanceController::class, 'quickCheckout'])->name('attendance.checkout');
    // Get attendance statistics
    Route::get('/attendance/stats', [AttendanceController::class, 'getStats'])->name('attendance.stats');
    // Get user attendance summary
    Route::get('/users/{user}/attendance/summary', [AttendanceController::class, 'getUserSummary'])->name('users.attendance.summary');
});


