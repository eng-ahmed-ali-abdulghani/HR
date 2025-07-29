@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    {{-- CSS Style --}}
    <link rel="stylesheet" href="{{ asset('dachboard/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Courgette&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <hr>
    <div class="d-flex justify-content-end">
        <a class="sidbar-toggle-btn nav-link toggle-btn" href="javascript:void(0)" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </a>
    </div>

    <hr>
    <!-- Sidebar (Left) -->
    <div class="sidebar bg-main-color" id="sidebar">
        <ul class="nav flex-column mt-3">
            <li class="nav-item ">
                <a style="padding: 0" class=" nav-link flex-column justify-content-center align-items-center"
                    href="{{ route('admin') }}">
                    <div class="d-flex justify-content-center align-items-center"><img
                            src="{{ asset('uploads/images/logo.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <h5 id="logo_cont" class="fw-bold ms-3 pages_heading">Welcome {{ $user->username }}</h5>
                    </div>
                </a>

            </li>
            <hr style="margin: 0.5rem 0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}"><i class="fas fa-edit"></i><span>Dachboard</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cogs"></i><span>Company
                        Profile</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-table"></i>
                    <span>Manegment</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cogs"></i><span>Mission</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-home"></i><span>Vision</span></a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-users"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="#"><i class="far fa-plus-square"></i>
                    <span>
                        Requests
                        <i class="right fas fa-angle-left"></i>
                    </span>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('vacations.newRequest') }}" class="nav-link">
                            <i class="fas fa-table"></i>
                            <span>Vacations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-pie"></i>
                            <span>Excuces</span>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Developing Skills</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Experts</span>
                        </a>
                    </li> --}}
                </ul>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-image"></i>
                    <span>Header Banners</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="far fa-image"></i>
                    <span>Who We Are Banner</span></a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-chart-pie"></i>
                    <span>Divissions</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-copy"></i>
                    <span>Partners</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-edit"></i>
                    <span>Careers</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-book"></i> <span>News &
                        Events</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-tree"></i> <span>Contact
                        US</span></a>
            </li> --}}
            <!-- Add more menu items here -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content p-4" id="mainContent">
        <h3 class="text-center">@yield('title')</h3>
        <p>@yield('content')</p>
        <!-- Your dashboard content goes here -->
    </div>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Script for Sidebar Toggle -->
    <script src="{{ asset('dachboard/main.js') }}"></script>

    @stack('scripts')

</html>
</body>

</html>
