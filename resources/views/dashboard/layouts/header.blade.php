<header class="main-header">
    <div class="header-content">
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle d-md-none" id="mobileMenuToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Page Title -->
        <div class="page-title">
            <h4>@yield('page-title', 'لوحة التحكم')</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>

        <!-- Header Actions -->
        <div class="header-actions">
            <!-- Notifications -->

            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn btn-header-action dropdown-toggle user-dropdown" type="button"
                        data-bs-toggle="dropdown">
                    <img src="https://picsum.photos/200?random=25" alt="User Avatar" class="user-avatar">
                    <span class="user-name">{{ Auth::user()->name ?? 'المدير العام' }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="user-info-dropdown">
                            <img src="https://picsum.photos/200?random=25" alt="User Avatar">
                            <div>
                                <h6>{{ Auth::user()->name ?? 'المدير العام' }}</h6>
                                <small>{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                            </div>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    {{--                    <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user me-2"></i>
                                                الملف الشخصي
                                            </a>
                                        </li>--}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{route('logout')}}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                تسجيل الخروج
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
