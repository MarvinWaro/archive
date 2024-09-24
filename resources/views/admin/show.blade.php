@extends('base')

@section('title')
    Admin
@endsection

@section('content')

        <!-- start: Sidebar -->
        <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
                <div class="d-flex align-items-center p-3">
                    <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4 text-center logo-text">ADMIN</a>
                    <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
                </div>

                <div class="logo-container">
                    <img class="logo-img" src="{{ asset('assets/img/ched_logo.png') }}" alt="Logo">
                </div>


                <ul class="sidebar-menu p-3 m-0 mb-0">
                    <li class="sidebar-menu-item active">
                        <a href="{{ url('admin/dashboard') }}" class="fw-semibold">
                            <i class="fa-solid fa-chart-pie sidebar-menu-item-icon py-2"></i>
                            {{-- <i class="ri-dashboard-line sidebar-menu-item-icon"></i> --}}
                            DASHBOARD
                        </a>
                    </li>

                    <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">ACIC</li>

                    <li class="sidebar-menu-item">
                        <a href="{{ url('admin/acic') }}" class="fw-semibold">
                            <i class="fa-solid fa-folder sidebar-menu-item-icon py-2"></i>
                            {{-- <i class="fa-solid fa-folder-open sidebar-menu-item-icon"></i> --}}
                            {{-- <i class="ri-folder-2-line sidebar-menu-item-icon"></i> --}}
                            ACIC
                        </a>
                    </li>

                    <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">MDS</li>

                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ url('admin/mds') }}" class="fw-semibold">
                            <i class="fa-solid fa-folder sidebar-menu-item-icon py-2"></i>
                            {{-- <i class="fa-solid fa-folder-open sidebar-menu-item-icon"></i> --}}
                            {{-- <i class="ri-folder-2-line sidebar-menu-item-icon"></i> --}}
                            MDS
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

            <h5 class="fw-bold mb-0 me-auto" id="head">Record Details</h5>


            <div class="dropdown">
                <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-2 d-none d-sm-block pe-2">Marvin Waro</span>
                    <img class="navbar-profile-image" src="{{ asset('assets/img/ched_logo.png') }}" alt="Image" />
                </div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="profile.php"><i class="ri-user-settings-line me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php"><i class="ri-settings-3-line me-2"></i>Settings</a></li>
                    <hr class="w-100">
                    <li><a class="dropdown-item" href="../login/logout.php"><i class="ri-logout-box-line me-2"></i>Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- start: Content -->
        <div class="py-4 mt-4">
            <!-- start: Summary -->

            <div class="w-50 text-center mx-auto">

                <div class="head-folder-container mb-4">
                    <div class="mb-3 status-container completed">
                        COMPLETED
                    </div>

                    <div class="folder-name-container">
                        <h2>ACIC COSCO</h2>
                    </div>

                    <div class="date-container">
                        <span class="date">2023</span>
                        <span class="date">JUNE</span>
                    </div>
                </div>

                <div class="footer-folder-container">

                    <div class="type-container">
                        CHECK NUMBER
                    </div>

                    <div class="others-container">
                        Folder #1
                    </div>

                    <div class="number-container">
                        146513456843546
                    </div>

                    <div class="sub-date-container">
                        <span>2023</span>
                        <span>september</span>
                    </div>

                    <div class="remarks-container">
                        sdfasdsfsdfvisflkn
                    </div>


                </div>


            </div>

            <!-- end: Content -->
        </div>
    </div>
</main>
<!-- end: Main -->

@endsection

