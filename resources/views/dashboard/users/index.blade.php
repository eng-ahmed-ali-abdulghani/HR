@extends('dashboard.layouts.app')

@section('title', 'نظام إدارة المستخدمين')

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

        .stat-card.departments::before {
            background: linear-gradient(90deg, #e74c3c, #c0392b);
        }

        .stat-card.companies::before {
            background: linear-gradient(90deg, #27ae60, #229954);
        }

        .stat-card.managers::before {
            background: linear-gradient(90deg, #f39c12, #e67e22);
        }

        .stat-card.active::before {
            background: linear-gradient(90deg, #9b59b6, #8e44ad);
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

        .stat-card.departments .stat-icon {
            color: #e74c3c;
        }

        .stat-card.companies .stat-icon {
            color: #27ae60;
        }

        .stat-card.managers .stat-icon {
            color: #f39c12;
        }

        .stat-card.active .stat-icon {
            color: #9b59b6;
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

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
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

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(231, 76, 60, 0.4);
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

        .user-email {
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
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
        }

        .department-badge {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
        }

        .salary-display {
            font-weight: 700;
            color: #27ae60;
            font-size: 14px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
        }

        .modal-content {
            background: white;
            margin: 1% auto;
            padding: 0;
            border-radius: 25px;
            width: 95%;
            max-width: 900px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-height: 95vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 25px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.6em;
            font-weight: 700;
        }

        .close {
            color: white;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 35px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .form-section h3 {
            color: #495057;
            margin-bottom: 15px;
            font-size: 1.1em;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
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

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .table {
                width: 1400px;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-users-cog"></i> نظام إدارة المستخدمين</h1>
            <p>إدارة شاملة لبيانات الموظفين والمستخدمين في النظام</p>
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
            <div class="stat-card departments">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-title">الأقسام</div>
                <div class="stat-value" id="totalDepartments">0</div>
            </div>
            <div class="stat-card companies">
                <div class="stat-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="stat-title">الشركات</div>
                <div class="stat-value" id="totalCompanies">0</div>
            </div>
            <div class="stat-card managers">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-title">المديرين</div>
                <div class="stat-value" id="totalManagers">0</div>
            </div>
            <div class="stat-card active">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-title">المستخدمين النشطين</div>
                <div class="stat-value" id="totalActive">0</div>
            </div>
        </div>

        <!-- Controls -->
        <div class="controls">
            <div class="controls-grid">
                <div class="form-group">
                    <label><i class="fas fa-building"></i> فلترة حسب القسم</label>
                    <select class="form-control" id="filterDepartment">
                        <option value="">جميع الأقسام</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-industry"></i> فلترة حسب الشركة</label>
                    <select class="form-control" id="filterCompany">
                        <option value="">جميع الشركات</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-user-tag"></i> فلترة حسب النوع</label>
                    <select class="form-control" id="filterUserType">
                        <option value="">جميع الأنواع</option>
                        <option value="employee">موظف</option>
                        <option value="manager">مدير</option>
                        <option value="admin">مسؤول</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-search"></i> البحث</label>
                    <input type="text" class="form-control" id="searchInput"
                           placeholder="البحث في الاسم أو الكود أو البريد الإلكتروني...">
                </div>
            </div>
            <div class="btn-actions">
                <button class="btn btn-primary" onclick="openModal()">
                    <i class="fas fa-user-plus"></i> إضافة مستخدم جديد
                </button>
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
                    <th><i class="fas fa-user"></i> المستخدم</th>
                    <th><i class="fas fa-code"></i> كود الموظف</th>
                    <th><i class="fas fa-phone"></i> الهاتف</th>
                    <th><i class="fas fa-building"></i> القسم</th>
                    <th><i class="fas fa-toggle-on"></i> الحالة</th>
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

    <!-- Modal -->
    <div id="dataModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"><i class="fas fa-user-plus"></i> إضافة مستخدم جديد</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="userId" name="user_id">

                    <div class="form-section">
                        <h3><i class="fas fa-user"></i> البيانات الأساسية</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label><i class="fas fa-user"></i> الاسم الكامل <span class="required-indicator">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required
                                       placeholder="أدخل الاسم الكامل للموظف">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-code"></i> كود الموظف <span class="required-indicator">*</span></label>
                                <input type="text" class="form-control" id="code" name="code" required
                                       placeholder="أدخل كود الموظف الفريد">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-at"></i> اسم المستخدم</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="أدخل اسم المستخدم للنظام">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="example@company.com">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-phone"></i> رقم الهاتف</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="+20 1XX XXX XXXX">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-lock"></i> كلمة المرور <span class="required-indicator">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="أدخل كلمة مرور قوية">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3><i class="fas fa-briefcase"></i> بيانات الوظيفة</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label><i class="fas fa-briefcase"></i> المسمى الوظيفي</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="مطور برمجيات، محاسب، مدير...">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-building"></i> القسم</label>
                                <select class="form-control" id="department_id" name="department_id">
                                    <option value="">اختر القسم</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-industry"></i> الشركة</label>
                                <select class="form-control" id="company_id" name="company_id">
                                    <option value="">اختر الشركة</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-user-tag"></i> نوع المستخدم</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="employee">موظف</option>
                                    <option value="manager">مدير</option>
                                    <option value="admin">مسؤول النظام</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-money-bill-wave"></i> الراتب الشهري</label>
                                <input type="number" class="form-control" id="salary" name="salary" step="0.01"
                                       placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-calendar-check"></i> تاريخ بداية العمل</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> معلومات شخصية (اختيارية)</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label><i class="fas fa-venus-mars"></i> الجنس</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">اختر الجنس</option>
                                    <option value="male">ذكر</option>
                                    <option value="female">أنثى</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-birthday-cake"></i> تاريخ الميلاد</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt"></i> أيام الإجازة السنوية</label>
                                <input type="number" class="form-control" id="allowed_vacation_days" name="allowed_vacation_days"
                                       value="21" step="0.5" placeholder="21">
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-calendar-times"></i> تاريخ انتهاء العمل</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="button" class="btn btn-danger" onclick="closeModal()">
                            <i class="fas fa-times"></i> إلغاء
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> حفظ البيانات
                        </button>
                    </div>
                </form>
            </div>
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
                username: '{{$user->username ?? ''}}',
                email: '{{$user->email ?? ''}}',
                title: '{{$user->title ?? ''}}',
                code: '{{$user->code}}',
                phone: '{{$user->phone ?? ''}}',
                gender: '{{$user->gender ?? ''}}',
                age: {{$user->age ?? 'null'}},
                birth_date: '{{$user->birth_date ?? ''}}',
                allowed_vacation_days: {{$user->allowed_vacation_days ?? 21}},
                salary: {{$user->salary ?? 0}},
                start_date: '{{$user->start_date ?? ''}}',
                end_date: '{{$user->end_date ?? ''}}',
                department_id: {{$user->department_id ?? 'null'}},
                department_name: '{{$user->department->name ?? ''}}',
                company_id: {{$user->company_id ?? 'null'}},
                company_name: '{{$user->company->name ?? ''}}',
                user_type: '{{$user->user_type}}',
                created_at: '{{$user->created_at}}'
            },
            @endforeach
            @endif
        ];

        let filteredData = [...users];
        let editingId = null;

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            renderTable();
            setupEventListeners();
            populateFilters();
        });

        function setupEventListeners() {
            document.getElementById('filterDepartment').addEventListener('change', filterData);
            document.getElementById('filterCompany').addEventListener('change', filterData);
            document.getElementById('filterUserType').addEventListener('change', filterData);
            document.getElementById('searchInput').addEventListener('input', filterData);
        }

        function populateFilters() {
            // Populate departments filter
            const departments = [...new Set(users.map(user => user.department_name).filter(d => d))];
            const departmentFilter = document.getElementById('filterDepartment');
            departmentFilter.innerHTML = '<option value="">جميع الأقسام</option>';
            departments.forEach(department => {
                departmentFilter.innerHTML += `<option value="${department}">${department}</option>`;
            });

            // Populate companies filter
            const companies = [...new Set(users.map(user => user.company_name).filter(c => c))];
            const companyFilter = document.getElementById('filterCompany');
            companyFilter.innerHTML = '<option value="">جميع الشركات</option>';
            companies.forEach(company => {
                companyFilter.innerHTML += `<option value="${company}">${company}</option>`;
            });

            // Populate modal selects
            const departmentSelect = document.getElementById('department_id');
            departmentSelect.innerHTML = '<option value="">اختر القسم</option>';
            departments.forEach((department, index) => {
                departmentSelect.innerHTML += `<option value="${index + 1}">${department}</option>`;
            });

            const companySelect = document.getElementById('company_id');
            companySelect.innerHTML = '<option value="">اختر الشركة</option>';
            companies.forEach((company, index) => {
                companySelect.innerHTML += `<option value="${index + 1}">${company}</option>`;
            });
        }

        function updateStats() {
            const totalUsers = users.length;
            const totalDepartments = new Set(users.map(user => user.department_name).filter(d => d)).size;
            const totalCompanies = new Set(users.map(user => user.company_name).filter(c => c)).size;
            const totalManagers = users.filter(user => user.user_type === 'manager' || user.user_type === 'admin').length;
            const totalActive = users.filter(user => !user.end_date || new Date(user.end_date) > new Date()).length;

            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('totalDepartments').textContent = totalDepartments;
            document.getElementById('totalCompanies').textContent = totalCompanies;
            document.getElementById('totalManagers').textContent = totalManagers;
            document.getElementById('totalActive').textContent = totalActive;
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
                const isActive = !user.end_date || new Date(user.end_date) > new Date();
                const userInitials = user.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
                const userTypeDisplay = {
                    'employee': 'موظف',
                    'manager': 'مدير',
                    'admin': 'مسؤول'
                };

                return `
                <tr>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">${userInitials}</div>
                            <div class="user-details">
                                <div class="user-name">
                                    <a style="text-decoration: none; color: inherit;" href="/user/${user.id}">
                                        ${user.name}
                                    </a>
                                </div>
                                <div class="user-email">${user.email || userTypeDisplay[user.user_type] || user.user_type}</div>
                            </div>
                        </div>
                    </td>
                    <td><strong style="color: #667eea; font-size: 16px;">${user.code}</strong></td>
                    <td>${user.phone || '-'}</td>
                    <td>
                        ${user.department_name ? `<span class="department-badge">${user.department_name}</span>` : '-'}
                    </td>
                    <td>
                        <span class="status-badge ${isActive ? 'status-active' : 'status-inactive'}">
                            ${isActive ? 'نشط' : 'غير نشط'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-info" onclick="viewDetails(${user.id})" style="margin: 2px; padding: 10px 15px;">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning" onclick="editItem(${user.id})" style="margin: 2px; padding: 10px 15px;">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deleteItem(${user.id})" style="margin: 2px; padding: 10px 15px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            }).join('');
        }

        function filterData() {
            const departmentFilter = document.getElementById('filterDepartment').value;
            const companyFilter = document.getElementById('filterCompany').value;
            const userTypeFilter = document.getElementById('filterUserType').value;
            const searchText = document.getElementById('searchInput').value.toLowerCase();

            filteredData = users.filter(user => {
                const matchesDepartment = !departmentFilter || user.department_name === departmentFilter;
                const matchesCompany = !companyFilter || user.company_name === companyFilter;
                const matchesUserType = !userTypeFilter || user.user_type === userTypeFilter;
                const matchesSearch = !searchText ||
                    (user.name && user.name.toLowerCase().includes(searchText)) ||
                    (user.code && user.code.toLowerCase().includes(searchText)) ||
                    (user.email && user.email.toLowerCase().includes(searchText)) ||
                    (user.username && user.username.toLowerCase().includes(searchText)) ||
                    (user.phone && user.phone.toLowerCase().includes(searchText));

                return matchesDepartment && matchesCompany && matchesUserType && matchesSearch;
            });

            renderTable();
        }

        function clearFilters() {
            document.getElementById('filterDepartment').value = '';
            document.getElementById('filterCompany').value = '';
            document.getElementById('filterUserType').value = '';
            document.getElementById('searchInput').value = '';
            filteredData = [...users];
            renderTable();
        }

        function openModal(id = null) {
            editingId = id;
            const modal = document.getElementById('dataModal');
            const modalTitle = document.getElementById('modalTitle');

            if (id) {
                const user = users.find(u => u.id === id);
                modalTitle.innerHTML = '<i class="fas fa-user-edit"></i> تعديل بيانات المستخدم';

                document.getElementById('userId').value = user.id;
                document.getElementById('name').value = user.name || '';
                document.getElementById('username').value = user.username || '';
                document.getElementById('email').value = user.email || '';
                document.getElementById('title').value = user.title || '';
                document.getElementById('code').value = user.code || '';
                document.getElementById('phone').value = user.phone || '';
                document.getElementById('gender').value = user.gender || '';
                document.getElementById('age').value = user.age || '';
                document.getElementById('birth_date').value = user.birth_date || '';
                document.getElementById('allowed_vacation_days').value = user.allowed_vacation_days || 21;
                document.getElementById('salary').value = user.salary || '';
                document.getElementById('start_date').value = user.start_date || '';
                document.getElementById('end_date').value = user.end_date || '';
                document.getElementById('department_id').value = user.department_id || '';
                document.getElementById('company_id').value = user.company_id || '';
                document.getElementById('user_type').value = user.user_type || 'employee';;

                // Make password field optional for editing
                document.getElementById('password').removeAttribute('required');
                document.getElementById('password').placeholder = 'اتركه فارغاً للاحتفاظ بكلمة المرور الحالية';
            } else {
                modalTitle.innerHTML = '<i class="fas fa-user-plus"></i> إضافة مستخدم جديد';
                document.getElementById('dataForm').reset();
                document.getElementById('password').setAttribute('required', 'required');
                document.getElementById('password').placeholder = 'أدخل كلمة المرور';
                document.getElementById('allowed_vacation_days').value = 21;
                document.getElementById('user_type').value = 'employee';
            }

            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('dataModal').style.display = 'none';
            editingId = null;
        }

        function editItem(id) {
            openModal(id);
        }

        function viewDetails(id) {
            // Redirect to user details page or open a details modal
            window.location.href = `/user/${id}`;
        }

        function deleteItem(id) {
            const user = users.find(u => u.id === id);
            if (confirm(`هل أنت متأكد من حذف المستخدم "${user.name}"؟\nهذا الإجراء لا يمكن التراجع عنه.`)) {
                // Here you would typically send a delete request to the server
                users = users.filter(u => u.id !== id);
                updateStats();
                populateFilters();
                filterData();

                // Show success message
                alert('تم حذف المستخدم بنجاح');
            }
        }

        function exportData() {
            // Create CSV content
            const headers = ['الاسم', 'كود الموظف', 'البريد الإلكتروني', 'الهاتف', 'القسم', 'الشركة', 'الراتب', 'نوع المستخدم', 'تاريخ البداية'];
            const csvContent = [
                headers.join(','),
                ...filteredData.map(user => [
                    `"${user.name}"`,
                    `"${user.code}"`,
                    `"${user.email || ''}"`,
                    `"${user.phone || ''}"`,
                    `"${user.department_name || ''}"`,
                    `"${user.company_name || ''}"`,
                    `"${user.salary || 0}"`,
                    `"${user.user_type}"`,
                    `"${user.start_date || ''}"`
                ].join(','))
            ].join('\n');

            // Create and download file
            const blob = new Blob(['\ufeff' + csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `users_export_${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('dataModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Handle form submission
        document.getElementById('dataForm').addEventListener('submit', function(e) {
            // Add any additional validation here if needed
            console.log('Form submitted');
        });
    </script>
@endpush
