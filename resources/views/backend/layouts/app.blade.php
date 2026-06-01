<!doctype html>

<html
    lang="en"
    class="layout-menu-fixed layout-compact"
    data-assets-path="{{ asset('template-admin/assets') }}/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Dashboard - Analytics | Sneat - Bootstrap Dashboard FREE</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('template-admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('template-admin/assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('template-admin/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('template-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <link rel="stylesheet" href="{{ asset('template-admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('template-admin/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('template-admin/assets/js/config.js') }}"></script>
    
    <style>
        /* Custom sidebar styles for Rando Parfum (Deep Purple Theme) */
        #layout-menu.bg-menu-theme {
            background-color: #331853 !important;
        }
        
        #layout-menu .app-brand {
            background-color: #331853 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 15px;
            padding-bottom: 15px;
            height: auto;
        }
        
        #layout-menu .menu-inner {
            background-color: #331853 !important;
            padding-top: 15px !important;
        }
        
        #layout-menu .menu-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-family: 'Inter', sans-serif;
            font-size: 0.92rem;
            font-weight: 500;
            padding-top: 12px;
            padding-bottom: 12px;
            transition: all 0.25s ease;
        }
        
        #layout-menu .menu-item a:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.08) !important;
        }
        
        #layout-menu .menu-item.active > .menu-link {
            background-color: #632c9b !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(99, 44, 155, 0.25);
        }
        
        #layout-menu .menu-item.active {
            background-color: transparent !important;
        }
        
        #layout-menu .menu-icon {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 1.15rem;
            transition: all 0.25s ease;
        }
        
        #layout-menu .menu-item.active .menu-icon {
            color: #ffffff !important;
        }
        
        #layout-menu .menu-item.active::before {
            display: none !important;
        }
        
        #layout-menu .menu-divider {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo" style="padding-left: 20px;">
                    <a href="{{ route('admin.dasbor') }}" class="app-brand-link" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                        <span class="app-brand-logo demo" style="width:36px; height:36px; border-radius:50%; border:2px solid #ffffff; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.15); color:#ffffff; font-family:'Cinzel', serif; font-weight:700; font-size:1.15rem;">
                            R
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold" style="font-family:'Cinzel', serif; font-size:1.15rem; font-weight:700; color:#ffffff; letter-spacing:1px; line-height:1.1; display:flex; flex-direction:column; justify-content:center; text-transform:none;">
                            <span style="font-size:1.15rem;">RANDO</span>
                            <span style="font-family:'Montserrat', sans-serif; font-size:0.55rem; font-weight:600; color:rgba(255,255,255,0.7); letter-spacing:3px; text-transform:uppercase; margin-top:2px;">PARFUM</span>
                        </span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left align-middle" style="color:#ffffff;"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('admin.dasbor') ? 'active' : '' }}">
                        <a href="{{ route('admin.dasbor') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <!-- Produk -->
                    <li class="menu-item {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.produk.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div>Produk</div>
                        </a>
                    </li>

                    <!-- Transaksi -->
                    <li class="menu-item {{ request()->routeIs('admin.transaksi.*') && request('tab') == 'all_orders' ? 'active' : '' }}">
                        <a href="{{ route('admin.transaksi.index') }}?tab=all_orders" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-receipt"></i>
                            <div>Transaksi</div>
                        </a>
                    </li>

                    <!-- Pelanggan -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" onclick="alert('Fitur Manajemen Pelanggan akan segera hadir!')" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>Pelanggan</div>
                        </a>
                    </li>

                    <!-- Laporan (Active when on transactions index without tab=all_orders) -->
                    <li class="menu-item {{ request()->routeIs('admin.transaksi.index') && request('tab') != 'all_orders' ? 'active' : '' }}">
                        <a href="{{ route('admin.transaksi.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                            <div>Laporan</div>
                        </a>
                    </li>

                    <!-- Pengaturan -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" onclick="alert('Fitur Pengaturan akan segera hadir!')" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div>Pengaturan</div>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="{{ route('admin.keluar') }}" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                            <div>Logout</div>
                        </a>
                        <form id="logout-form-sidebar" action="{{ route('admin.keluar') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav
                    class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base bx bx-menu icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center me-auto">
                            <div class="nav-item d-flex align-items-center">
                                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                                <input
                                    type="text"
                                    class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                                    placeholder="Search..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-4">
                                <a
                                    class="github-button"
                                    href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free"
                                    data-icon="octicon-star"
                                    data-size="large"
                                    data-show-count="true"
                                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a
                                    class="nav-link dropdown-toggle hide-arrow p-0"
                                    href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('template-admin/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('template-admin/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ auth()->user()->nama ?? 'Admin' }}</h6>
                                                    <small class="text-body-secondary">{{ ucfirst(auth()->user()->peran ?? 'Admin') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('admin.keluar') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('admin.keluar') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>

                                </div>

                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->

    <script src="{{ asset('template-admin/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('template-admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('template-admin/assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('template-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('template-admin/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('template-admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->

    <script src="{{ asset('template-admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('template-admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>