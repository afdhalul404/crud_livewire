<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- start: Icons -->
    <!-- start: CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"> 
    <!-- end: CSS -->

    <title>Admin | E-Library Teknik Informatika UHO</title>
    @livewireStyles
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4"><img
                    src="{{ asset('img/logo-admin.png') }}" alt="" width="130px"></a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="/admin/dashboard">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Menu</li>
            <li class="sidebar-menu-item {{ Request::is('admin/dosen') ? 'active' : '' }}">
                <a href="/admin/dosen">
                    <i class="ri-user-2-line sidebar-menu-item-icon"></i>
                    Dosen
                </a>
            </li>
            <li class="sidebar-menu-item {{ Request::is('admin/buku') ? 'active' : '' }}">
                <a href="/admin/buku">
                    <i class="ri-book-mark-line sidebar-menu-item-icon"></i>
                    Buku
                </a>
            </li>
            <li class="sidebar-menu-item {{ Request::is('admin/skripsi') ? 'active' : '' }}">
                <a href="/admin/skripsi">
                    <i class="ri-file-user-line sidebar-menu-item-icon"></i>
                    Skripsi
                </a>
            </li>
            <li class="sidebar-menu-item {{ Request::is('admin/kp') ? 'active' : '' }}">
                <a href="/admin/kp">
                    <i class="ri-team-line sidebar-menu-item-icon"></i>
                    Laporan Kerja Praktek
                </a>
            </li>
        </ul>
        <hr class="px-3">
        <ul class="sidebar-menu p-3 pt-0 m-0 mb-0">
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Auth</li>
            <li class="sidebar-menu-item">
                <a wire:click.prevent="logout" href="/admin/logout" class="cursor-pointer">
                    <i class="ri-logout-box-line sidebar-menu-item-icon"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 bg-white rounded shadow-sm">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <h5 class="fw-bold mb-0 me-auto">Dashboard</h5>
                <div class="dropdown me-3 d-none d-sm-block">
                    <div class="cursor-pointer dropdown-toggle navbar-link" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ri-notification-line"></i>
                    </div>
                    <div class="dropdown-menu fx-dropdown-menu">
                        <h5 class="p-3 bg-indigo text-light">Notification</h5>
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-semibold">Subheading</div>
                                    <span class="fs-7">Content for list item</span>
                                </div>
                                <span class="badge bg-primary rounded-pill">14</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @auth
                        <span class="me-2 d-none d-sm-block">{{ Auth::user()->name }}</span>
                        <img class="navbar-profile-image"
                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Image">
                        @endauth
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </nav>
            <!-- end: Navbar -->

            <!-- start: Content -->
            {{ $slot }}
            <!-- end: Content -->

    </main>


    <!-- end: Main -->

    <!-- start: JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    @livewireScripts
    @stack('scripts')
    <!-- end: JS -->
</body>

</html>