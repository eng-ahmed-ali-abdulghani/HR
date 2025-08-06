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

        .container {
            text-align: center;
        }

        .upload-btn {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            position: relative;
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .close {
            position: absolute;
            top: 15px;
            left: 20px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #ccc;
        }

        .modal-body {
            padding: 30px;
        }

        .upload-area {
            border: 3px dashed #007bff;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .upload-area:hover {
            border-color: #0056b3;
            background: #e3f2fd;
        }

        .upload-area.dragover {
            border-color: #28a745;
            background: #d4edda;
        }

        .upload-icon {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 15px;
        }

        .upload-text {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .upload-subtext {
            font-size: 14px;
            color: #666;
        }

        .file-input {
            display: none;
        }

        .file-info {
            display: none;
            background: #e8f5e8;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }

        .file-name {
            font-weight: bold;
            color: #155724;
            margin-bottom: 5px;
        }

        .file-size {
            color: #666;
            font-size: 14px;
        }

        .upload-submit-btn {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
            display: none;
        }

        .upload-submit-btn:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
        }

        .upload-submit-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            margin: 15px 0;
            overflow: hidden;
            display: none;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(45deg, #28a745, #20c997);
            width: 0%;
            transition: width 0.3s ease;
        }

        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
        }

        .error-message {
            display: none;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
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
<style>
    .success-message {
        display: none;
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 12px;
        padding: 20px;
        margin-top: 15px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.15);
        animation: slideInDown 0.5s ease;
    }

    .error-message {
        display: none;
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 12px;
        padding: 20px;
        margin-top: 15px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
        animation: slideInDown 0.5s ease;
        max-height: 400px;
        overflow-y: auto;
    }

    .error-message::-webkit-scrollbar {
        width: 8px;
    }

    .error-message::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 4px;
    }

    .error-message::-webkit-scrollbar-thumb {
        background: rgba(220, 53, 69, 0.3);
        border-radius: 4px;
    }

    .error-message::-webkit-scrollbar-thumb:hover {
        background: rgba(220, 53, 69, 0.5);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stats-display {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        padding: 10px;
        margin-top: 10px;
        text-align: left;
    }

    .error-details {
        max-height: 300px;
        overflow-y: auto;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
    }

    .error-item {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #dc3545;
    }

    .error-item:last-child {
        margin-bottom: 0;
    }

    .error-row {
        font-weight: bold;
        color: #dc3545;
        margin-bottom: 5px;
    }

    .error-details-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }

    /* Loading states */
    .uploading .upload-area {
        pointer-events: none;
        opacity: 0.6;
    }

    .uploading .upload-text {
        color: #007bff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-content {
            width: 95%;
            margin: 10% auto;
        }

        .error-message,
        .success-message {
            padding: 15px;
            font-size: 14px;
        }

        .error-details {
            padding: 10px;
        }

        .error-item {
            padding: 8px;
            font-size: 13px;
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
                <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
            </div>
            <div class="stat-card checkin">
                <div class="stat-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="stat-title">تسجيل دخول اليوم</div>
                <div class="stat-value">{{ $stats['total_checkin'] ?? 0 }}</div>
            </div>
            <div class="stat-card checkout">
                <div class="stat-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="stat-title">تسجيل خروج اليوم</div>
                <div class="stat-value">{{ $stats['total_checkout'] ?? 0 }}</div>
            </div>
            <div class="stat-card absent">
                <div class="stat-icon">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-title">لم يسجل دخول</div>
                <div class="stat-value">{{ $stats['total_absent'] ?? 0 }}</div>
            </div>
        </div>

        <div class="container">
            <button class="upload-btn" onclick="openModal()">📊 رفع ملف الحضور و الغياب</button>
        </div>

        <!-- Modal -->
        <div id="uploadModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 class="modal-title">رفع ملف إكسيل</h2>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-area" onclick="triggerFileInput()" id="uploadArea">
                            <div class="upload-icon">📄</div>
                            <div class="upload-text">اضغط هنا لاختيار الملف</div>
                            <div class="upload-subtext">أو اسحب الملف إلى هنا</div>
                            <div class="upload-subtext">يدعم ملفات: .xlsx, .xls</div>
                        </div>

                        <input type="file" id="fileInput" class="file-input" accept=".xlsx,.xls"
                               onchange="handleFileSelect(event)">

                        <div id="fileInfo" class="file-info">
                            <div id="fileName" class="file-name"></div>
                            <div id="fileSize" class="file-size"></div>
                        </div>

                        <div id="progressBar" class="progress-bar">
                            <div id="progressFill" class="progress-fill"></div>
                        </div>

                        <button type="submit" id="uploadBtn" class="upload-submit-btn">
                            📤 رفع الملف
                        </button>

                        <div id="successMessage" class="success-message">
                            ✅ تم رفع الملف بنجاح!
                        </div>

                        <div id="errorMessage" class="error-message">
                            ❌ حدث خطأ أثناء رفع الملف
                        </div>
                    </form>
                </div>
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
                @forelse($users as $user)
                    <tr>
                        <td><strong style="color: #667eea; font-size: 18px;">#{{ $user->fingerprint_employee_id }}</strong></td>
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
                                         {{ \Carbon\Carbon::parse($todayAttendances->where('type', 'checkin')->first()->timestamp)->format('H:i') }}
                                    </span>
                                @endif

                                @if($hasCheckout)
                                    <span class="status-badge status-checkout">
                                        <i class="fas fa-sign-out-alt"></i> خروج
                                          {{ \Carbon\Carbon::parse($todayAttendances->where('type', 'checkout')->first()->timestamp)->format('H:i') }}
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
                            <div class="action-buttons">
                                <a href="{{route('attendance.show',$user->id )}}" class="btn btn-primary" title="عرض تفاصيل الحضور والغياب">
                                    <i class="fas fa-calendar-check"></i> التفاصيل
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
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
        let selectedFile = null;

        function openModal() {
            document.getElementById('uploadModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('uploadModal').style.display = 'none';
            resetForm();
        }

        function triggerFileInput() {
            document.getElementById('fileInput').click();
        }

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                if (isValidExcelFile(file)) {
                    selectedFile = file;
                    displayFileInfo(file);
                } else {
                    alert('يرجى اختيار ملف Excel صالح (.xlsx أو .xls)');
                    event.target.value = '';
                }
            }
        }

        function isValidExcelFile(file) {
            const validTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
            const validExtensions = ['.xlsx', '.xls'];
            const fileName = file.name.toLowerCase();

            return validTypes.includes(file.type) ||
                validExtensions.some(ext => fileName.endsWith(ext));
        }

        function displayFileInfo(file) {
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const uploadBtn = document.getElementById('uploadBtn');

            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);

            fileInfo.style.display = 'block';
            uploadBtn.style.display = 'block';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function resetForm() {
            document.getElementById('uploadForm').reset();
            document.getElementById('fileInfo').style.display = 'none';
            document.getElementById('uploadBtn').style.display = 'none';
            document.getElementById('progressBar').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
            document.getElementById('progressFill').style.width = '0%';
            selectedFile = null;
        }

        // Drag and Drop functionality
        const uploadArea = document.getElementById('uploadArea');

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (isValidExcelFile(file)) {
                    selectedFile = file;
                    displayFileInfo(file);
                    document.getElementById('fileInput').files = files;
                } else {
                    alert('يرجى اختيار ملف Excel صالح (.xlsx أو .xls)');
                }
            }
        });

        // Form submission
        // Form submission
        document.getElementById('uploadForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            if (!selectedFile) {
                alert('يرجى اختيار ملف أولاً');
                return;
            }

            const uploadBtn = document.getElementById('uploadBtn');
            const progressBar = document.getElementById('progressBar');
            const progressFill = document.getElementById('progressFill');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            // Reset messages
            successMessage.style.display = 'none';
            errorMessage.style.display = 'none';

            // Show progress bar and disable button
            progressBar.style.display = 'block';
            uploadBtn.disabled = true;
            uploadBtn.textContent = '⏳ جاري الرفع...';

            // Simulate upload progress
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 30;
                if (progress > 90) progress = 90;
                progressFill.style.width = progress + '%';
            }, 200);

            try {
                // Create FormData
                const formData = new FormData();
                formData.append('excel_file', selectedFile);

                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                    document.querySelector('input[name="_token"]')?.value || '';

                const response = await fetch('{{ route("attendance.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                clearInterval(progressInterval);
                progressFill.style.width = '100%';

                const result = await response.json();

                if (response.ok) {
                    // Success response
                    successMessage.style.display = 'block';
                    successMessage.innerHTML = `
                <div style="text-align: center;">
                    <strong>✅ ${result.message}</strong>
                    ${result.stats ? `
                        <div style="margin-top: 10px; font-size: 14px;">
                            <div>📊 إحصائيات العملية:</div>
                            <div>• سجلات جديدة: ${result.stats.success}</div>
                            <div>• سجلات مكررة: ${result.stats.skipped}</div>
                            <div>• أخطاء: ${result.stats.errors}</div>
                        </div>
                    ` : ''}
                </div>
            `;

                    // إعادة تحميل الصفحة بعد 3 ثواني
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    // Error response
                    let errorHtml = `<div style="text-align: right;">❌ ${result.message}</div>`;

                    if (result.errors && result.errors.length > 0) {
                        errorHtml += `
                    <div style="margin-top: 20px;">
                        <strong>تفاصيل الأخطاء:</strong>
                        <div style="max-height: 200px; overflow-y: auto; margin-top: 10px; background: rgba(255,255,255,0.1); padding: 6px; border-radius: 5px;">
                `;

                        result.errors.slice(0, 10).forEach(error => {
                            errorHtml += `
                        <div style="margin-bottom: 8px; padding: 5px; background: rgba(255,255,255,0.1); border-radius: 3px; font-size: 18px;">
                            <strong>الصف ${error.row}:</strong> ${error.message}
                            <br><small>رقم البصمة: ${error.fingerprint_id} | التاريخ: ${error.date} | النوع: ${error.type}</small>
                        </div>
                    `;
                        });

                        if (result.errors.length > 10) {
                            errorHtml += `<div style="text-align: center; font-style: italic;">... و ${result.errors.length - 10} أخطاء أخرى</div>`;
                        }

                        errorHtml += `</div></div>`;
                    }

                    if (result.stats) {
                        errorHtml += `
                    <div style="margin-top: 10px; font-size: 14px;">
                        <div>📊 إحصائيات العملية:</div>
                        <div>• سجلات معالجة: ${result.stats.success}</div>
                        <div>• سجلات مكررة: ${result.stats.skipped}</div>
                        <div>• أخطاء: ${result.stats.errors}</div>
                    </div>
                `;
                    }

                    errorMessage.style.display = 'block';
                    errorMessage.innerHTML = errorHtml;
                }
            } catch (error) {
                clearInterval(progressInterval);
                progressFill.style.width = '0%';
                errorMessage.style.display = 'block';
                errorMessage.innerHTML = `
            <div style="text-align: center;">
                ❌ خطأ في الاتصال بالخادم
                <div style="margin-top: 10px; font-size: 14px; color: #666;">
                    ${error.message || 'حدث خطأ غير متوقع'}
                </div>
            </div>
        `;
            } finally {
                uploadBtn.disabled = false;
                uploadBtn.textContent = '📤 رفع الملف';
                setTimeout(() => {
                    progressBar.style.display = 'none';
                    progressFill.style.width = '0%';
                }, 1000);
            }
        });
        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('uploadModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Function for viewing user details (you can implement this)
        function viewUserDetails(userId) {
            // يمكنك تنفيذ هذه الوظيفة حسب احتياجاتك
            console.log('View details for user:', userId);
            // مثال: window.location.href = '/attendance/user/' + userId;
        }
    </script>
@endpush
