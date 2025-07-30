@extends('dashboard.layouts.app')

@section('title', 'لوحة التحكم - الرئيسية')
@section('page-title', 'لوحة التحكم')

@section('breadcrumb')
    <li class="breadcrumb-item active">الرئيسية</li>
@endsection

@section('content')


    <div class="dashboard-content">
        <!-- Welcome Section -->
        <div class="welcome-section animate-fade-in-up">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="welcome-title">
                        مرحباً، {{ Auth::user()->name ?? 'المدير العام' }}! 👋
                    </h2>
                    <p class="welcome-subtitle">
                        إليك نظرة سريعة على آخر الإحصائيات والأنشطة في النظام
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="current-time">
                        <i class="fas fa-clock me-2"></i>
                        <span id="currentTime"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-3">
                <div class="stats-card animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="stats-card-body">
                        <div class="stats-icon bg-primary">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stats-content">
                            <h3 class="stats-number">32423</h3>
                            <p class="stats-label">عدد الموظفين</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-3">
                <div class="stats-card animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="stats-card-body">
                        <div class="stats-icon bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-content">
                            <h3 class="stats-number">234}</h3>
                            <p class="stats-label">عدد عقود الايجار</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-3">
                <div class="stats-card animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="stats-card-body">
                        <div class="stats-icon bg-info">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="stats-content">
                            <h3 class="stats-number">3</h3>
                            <p class="stats-label">عدد الفواتير </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-3">
                <div class="stats-card animate-fade-in-up" style="animation-delay: 0.4s">
                    <div class="stats-card-body">
                        <div class="stats-icon bg-warning">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stats-content">
                            <h3 class="stats-number">5</h3>
                            <p class="stats-label">عدد السندات</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="row g-4">
            <div class="col-xl-12">
                <div class="quick-actions-card animate-fade-in-up" style="animation-delay: 0.7s">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-bolt me-2"></i>
                            الإجراءات السريعة
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>إضافة  عقد جديد</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-user-plus"></i>
                                    <span>إضافة مستخدم</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-tools"></i>
                                    <span>إضافة فاتورة </span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-list"></i>
                                    <span>إضافة سند</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>



@endsection

@push('scripts')

@endpush
