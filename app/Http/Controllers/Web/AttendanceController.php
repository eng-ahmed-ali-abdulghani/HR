<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
        $usersQuery = User::query()->select(['users.id','users.fingerprint_employee_id',  'users.name', 'users.email', 'users.created_at'])->with(['attendances']);
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

    public function store(Request $request)
    {
        $request->validate(['excel_file' => 'required|mimes:xlsx,xls|max:10240']);

        DB::beginTransaction();

        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            $data = $worksheet->rangeToArray('A1:' . $highestColumn . $highestRow, null, true, true, true);

            $successCount = 0;
            $errorCount = 0;
            $skippedCount = 0;
            $errors = [];

            foreach (array_slice($data, 1) as $rowIndex => $value) {
                $actualRowNumber = $rowIndex + 2; // Excel row number (starting from 2)
                // Skip empty rows
                if (empty($value['A']) && empty($value['B']) && empty($value['C'])) {
                    continue;
                }

                $result = $this->saveAttendances($value['B'], $value['A'], $value['C']);

                if ($result['status'] === 'error') {
                    $errorCount++;
                    $errors[] = [
                        'row' => $actualRowNumber,
                        'fingerprint_id' => $value['A'] ?? 'N/A',
                        'date' => $value['B'] ?? 'N/A',
                        'type' => $value['C'] ?? 'N/A',
                        'message' => $result['message']
                    ];

                    // If too many errors, rollback and return
                    if ($errorCount > 0) { // Limit to prevent overwhelming response
                        DB::rollBack();
                        return response()->json([
                            'status' => 'error',
                            'message' => 'تم إيقاف المعالجة بسبب وجود أخطاء  في الملف',
                            'errors' => $errors,
                            'processed_rows' => $actualRowNumber - 1
                        ], 400);
                    }
                } elseif ($result['status'] === 'exists') {
                    $skippedCount++;
                } else {
                    $successCount++;
                }
            }

            if ($errorCount === 0) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => "تم رفع الملف بنجاح. تم إضافة {$successCount} سجل جديد وتم تخطي {$skippedCount} سجل موجود مسبقاً",
                    'stats' => [
                        'success' => $successCount,
                        'skipped' => $skippedCount,
                        'errors' => $errorCount
                    ]
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => 'partial_error',
                    'message' => "تم العثور على {$errorCount} خطأ في الملف",
                    'errors' => $errors,
                    'stats' => [
                        'success' => $successCount,
                        'skipped' => $skippedCount,
                        'errors' => $errorCount
                    ]
                ], 400);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'خطأ أثناء قراءة الملف: ' . $e->getMessage()
            ], 500);
        }
    }

    private function saveAttendances($dateString, $fingerprint_employee_id, $type)
    {
        // التحقق من وجود البيانات المطلوبة
        if (empty($fingerprint_employee_id) || empty($dateString) || empty($type)) {
            return [
                'status' => 'error',
                'message' => 'بيانات مفقودة: رقم البصمة، التاريخ، أو نوع الحضور'
            ];
        }

        // 1. جلب المستخدم بناءً على رقم البصمة
        $user = User::where('fingerprint_employee_id', $fingerprint_employee_id)->first();

        if (!$user) {
            return [
                'status' => 'error',
                'message' => "المستخدم غير موجود برقم البصمة: {$fingerprint_employee_id}"
            ];
        }

        // 2. تحديد نوع الحضور بناءً على القيمة المستلمة
        $formattedType = match (strtoupper(trim($type))) {
            'I' => 'checkin',
            'O' => 'checkout',
            default => null,
        };

        if (!$formattedType) {
            return [
                'status' => 'error',
                'message' => "نوع حضور غير صالح '{$type}' لرقم البصمة: {$fingerprint_employee_id}"
            ];
        }

        // 3. محاولة تحويل التاريخ إلى كائن Carbon
        try {
            // Try different date formats
            $formats = ['m/d/Y H:i', 'd/m/Y H:i', 'Y-m-d H:i:s', 'Y-m-d H:i'];
            $timestamp = null;

            foreach ($formats as $format) {
                try {
                    $timestamp = Carbon::createFromFormat($format, trim($dateString));
                    break;
                } catch (\Exception $e) {
                    continue;
                }
            }

            if (!$timestamp) {
                throw new \Exception("Unable to parse date");
            }

            if ($timestamp->greaterThan(Carbon::now())) {
                return [
                    'status' => 'error',
                    'message' => "التاريخ لا يمكن أن يكون في المستقبل '{$dateString}' لرقم البصمة: {$fingerprint_employee_id}"
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => "تنسيق التاريخ غير صالح '{$dateString}' لرقم البصمة: {$fingerprint_employee_id}"
            ];
        }

        // 4. التحقق من وجود نفس السجل مسبقًا
        $exists = Attendance::where('employee_id', $user->id)->where('timestamp', $timestamp)->where('type', $formattedType)->exists();

        if ($exists) {
            return [
                'status' => 'exists',
                'message' => "سجل الحضور موجود مسبقاً لرقم البصمة: {$fingerprint_employee_id}"
            ];
        }

        // 5. إنشاء سجل الحضور
        try {
            Attendance::create([
                'employee_id' => $user->id,
                'timestamp' => $timestamp,
                'type' => $formattedType
            ]);

            return [
                'status' => 'success',
                'message' => "تم تسجيل الحضور بنجاح لرقم البصمة: {$fingerprint_employee_id}"
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => "فشل في حفظ سجل الحضور لرقم البصمة {$fingerprint_employee_id}: " . $e->getMessage()
            ];
        }
    }


}
