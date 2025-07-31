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
                <a href="#" class="nav-link ">
                    <i class="fas fa-home"></i>
                    <span>الرئيسية</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link ">
                    <i class="fas fa-car"></i>
                    <span>  حضور الموظفين  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href=""
                   class="nav-link ">
                    <i class="fas fa-tags"></i>
                    <span>ادارة الاقسام  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link ">
                    <i class="fas fa-tags"></i>
                    <span>ادارة الاجازات   </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link ">
                    <i class="fas fa-tags"></i>
                    <span>ادارة الاذونات    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link ">
                    <i class="fas fa-tags"></i>
                    <span>ادارة الخصومات  </span>
                </a>
            </li>
            {{-- <li class="nav-item">
              <a href="#" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>الإعدادات</span>
              </a>
            </li> --}}
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="version-info">
            <small>الإصدار 1.0.0</small>
        </div>
    </div>
</div>
