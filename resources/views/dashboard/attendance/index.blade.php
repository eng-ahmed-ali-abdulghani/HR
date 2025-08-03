@extends('dashboard.layouts.app')

@section('title', 'نظام عرض المستخدمين')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        }

        .header h1 {
            font-size: 2.8em;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 12px;
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            text-align: center;
            color: #7f8c8d;
            font-size: 1.2em;
            font-weight: 500;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .stat-card.total::before {
            background: linear-gradient(90deg, #3498db, #2980b9);
        }

        .stat-card.checkin::before {
            background: linear-gradient(90deg, #27ae60, #229954);
        }

        .stat-card.checkout::before {
            background: linear-gradient(90deg, #f39c12, #e67e22);
        }

        .stat-card.absent::before {
            background: linear-gradient(90deg, #e74c3c, #c0392b);
        }

        .stat-icon {
            font-size: 3.2em;
            margin-bottom: 18px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-card.total .stat-icon {
            color: #3498db;
        }

        .stat-card.checkin .stat-icon {
            color: #27ae60;
        }

        .stat-card.checkout .stat-icon {
            color: #f39c12;
        }

        .stat-card.absent .stat-icon {
            color: #e74c3c;
        }

        .stat-title {
            font-size: 1.3em;
            color: #2c3e50;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .stat-value {
            font-size: 2.2em;
            font-weight: 800;
            color: #34495e;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .controls {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .controls-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 10px;
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.95em;
        }

        .form-control {
            padding: 15px 18px;
            border: 2px solid #e8ecf1;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(39, 174, 96, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(243, 156, 18, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(52, 152, 219, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            padding: 8px 16px;
            font-size: 13px;
        }

        .btn-primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
            box-shadow: 0 8px 25px rgba(149, 165, 166, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(149, 165, 166, 0.4);
        }

        .btn-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table th,
        .table td {
            padding: 18px 15px;
            text-align: center;
            border-bottom: 1px solid #f1f3f4;
            font-size: 15px;
            vertical-align: middle;
        }

        .table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 700;
            position: sticky;
            top: 0;
            z-index: 10;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .table tr {
            transition: all 0.3s ease;
        }

        .table tr:hover {
            background: rgba(102, 126, 234, 0.08);
            transform: scale(1.01);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            margin-right: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .user-info {
            display: flex;
            align-items: center;
            text-align: left;
            justify-content: flex-start;
            min-width: 200px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 4px;
            font-size: 16px;
        }

        .user-id {
            font-size: 13px;
            color: #7f8c8d;
            font-style: italic;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin: 2px;
            display: inline-block;
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

        .attendance-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .time-badge {
            font-size: 11px;
            color: #7f8c8d;
            background: rgba(0, 0, 0, 0.05);
            padding: 3px 8px;
            border-radius: 10px;
            display: inline-block;
        }

        .no-data {
            text-align: center;
            color: #7f8c8d;
            font-size: 1.3em;
            padding: 60px;
        }

        .no-data i {
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .date-range-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .table {
                width: 1200px;
            }

            .header h1 {
                font-size: 2.2em;
            }

            .controls-grid {
                grid-template-columns: 1fr;
            }

            .btn-actions {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn-primary {
                font-size: 12px;
                padding: 6px 12px;
            }

            .date-range-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-users"></i> عرض المستخدمين والحضور</h1>
            <p>عرض بيانات المستخدمين في النظام مع إمكانية الوصول لتفاصيل الحضور والغياب</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-title">إجمالي المستخدمين</div>
                <div class="stat-value" id="totalUsers">0</div>
            </div>
            <div class="stat-card checkin">
                <div class="stat-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="stat-title">تسجيل دخول اليوم</div>
                <div class="stat-value" id="totalCheckin">0</div>
            </div>
            <div class="stat-card checkout">
                <div class="stat-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="stat-title">تسجيل خروج اليوم</div>
                <div class="stat-value" id="totalCheckout">0</div>
            </div>
            <div class="stat-card absent">
                <div class="stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-title">لم يسجل دخول</div>
                <div class="stat-value" id="totalAbsent">0</div>
            </div>
        </div>

        <!-- Controls -->
        <div class="controls">
            <form method="GET" action="{{ route('dashboard.attendance.index') }}" id="filterForm">
                <div class="controls-grid">
                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt"></i> من تاريخ</label>
                        <input type="date" class="form-control" name="date_from" id="dateFrom"
                               value="{{ request('date_from', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar-alt"></i> إلى تاريخ</label>
                        <input type="date" class="form-control" name="date_to" id="dateTo"
                               value="{{ request('date_to', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-toggle-on"></i> نوع التسجيل</label>
                        <select class="form-control" name="attendance_type" id="attendanceType">
                            <option value="">جميع الأنواع</option>
                            <option value="checkin" {{ request('attendance_type') == 'checkin' ? 'selected' : '' }}>تسجيل دخول</option>
                            <option value="checkout" {{ request('attendance_type') == 'checkout' ? 'selected' : '' }}>تسجيل خروج</option>
                            <option value="absent" {{ request('attendance_type') == 'absent' ? 'selected' : '' }}>لم يسجل</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-search"></i> البحث</label>
                        <input type="text" class="form-control" name="search" id="searchInput"
                               placeholder="البحث في الاسم أو المعرف..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="btn-actions">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-filter"></i> تطبيق الفلترة
                    </button>
                    <button type="button" class="btn btn-warning" onclick="clearFilters()">
                        <i class="fas fa-refresh"></i> إعادة تعيين
                    </button>
                    <button type="button" class="btn btn-info" onclick="exportData()">
                        <i class="fas fa-file-export"></i> تصدير البيانات
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table">
                <thead>
                <tr>
                    <th><i class="fas fa-hashtag"></i> المعرف</th>
                    <th><i class="fas fa-user"></i> المستخدم</th>
                    <th><i class="fas fa-calendar-check"></i> حالة الحضور</th>
                    <th><i class="fas fa-clock"></i> آخر نشاط</th>
                    <th><i class="fas fa-cogs"></i> الإجراءات</th>
                </tr>
                </thead>
                <tbody id="dataTable">
                @forelse($users as $user)
                    <tr>
                        <td><strong style="color: #667eea; font-size: 18px;">#{{ $user->id }}</strong></td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-id">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="attendance-details">
                                @php
                                    $todayAttendances = $user->attendances()
                                        ->whereDate('timestamp', request('date_from', date('Y-m-d')))
                                        ->when(request('date_to'), function($query) {
                                            return $query->whereDate('timestamp', '<=', request('date_to'));
                                        })
                                        ->orderBy('timestamp', 'desc')
                                        ->get();

                                    $hasCheckin = $todayAttendances->where('type', 'checkin')->isNotEmpty();
                                    $hasCheckout = $todayAttendances->where('type', 'checkout')->isNotEmpty();
                                @endphp

                                @if($hasCheckin)
                                    <span class="status-badge status-checkin">
                                        <i class="fas fa-sign-in-alt"></i> دخول
                                    </span>
                                @endif

                                @if($hasCheckout)
                                    <span class="status-badge status-checkout">
                                        <i class="fas fa-sign-out-alt"></i> خروج
                                    </span>
                                @endif

                                @if(!$hasCheckin && !$hasCheckout)
                                    <span class="status-badge status-absent">
                                        <i class="fas fa-times"></i> لم يسجل
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @php
                                $lastAttendance = $todayAttendances->first();
                            @endphp
                            @if($lastAttendance)
                                <div class="time-badge">
                                    {{ $lastAttendance->timestamp->format('H:i') }}
                                </div>
                                <small style="color: #7f8c8d; display: block; margin-top: 5px;">
                                    {{ $lastAttendance->timestamp->format('Y-m-d') }}
                                </small>
                            @else
                                <span style="color: #e74c3c;">لم يسجل بعد</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-primary" onclick="viewUserDetails({{ $user->id }})"
                                        title="عرض تفاصيل الحضور والغياب">
                                    <i class="fas fa-calendar-check"></i> التفاصيل
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="no-data">
                                <i class="fas fa-users fa-4x"></i>
                                <p>لا توجد مستخدمين مطابقين لمعايير البحث</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-wrapper" style="margin-top: 30px; display: flex; justify-content: center;">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function () {
            updateStats();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Auto-submit form when date changes
            document.getElementById('dateFrom').addEventListener('change', function() {
                if (this.value && document.getElementById('dateTo').value) {
                    document.getElementById('filterForm').submit();
                }
            });

            document.getElementById('dateTo').addEventListener('change', function() {
                if (this.value && document.getElementById('dateFrom').value) {
                    document.getElementById('filterForm').submit();
                }
            });
        }

        function updateStats() {
            // Get stats from the current page data
            const rows = document.querySelectorAll('#dataTable tr');
            let totalUsers = rows.length;
            let totalCheckin = 0;
            let totalCheckout = 0;
            let totalAbsent = 0;

            rows.forEach(row => {
                const attendanceCell = row.cells[2];
                if (attendanceCell) {
                    const hasCheckin = attendanceCell.querySelector('.status-checkin');
                    const hasCheckout = attendanceCell.querySelector('.status-checkout');
                    const hasAbsent = attendanceCell.querySelector('.status-absent');

                    if (hasCheckin) totalCheckin++;
                    if (hasCheckout) totalCheckout++;
                    if (hasAbsent) totalAbsent++;
                }
            });

            // Handle empty state
            if (document.querySelector('.no-data')) {
                totalUsers = 0;
                totalCheckin = 0;
                totalCheckout = 0;
                totalAbsent = 0;
            }

            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('totalCheckin').textContent = totalCheckin;
            document.getElementById('totalCheckout').textContent = totalCheckout;
            document.getElementById('totalAbsent').textContent = totalAbsent;
        }

        function clearFilters() {
            // Reset all form fields
            document.getElementById('dateFrom').value = '{{ date("Y-m-d") }}';
            document.getElementById('dateTo').value = '{{ date("Y-m-d") }}';
            document.getElementById('attendanceType').value = '';
            document.getElementById('searchInput').value = '';

            // Submit the form to apply the reset
            document.getElementById('filterForm').submit();
        }

        function exportData() {
            // Create export URL with current filters
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            // Add export parameter
            params.append('export', 'csv');

            // Create download link
            const exportUrl = `{{ route('dashboard.attendance.index') }}?${params.toString()}`;

            // Create temporary link and click it
            const link = document.createElement('a');
            link.href = exportUrl;
            link.download = `attendance_export_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function viewUserDetails(userId) {
            // Get current date filters
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            // Build URL with date parameters
            let detailsUrl = `/dashboard/users/${userId}/attendance`;
            if (dateFrom) {
                detailsUrl += `?date_from=${dateFrom}`;
                if (dateTo) {
                    detailsUrl += `&date_to=${dateTo}`;
                }
            }

            window.location.href = detailsUrl;
        }

        // Quick date filters
        function setDateFilter(days) {
            const today = new Date();
            const fromDate = new Date(today);
            fromDate.setDate(today.getDate() - days);

            document.getElementById('dateFrom').value = fromDate.toISOString().split('T')[0];
            document.getElementById('dateTo').value = today.toISOString().split('T')[0];

            document.getElementById('filterForm').submit();
        }

        // Add quick filter buttons
        document.addEventListener('DOMContentLoaded', function() {
            const btnActions = document.querySelector('.btn-actions');

            // Create quick filter buttons
            const quickFilters = [
                { label: 'اليوم', days: 0 },
                { label: 'أمس', days: 1 },
                { label: 'آخر 7 أيام', days: 7 },
                { label: 'آخر 30 يوم', days: 30 }
            ];

            quickFilters.forEach(filter => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-secondary';
                btn.innerHTML = `<i class="fas fa-calendar"></i> ${filter.label}`;
                btn.onclick = () => {
                    if (filter.days === 0) {
                        document.getElementById('dateFrom').value = new Date().toISOString().split('T')[0];
                        document.getElementById('dateTo').value = new Date().toISOString().split('T')[0];
                    } else {
                        setDateFilter(filter.days);
                    }
                    document.getElementById('filterForm').submit();
                };
                btnActions.appendChild(btn);
            });
        });
    </script>
@endpush
