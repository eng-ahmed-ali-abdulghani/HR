@extends('dashboard.layouts.app')

@section('title', 'تفاصيل حضور الموظف')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .back-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .employee-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .employee-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .employee-details h2 {
            color: #2c3e50;
            font-size: 1.8em;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .employee-details p {
            color: #7f8c8d;
            font-size: 1.1em;
            margin: 5px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .stat-card.total .stat-icon { color: #3498db; }
        .stat-card.present .stat-icon { color: #27ae60; }
        .stat-card.absent .stat-icon { color: #e74c3c; }
        .stat-card.late .stat-icon { color: #f39c12; }

        .stat-title {
            font-size: 1.1em;
            color: #2c3e50;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #34495e;
        }

        .filters {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e8ecf1;
            border-radius: 10px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-filter {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        .attendance-table {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #f1f3f4;
        }

        .table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        .table tr:hover {
            background: rgba(102, 126, 234, 0.05);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-checkin {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
        }

        .status-checkout {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .status-absent {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .time-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: center;
        }

        .time-badge {
            background: rgba(0, 0, 0, 0.05);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 11px;
            color: #666;
        }

        .no-data {
            text-align: center;
            color: #7f8c8d;
            padding: 60px 20px;
            font-size: 1.2em;
        }

        .no-data i {
            font-size: 4em;
            color: #bdc3c7;
            margin-bottom: 20px;
            display: block;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .employee-info {
                flex-direction: column;
                text-align: center;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .table {
                font-size: 14px;
            }

            .table th,
            .table td {
                padding: 10px 8px;
            }

            .header h1 {
                font-size: 2em;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>

    <div class="container">
        <!-- Back Button -->
        <a href="{{ route('attendance.index') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i>
            العودة للقائمة الرئيسية
        </a>

        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-calendar-check"></i> تفاصيل حضور الموظف</h1>
        </div>

        <!-- Employee Info -->
        <div class="employee-info">
            <div class="employee-avatar">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div class="employee-details">
                <h2>{{ $user->name }}</h2>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                <p><i class="fas fa-fingerprint"></i> رقم البصمة: {{ $user->fingerprint_employee_id }}</p>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-title">إجمالي أيام الحضور</div>
                <div class="stat-value">{{ $attendanceStats['total_days'] ?? 0 }}</div>
            </div>
            <div class="stat-card present">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-title">أيام الحضور</div>
                <div class="stat-value">{{ $attendanceStats['present_days'] ?? 0 }}</div>
            </div>
            <div class="stat-card absent">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-title">أيام الغياب</div>
                <div class="stat-value">{{ $attendanceStats['absent_days'] ?? 0 }}</div>
            </div>
            <div class="stat-card late">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-title">متوسط ساعات العمل</div>
                <div class="stat-value">{{ $attendanceStats['avg_hours'] ?? '0' }}</div>
            </div>
        </div>


        <!-- Attendance Table -->
        <div class="attendance-table">
            <h3 style="color: #2c3e50; margin-bottom: 20px;">
                <i class="fas fa-list"></i> سجل الحضور والغياب
            </h3>

            @if($attendances->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th><i class="fas fa-calendar"></i> التاريخ</th>
                        <th><i class="fas fa-sign-in-alt"></i> وقت الدخول</th>
                        <th><i class="fas fa-sign-out-alt"></i> وقت الخروج</th>
                        <th><i class="fas fa-hourglass-half"></i> إجمالي الساعات</th>
                        <th><i class="fas fa-info-circle"></i> الحالة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendances as $date => $dayAttendances)
                        @php
                            $checkin = $dayAttendances->where('type', 'checkin')->first();
                            $checkout = $dayAttendances->where('type', 'checkout')->first();
                            $totalHours = 0;

                            if($checkin && $checkout) {
                                $checkinTime = \Carbon\Carbon::parse($checkin->timestamp);
                                $checkoutTime = \Carbon\Carbon::parse($checkout->timestamp);
                                $totalHours = $checkoutTime->diffInHours($checkinTime);
                            }
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</strong>
                                <br>
                                <small style="color: #666;">
                                    {{ \Carbon\Carbon::parse($date)->locale('ar')->dayName }}
                                </small>
                            </td>
                            <td>
                                @if($checkin)
                                    <div class="time-info">
                                            <span class="status-badge status-checkin">
                                                {{ \Carbon\Carbon::parse($checkin->timestamp)->format('H:i') }}
                                            </span>
                                        <span class="time-badge">دخول</span>
                                    </div>
                                @else
                                    <span class="status-badge status-absent">لم يسجل</span>
                                @endif
                            </td>
                            <td>
                                @if($checkout)
                                    <div class="time-info">
                                            <span class="status-badge status-checkout">
                                                {{ \Carbon\Carbon::parse($checkout->timestamp)->format('H:i') }}
                                            </span>
                                        <span class="time-badge">خروج</span>
                                    </div>
                                @else
                                    <span class="status-badge status-absent">لم يسجل</span>
                                @endif
                            </td>
                            <td>
                                @if($checkin && $checkout)
                                    <strong style="color: #27ae60; font-size: 1.2em;">
                                        {{ $totalHours }} ساعة
                                    </strong>
                                @else
                                    <span style="color: #e74c3c;">--</span>
                                @endif
                            </td>
                            <td>
                                @if($checkin && $checkout)
                                    <span class="status-badge status-checkin">
                                            <i class="fas fa-check"></i> مكتمل
                                        </span>
                                @elseif($checkin && !$checkout)
                                    <span class="status-badge status-checkout">
                                            <i class="fas fa-exclamation"></i> لم يسجل خروج
                                        </span>
                                @else
                                    <span class="status-badge status-absent">
                                            <i class="fas fa-times"></i> غائب
                                        </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if($attendances instanceof \Illuminate\Pagination\LengthAwarePaginator && $attendances->hasPages())
                    <div style="margin-top: 30px; display: flex; justify-content: center;">
                        {{ $attendances->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="no-data">
                    <i class="fas fa-calendar-times"></i>
                    <p>لا توجد سجلات حضور لهذا الموظف في الفترة المحددة</p>
                    <small>جرب تغيير الفترة الزمنية للبحث</small>
                </div>
            @endif
        </div>
    </div>
@endsection
