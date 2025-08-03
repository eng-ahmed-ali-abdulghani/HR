<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display attendance listing with advanced filtering
     */
    public function index(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'attendance_type' => 'nullable|in:checkin,checkout,absent',
            'search' => 'nullable|string|max:255',
            'export' => 'nullable|in:csv,excel'
        ]);

        // Set default dates if not provided
        $dateFrom = $request->input('date_from', Carbon::today()->toDateString());
        $dateTo = $request->input('date_to', Carbon::today()->toDateString());
        $attendanceType = $request->input('attendance_type');
        $search = $request->input('search');

        // Build the users query with attendance data
        $usersQuery = User::query()
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at'
            ])
            ->with(['attendances' => function ($query) use ($dateFrom, $dateTo) {
                $query->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo])
                    ->orderBy('timestamp', 'desc');
            }]);

        // Apply search filter
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.email', 'LIKE', "%{$search}%")
                    ->orWhere('users.id', 'LIKE', "%{$search}%");
            });
        }

        // Apply attendance type filter
        if ($attendanceType) {
            if ($attendanceType === 'absent') {
                // Users who have no attendance records in the specified date range
                $usersQuery->whereDoesntHave('attendances', function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
                });
            } else {
                // Users who have specific attendance type (checkin/checkout)
                $usersQuery->whereHas('attendances', function ($query) use ($attendanceType, $dateFrom, $dateTo) {
                    $query->where('type', $attendanceType)
                        ->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
                });
            }
        }

        // Handle export request
        if ($request->has('export')) {
            return $this->exportAttendanceData($usersQuery, $dateFrom, $dateTo, $request->input('export'));
        }

        // Get paginated results
        $users = $usersQuery->paginate(15);

        // Calculate statistics for the filtered period
        $stats = $this->calculateAttendanceStats($dateFrom, $dateTo, $search);

        return view('dashboard.attendance.index', compact('users', 'stats', 'dateFrom', 'dateTo'));
    }

    /**
     * Show detailed attendance for a specific user
     */
    public function userDetails(Request $request, $userId)
    {
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
        ]);

        $user = User::findOrFail($userId);

        $dateFrom = $request->input('date_from', Carbon::today()->subDays(30)->toDateString());
        $dateTo = $request->input('date_to', Carbon::today()->toDateString());

        // Get detailed attendance records
        $attendances = Attendance::where('employee_id', $userId)
            ->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo])
            ->orderBy('timestamp', 'desc')
            ->paginate(20);

        // Calculate user statistics
        $userStats = $this->calculateUserStats($userId, $dateFrom, $dateTo);

        return view('dashboard.attendance.user-details', compact(
            'user',
            'attendances',
            'userStats',
            'dateFrom',
            'dateTo'
        ));
    }

    /**
     * Store new attendance record
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'type' => 'required|in:checkin,checkout',
            'timestamp' => 'nullable|date',
            'notes' => 'nullable|string|max:500'
        ]);

        $attendance = Attendance::create([
            'employee_id' => $request->employee_id,
            'type' => $request->type,
            'timestamp' => $request->timestamp ?? now(),
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الحضور بنجاح',
            'data' => $attendance
        ]);
    }

    /**
     * Bulk import attendance data
     */
    public function bulkImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:10240', // Max 10MB
        ]);

        try {
            $file = $request->file('file');
            $importedRecords = $this->processAttendanceFile($file);

            return response()->json([
                'success' => true,
                'message' => "تم استيراد {$importedRecords} سجل بنجاح",
                'imported_count' => $importedRecords
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء استيراد الملف: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Calculate attendance statistics for the given period
     */
    private function calculateAttendanceStats($dateFrom, $dateTo, $search = null)
    {
        // Base query for users
        $usersQuery = User::query();

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }

        $totalUsers = $usersQuery->count();

        // Users with check-in records
        $usersWithCheckin = (clone $usersQuery)->whereHas('attendances', function ($query) use ($dateFrom, $dateTo) {
            $query->where('type', 'checkin')
                ->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
        })->count();

        // Users with check-out records
        $usersWithCheckout = (clone $usersQuery)->whereHas('attendances', function ($query) use ($dateFrom, $dateTo) {
            $query->where('type', 'checkout')
                ->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo]);
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

    /**
     * Calculate statistics for a specific user
     */
    private function calculateUserStats($userId, $dateFrom, $dateTo)
    {
        $attendances = Attendance::where('employee_id', $userId)
            ->whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo])
            ->get();

        $checkinCount = $attendances->where('type', 'checkin')->count();
        $checkoutCount = $attendances->where('type', 'checkout')->count();

        // Calculate total working days in the period
        $startDate = Carbon::parse($dateFrom);
        $endDate = Carbon::parse($dateTo);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Exclude weekends (optional - adjust based on your business rules)
        $workingDays = 0;
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            if (!$date->isWeekend()) {
                $workingDays++;
            }
        }

        // Calculate average working hours
        $totalWorkingHours = 0;
        $daysWithBothRecords = 0;

        $attendancesByDate = $attendances->groupBy(function ($attendance) {
            return Carbon::parse($attendance->timestamp)->toDateString();
        });

        foreach ($attendancesByDate as $date => $dayAttendances) {
            $checkin = $dayAttendances->where('type', 'checkin')->first();
            $checkout = $dayAttendances->where('type', 'checkout')->first();

            if ($checkin && $checkout) {
                $checkinTime = Carbon::parse($checkin->timestamp);
                $checkoutTime = Carbon::parse($checkout->timestamp);
                $workingHours = $checkoutTime->diffInHours($checkinTime);
                $totalWorkingHours += $workingHours;
                $daysWithBothRecords++;
            }
        }

        $averageWorkingHours = $daysWithBothRecords > 0 ? round($totalWorkingHours / $daysWithBothRecords, 1) : 0;

        return [
            'total_days' => $totalDays,
            'working_days' => $workingDays,
            'checkin_count' => $checkinCount,
            'checkout_count' => $checkoutCount,
            'attendance_rate' => $workingDays > 0 ? round(($checkinCount / $workingDays) * 100, 1) : 0,
            'average_working_hours' => $averageWorkingHours,
            'total_working_hours' => $totalWorkingHours
        ];
    }

    /**
     * Export attendance data
     */
    private function exportAttendanceData($usersQuery, $dateFrom, $dateTo, $format = 'csv')
    {
        $users = $usersQuery->get();

        $headers = [
            'المعرف',
            'الاسم',
            'البريد الإلكتروني',
            'تاريخ التسجيل',
            'نوع الحضور',
            'وقت التسجيل',
            'التاريخ'
        ];

        $data = [];

        foreach ($users as $user) {
            if ($user->attendances->isEmpty()) {
                // User with no attendance records
                $data[] = [
                    $user->id,
                    $user->name,
                    $user->email,
                    '',
                    'لم يسجل',
                    '',
                    "{$dateFrom} - {$dateTo}"
                ];
            } else {
                // User with attendance records
                foreach ($user->attendances as $attendance) {
                    $data[] = [
                        $user->id,
                        $user->name,
                        $user->email,
                        $attendance->type === 'checkin' ? 'دخول' : 'خروج',
                        Carbon::parse($attendance->timestamp)->format('H:i'),
                        Carbon::parse($attendance->timestamp)->format('Y-m-d'),
                        Carbon::parse($attendance->timestamp)->format('Y-m-d H:i')
                    ];
                }
            }
        }

        // Create CSV content
        $csvContent = implode(',', $headers) . "\n";
        foreach ($data as $row) {
            $csvContent .= '"' . implode('","', $row) . '"' . "\n";
        }

        // Return download response
        $filename = "attendance_export_{$dateFrom}_to_{$dateTo}.csv";

        return response($csvContent)
            ->header('Content-Type', 'text/csv; charset=utf-8')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"")
            ->header('Cache-Control', 'max-age=0');
    }

    /**
     * Process uploaded attendance file
     */
    private function processAttendanceFile($file)
    {
        $path = $file->store('temp');
        $fullPath = storage_path('app/' . $path);

        $importedCount = 0;

        try {
            if ($file->getClientOriginalExtension() === 'csv') {
                $importedCount = $this->processCsvFile($fullPath);
            } else {
                $importedCount = $this->processExcelFile($fullPath);
            }
        } finally {
            // Clean up temporary file
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        return $importedCount;
    }

    /**
     * Process CSV file
     */
    private function processCsvFile($filePath)
    {
        $importedCount = 0;

        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle); // Skip header row

            while (($data = fgetcsv($handle)) !== false) {
                try {
                    // Expected columns: employee_id, type, timestamp
                    $employeeId = trim($data[0]);
                    $type = trim($data[1]);
                    $timestamp = trim($data[2]);

                    // Validate data
                    if (!$employeeId || !in_array($type, ['checkin', 'checkout']) || !$timestamp) {
                        continue;
                    }

                    // Check if user exists
                    if (!User::find($employeeId)) {
                        continue;
                    }

                    // Create attendance record
                    Attendance::create([
                        'employee_id' => $employeeId,
                        'type' => $type,
                        'timestamp' => Carbon::parse($timestamp),
                    ]);

                    $importedCount++;
                } catch (\Exception $e) {
                    // Skip invalid rows
                    continue;
                }
            }

            fclose($handle);
        }

        return $importedCount;
    }

    /**
     * Process Excel file (requires PhpSpreadsheet)
     */
    private function processExcelFile($filePath)
    {
        // This would require PhpSpreadsheet library
        // For now, return 0 or implement based on your Excel processing needs
        return 0;
    }

    /**
     * Get attendance summary report
     */
    public function report(Request $request)
    {
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'report_type' => 'nullable|in:daily,weekly,monthly'
        ]);

        $dateFrom = $request->input('date_from', Carbon::today()->subDays(30)->toDateString());
        $dateTo = $request->input('date_to', Carbon::today()->toDateString());
        $reportType = $request->input('report_type', 'daily');

        $reportData = $this->generateAttendanceReport($dateFrom, $dateTo, $reportType);

        return view('dashboard.attendance.report', compact('reportData', 'dateFrom', 'dateTo', 'reportType'));
    }

    /**
     * Generate attendance report data
     */
    private function generateAttendanceReport($dateFrom, $dateTo, $reportType)
    {
        $startDate = Carbon::parse($dateFrom);
        $endDate = Carbon::parse($dateTo);

        $reportData = [];

        // This is a simplified version - you can expand based on your reporting needs
        $attendances = Attendance::whereBetween(DB::raw('DATE(timestamp)'), [$dateFrom, $dateTo])
            ->with('user')
            ->get();

        switch ($reportType) {
            case 'daily':
                $reportData = $this->generateDailyReport($attendances, $startDate, $endDate);
                break;
            case 'weekly':
                $reportData = $this->generateWeeklyReport($attendances, $startDate, $endDate);
                break;
            case 'monthly':
                $reportData = $this->generateMonthlyReport($attendances, $startDate, $endDate);
                break;
        }

        return $reportData;
    }

    /**
     * Generate daily attendance report
     */
    private function generateDailyReport($attendances, $startDate, $endDate)
    {
        $dailyData = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateString = $date->toDateString();
            $dayAttendances = $attendances->filter(function ($attendance) use ($dateString) {
                return Carbon::parse($attendance->timestamp)->toDateString() === $dateString;
            });

            $checkins = $dayAttendances->where('type', 'checkin')->count();
            $checkouts = $dayAttendances->where('type', 'checkout')->count();

            $dailyData[] = [
                'date' => $dateString,
                'day_name' => $date->format('l'),
                'checkins' => $checkins,
                'checkouts' => $checkouts,
                'attendance_rate' => $checkins > 0 ? round(($checkouts / $checkins) * 100, 1) : 0
            ];
        }

        return $dailyData;
    }

    /**
     * Generate weekly attendance report
     */
    private function generateWeeklyReport($attendances, $startDate, $endDate)
    {
        // Implementation for weekly report
        return [];
    }

    /**
     * Generate monthly attendance report
     */
    private function generateMonthlyReport($attendances, $startDate, $endDate)
    {
        // Implementation for monthly report
        return [];
    }
}
