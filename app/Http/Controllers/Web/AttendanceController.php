<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        // Build the users query with attendance data
        $usersQuery = User::query()->select(['users.id', 'users.name', 'users.email', 'users.created_at'])->with(['attendances']);
        // Get paginated results
        $users = $usersQuery->paginate(3);

        // Calculate statistics for the filtered period
        $stats = $this->calculateAttendanceStats(Carbon::today(), Carbon::today(),null);

        return view('dashboard.attendance.index', compact('users', 'stats'));
    }


    private function calculateAttendanceStats($dateFrom, $dateTo, $search = null)
    {
        // Base query for users
        $usersQuery = User::query();

        $totalUsers = $usersQuery->count();

        // Users with check-in records
        $usersWithCheckin = (clone $usersQuery)->whereHas('attendances', function ($query) use ($dateFrom, $dateTo) {
            $query->where('type', 'checkin')->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
        })->count();

        // Users with check-out records
        $usersWithCheckout = (clone $usersQuery)->whereHas('attendances', function ($query) use ($dateFrom, $dateTo) {
            $query->where('type', 'checkout')->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
        })->count();

        // Users without any attendance records
        $usersAbsent = (clone $usersQuery)->whereDoesntHave('attendances', function ($query) use ($dateFrom, $dateTo) {
            $query->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
        })->count();

        return [
            'total_users' => $totalUsers,
            'total_checkin' => $usersWithCheckin,
            'total_checkout' => $usersWithCheckout,
            'total_absent' => $usersAbsent,
            'attendance_rate' => $totalUsers > 0 ? round(($usersWithCheckin / $totalUsers) * 100, 1) : 0
        ];
    }













}
