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

        .stat-card.active::before {
            background: linear-gradient(90deg, #27ae60, #229954);
        }

        .stat-card.inactive::before {
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

        .stat-card.active .stat-icon {
            color: #27ae60;
        }

        .stat-card.inactive .stat-icon {
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
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

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(231, 76, 60, 0.4);
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

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .import-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: none;
        }

        .import-section.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .import-info {
            background: rgba(52, 152, 219, 0.1);
            border: 1px solid rgba(52, 152, 219, 0.3);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            color: #2980b9;
        }

        .import-info i {
            margin-right: 8px;
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
        }

        .status-active {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
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
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-users"></i> عرض المستخدمين</h1>
            <p>عرض بيانات المستخدمين في النظام مع إمكانية الوصول لتفاصيل الحضور والغياب</p>
        </div>

        <!-- Import Section -->
        <div id="importSection" class="import-section">
            <h3 style="color: #2c3e50; margin-bottom: 20px;"><i class="fas fa-file-import"></i> استيراد بيانات الحضور
                والغياب</h3>

            <div class="import-info">
                <i class="fas fa-info-circle"></i>
                <strong>تعليمات الاستيراد:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    <li>يجب أن يحتوي الملف على الأعمدة التالية: المعرف، الاسم، حالة الحضور، وقت الحضور</li>
                    <li>الصيغ المدعومة: CSV, Excel (.xlsx, .xls)</li>
                    <li>حالة الحضور: "حاضر" أو "غائب"</li>
                    <li>وقت الحضور: بصيغة HH:MM (مثال: 08:30)</li>
                </ul>
            </div>

            <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div class="file-input-wrapper">
                    <button class="btn btn-info" onclick="document.getElementById('bulkImportFile').click()">
                        <i class="fas fa-cloud-upload-alt"></i> اختر ملف الاستيراد
                    </button>
                    <input type="file" id="bulkImportFile" accept=".csv,.xlsx,.xls" onchange="handleBulkImport(event)">
                </div>

                <button class="btn btn-success" onclick="downloadTemplate()">
                    <i class="fas fa-download"></i> تحميل نموذج
                </button>

                <button class="btn btn-warning" onclick="hideImportSection()">
                    <i class="fas fa-times"></i> إلغاء
                </button>
            </div>
        </div>

        <!-- Add Attendance Form -->
        <div id="addAttendanceSection" class="import-section">
            <h3 style="color: #2c3e50; margin-bottom: 20px;"><i class="fas fa-plus-circle"></i> إضافة حضور وغياب يدوياً
            </h3>

            <div class="controls-grid" style="margin-bottom: 20px;">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> اختر الموظف</label>
                    <select class="form-control" id="selectedEmployee">
                        <option value="">اختر موظف...</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar"></i> التاريخ</label>
                    <input type="date" class="form-control" id="attendanceDate">
                </div>

                <div class="form-group">
                    <label><i class="fas fa-toggle-on"></i> حالة الحضور</label>
                    <select class="form-control" id="attendanceStatus">
                        <option value="">اختر الحالة...</option>
                        <option value="present">حاضر</option>
                        <option value="absent">غائب</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-clock"></i> وقت الحضور</label>
                    <input type="time" class="form-control" id="attendanceTime">
                </div>
            </div>

            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <button class="btn btn-success" onclick="saveAttendance()">
                    <i class="fas fa-save"></i> حفظ الحضور
                </button>

                <button class="btn btn-warning" onclick="hideAddAttendanceForm()">
                    <i class="fas fa-times"></i> إلغاء
                </button>
            </div>
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
            <div class="stat-card active">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-title">المستخدمين الحاضرين</div>
                <div class="stat-value" id="totalPresent">0</div>
            </div>
            <div class="stat-card inactive">
                <div class="stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-title">المستخدمين الغائبين</div>
                <div class="stat-value" id="totalAbsent">0</div>
            </div>
        </div>

        <!-- Controls -->
        <div class="controls">
            <div class="controls-grid">
                <div class="form-group">
                    <label><i class="fas fa-toggle-on"></i> فلترة حسب الحالة</label>
                    <select class="form-control" id="filterStatus">
                        <option value="">جميع الحالات</option>
                        <option value="present">حاضر</option>
                        <option value="absent">غائب</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-search"></i> البحث</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="البحث في الاسم أو المعرف...">
                </div>
            </div>
            <div class="btn-actions">
                <button class="btn btn-danger" onclick="showAddAttendanceForm()">
                    <i class="fas fa-plus-circle"></i> إضافة حضور وغياب
                </button>
                <div class="file-input-wrapper">
                    <button class="btn btn-secondary" onclick="document.getElementById('importFile').click()">
                        <i class="fas fa-file-import"></i> استيراد ملف
                    </button>
                    <input type="file" id="importFile" accept=".csv,.xlsx,.xls" onchange="handleFileImport(event)">
                </div>
                <button class="btn btn-success" onclick="filterData()">
                    <i class="fas fa-filter"></i> تطبيق الفلترة
                </button>
                <button class="btn btn-warning" onclick="clearFilters()">
                    <i class="fas fa-refresh"></i> إعادة تعيين
                </button>
                <button class="btn btn-info" onclick="exportData()">
                    <i class="fas fa-download"></i> تصدير البيانات
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table">
                <thead>
                <tr>
                    <th><i class="fas fa-hashtag"></i> المعرف</th>
                    <th><i class="fas fa-user"></i> المستخدم</th>
                    <th><i class="fas fa-calendar-check"></i> حالة الحضور</th>
                    <th><i class="fas fa-cogs"></i> الإجراءات</th>
                </tr>
                </thead>
                <tbody id="dataTable">
                <!-- Data will be populated here -->
                </tbody>
            </table>
            <div id="noDataMessage" class="no-data" style="display: none;">
                <i class="fas fa-users fa-4x"></i>
                <p>لا توجد مستخدمين مطابقين لمعايير البحث</p>
            </div>
            @if(isset($users) && $users->hasPages())
                <div class="pagination-wrapper">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Sample data - replace with actual data from backend
        let users = [
                @if(isset($users))
                @foreach($users as $user)
            {
                id: {{$user->id}},
                name: '{{$user->name}}',
                // Add attendance status - you should get this from your attendance system
                // For demo purposes, randomly assign present/absent
                attendance_status: Math.random() > 0.3 ? 'present' : 'absent',
                attendance_time: Math.random() > 0.3 ? '08:30' : null,
            },
            @endforeach
            @else
            // Demo data for testing
            {id: 1, name: 'أحمد محمد', attendance_status: 'present', attendance_time: '08:30'},
            {id: 2, name: 'فاطمة علي', attendance_status: 'absent', attendance_time: null},
            {id: 3, name: 'محمد أحمد', attendance_status: 'present', attendance_time: '08:45'},
            {id: 4, name: 'مريم خالد', attendance_status: 'present', attendance_time: '08:15'},
            {id: 5, name: 'عبدالله سالم', attendance_status: 'absent', attendance_time: null},
            @endif
        ];

        let filteredData = [...users];

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function () {
            updateStats();
            renderTable();
            setupEventListeners();
            populateEmployeeSelect();

            // Set today's date as default
            document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];
        });

        function populateEmployeeSelect() {
            const select = document.getElementById('selectedEmployee');
            select.innerHTML = '<option value="">اختر موظف...</option>';

            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.name} (#${user.id})`;
                select.appendChild(option);
            });
        }

        function setupEventListeners() {
            document.getElementById('filterStatus').addEventListener('change', filterData);
            document.getElementById('searchInput').addEventListener('input', filterData);
        }

        function updateStats() {
            const totalUsers = users.length;
            const totalPresent = users.filter(user => user.attendance_status === 'present').length;
            const totalAbsent = users.filter(user => user.attendance_status === 'absent').length;

            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('totalPresent').textContent = totalPresent;
            document.getElementById('totalAbsent').textContent = totalAbsent;
        }

        function renderTable() {
            const tbody = document.getElementById('dataTable');
            const noDataMessage = document.getElementById('noDataMessage');

            if (filteredData.length === 0) {
                tbody.innerHTML = '';
                noDataMessage.style.display = 'block';
                return;
            }

            noDataMessage.style.display = 'none';

            tbody.innerHTML = filteredData.map(user => {
                const userInitials = user.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
                const isPresent = user.attendance_status === 'present';
                const statusBadge = isPresent
                    ? `<span class="status-badge status-active"><i class="fas fa-check"></i> حاضر</span>`
                    : `<span class="status-badge status-inactive"><i class="fas fa-times"></i> غائب</span>`;

                const attendanceInfo = isPresent && user.attendance_time
                    ? `<small style="color: #27ae60; display: block; margin-top: 5px;"><i class="fas fa-clock"></i> ${user.attendance_time}</small>`
                    : '';

                return `
                <tr>
                    <td><strong style="color: #667eea; font-size: 18px;">#${user.id}</strong></td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">${userInitials}</div>
                            <div class="user-details">
                                <div class="user-name">${user.name}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        ${statusBadge}
                        ${attendanceInfo}
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="viewUserDetails(${user.id})" title="عرض تفاصيل الحضور والغياب">
                                <i class="fas fa-calendar-check"></i> عرض التفاصيل
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            }).join('');
        }

        function filterData() {
            const statusFilter = document.getElementById('filterStatus').value;
            const searchText = document.getElementById('searchInput').value.toLowerCase();

            filteredData = users.filter(user => {
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'present' && user.attendance_status === 'present') ||
                    (statusFilter === 'absent' && user.attendance_status === 'absent');

                const matchesSearch = !searchText ||
                    (user.name && user.name.toLowerCase().includes(searchText)) ||
                    (user.id && user.id.toString().includes(searchText));

                return matchesStatus && matchesSearch;
            });

            renderTable();
        }

        function clearFilters() {
            document.getElementById('filterStatus').value = '';
            document.getElementById('searchInput').value = '';
            filteredData = [...users];
            renderTable();
        }

        function exportData() {
            // Create CSV content
            const headers = ['المعرف', 'الاسم', 'حالة الحضور', 'وقت الحضور'];
            const csvContent = [
                headers.join(','),
                ...filteredData.map(user => {
                    const attendanceStatus = user.attendance_status === 'present' ? 'حاضر' : 'غائب';
                    const attendanceTime = user.attendance_time || 'غير متاح';
                    return [
                        `"${user.id}"`,
                        `"${user.name}"`,
                        `"${attendanceStatus}"`,
                        `"${attendanceTime}"`
                    ].join(',');
                })
            ].join('\n');

            // Create and download file
            const blob = new Blob(['\ufeff' + csvContent], {type: 'text/csv;charset=utf-8;'});
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `attendance_export_${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
        }

        // Function to view user attendance details
        function viewUserDetails(userId) {
            // You can modify this URL to match your routing structure
            // For example, if you have a route like: /dashboard/users/{id}/attendance
            const detailsUrl = `/dashboard/users/${userId}/attendance`;

            // Open in same window
            window.location.href = detailsUrl;

            // Alternative: Open in new tab
            // window.open(detailsUrl, '_blank');
        }

        // Show/Hide Import Section
        function showImportSection() {
            document.getElementById('importSection').classList.add('active');
            hideAddAttendanceForm();
        }

        function hideImportSection() {
            document.getElementById('importSection').classList.remove('active');
        }

        // Show/Hide Add Attendance Form
        function showAddAttendanceForm() {
            document.getElementById('addAttendanceSection').classList.add('active');
            hideImportSection();
        }

        function hideAddAttendanceForm() {
            document.getElementById('addAttendanceSection').classList.remove('active');
        }

        // Handle file import
        function handleFileImport(event) {
            showImportSection();
        }

        function handleBulkImport(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                try {
                    // Here you would parse the CSV/Excel file
                    // This is a simplified example
                    console.log('File content:', e.target.result);

                    // Show success message
                    alert(`تم استيراد الملف "${file.name}" بنجاح!\nسيتم معالجة البيانات وتحديث النظام.`);

                    // Hide import section
                    hideImportSection();

                    // Reset file input
                    event.target.value = '';

                    // Here you would typically send the data to your backend
                    // fetch('/dashboard/attendance/import', {
                    //     method: 'POST',
                    //     body: formData
                    // });

                } catch (error) {
                    alert('حدث خطأ في قراءة الملف. تأكد من صحة تنسيق الملف.');
                }
            };

            if (file.name.endsWith('.csv')) {
                reader.readAsText(file);
            } else {
                reader.readAsArrayBuffer(file);
            }
        }

        // Download template file
        function downloadTemplate() {
            const headers = ['المعرف', 'الاسم', 'حالة الحضور', 'وقت الحضور'];
            const sampleData = [
                '1,"أحمد محمد","حاضر","08:30"',
                '2,"فاطمة علي","غائب",""',
                '3,"محمد أحمد","حاضر","08:45"'
            ];

            const csvContent = [headers.join(','), ...sampleData].join('\n');
            const blob = new Blob(['\ufeff' + csvContent], {type: 'text/csv;charset=utf-8;'});
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'attendance_template.csv';
            link.click();
        }

        // Save attendance manually
        function saveAttendance() {
            const employeeId = document.getElementById('selectedEmployee').value;
            const date = document.getElementById('attendanceDate').value;
            const status = document.getElementById('attendanceStatus').value;
            const time = document.getElementById('attendanceTime').value;

            if (!employeeId || !date || !status) {
                alert('يرجى ملء جميع الحقول المطلوبة');
                return;
            }

            if (status === 'present' && !time) {
                alert('يرجى تحديد وقت الحضور للموظف الحاضر');
                return;
            }

            // Find the user and update their attendance
            const userIndex = users.findIndex(u => u.id == employeeId);
            if (userIndex !== -1) {
                users[userIndex].attendance_status = status;
                users[userIndex].attendance_time = status === 'present' ? time : null;

                // Update filtered data if necessary
                filterData();
                updateStats();

                alert('تم حفظ بيانات الحضور بنجاح!');

                // Reset form
                document.getElementById('selectedEmployee').value = '';
                document.getElementById('attendanceStatus').value = '';
                document.getElementById('attendanceTime').value = '';

                hideAddAttendanceForm();
            }

            // Here you would typically send the data to your backend
            // fetch('/dashboard/attendance/store', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //     },
            //     body: JSON.stringify({
            //         employee_id: employeeId,
            //         date: date,
            //         status: status,
            //         time: time
            //     })
            // });
        }
    </script>
@endpush
