<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        // Build the users query with attendance data
        $usersQuery = User::query()->select(['users.id', 'users.name', 'users.email', 'users.created_at'])->with(['attendances']);
        // Get paginated results
        $users = $usersQuery->paginate(3);

        // Calculate statistics for the filtered period
        $stats = $this->calculateAttendanceStats(Carbon::today(), Carbon::today(), null);

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


    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls|max:10240'
        ]);

        try {
            $file = $request->file('excel_file');

            // قراءة الملف
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();

            // الحصول على أعلى صف وعمود يحتوي على بيانات
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            // تحويل البيانات إلى array
            $data = $worksheet->rangeToArray(
                'A1:' . $highestColumn . $highestRow,
                null,
                true,
                true,
                true
            );
            foreach ($data as $key => $value) {
              dd($key,$value);

            }


            // dd($highestRow,$highestColumn);
            return response()->json([
                'message' => 'تم رفع الملف بنجاح!',
                'rows' => $highestRow,
                'columns' => $highestColumn,
                'preview' => array_slice($data, 0, 5) // أول 5 صفوف للمعاينة
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'خطأ في قراءة الملف: ' . $e->getMessage()
            ], 400);
        }
    }


}
