<div class="sidebar" id="sidebar">
    <!-- Logo Section -->
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-cogs"></i>
            <span class="logo-text">نظام الإدارة</span>
        </div>
        <button class="sidebar-toggle d-md-none" id="sidebarToggle">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- User Info -->
    <div class="user-info">
        <div class="user-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="user-details">
            <h6>{{ Auth::user()->name ?? 'المدير العام' }}</h6>
            <small>{{ Auth::user()->email ?? 'admin@example.com' }}</small>
        </div>
    </div>

    <!-- Navigation Menu -->
    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{route('attendance.index')}}" class="nav-link ">
                    <i class="fas fa-users"></i>
                    <span>  حضور الموظفين  </span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="version-info">
            <small>الإصدار 1.0.0</small>
        </div>
    </div>
</div>
