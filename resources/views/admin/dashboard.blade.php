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
                            ACIC
                        </a>
                    </li>

                    <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">MDS</li>

                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ url('admin/mds') }}" class="fw-semibold">
                            <i class="fa-solid fa-folder sidebar-menu-item-icon py-2"></i>
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

            <h5 class="fw-bold mb-0 me-auto" id="head">DASHBOARD</h5>


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
        <!-- end: Navbar -->

        <!-- start: Content -->
        <div class="py-4">

            <!-- start: Summary -->
            <div class="row mb-5">
                <div class="col-lg-6">
                    <a href="{{ url('admin/acic') }}" class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                        <div>
                            <i class="fa-solid fa-folder summary-icon mb-2"
                                style="display: flex; justify-content: center; align-items: center; width: 65px; height: 65px; border-radius: 50%; background-color: #007bff; color: white; font-size: 24px;"></i>
                            <div>TOTAL ACIC FOLDERS</div>
                        </div>
                        <h4>{{ $acicCount }}</h4> <!-- Display the dynamic ACIC count -->
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="{{ url('admin/mds') }}" class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                        <div>
                            <i class="fa-solid fa-folder summary-icon mb-2"
                                style="display: flex; justify-content: center; align-items: center; width: 65px; height: 65px; border-radius: 50%; background-color: #ffc107; color: white; font-size: 24px;"></i>
                            <div>TOTAL MDS FOLDERS</div>
                        </div>
                        <h4>{{ $mdsCount }}</h4> <!-- Display the dynamic MDS count -->
                    </a>
                </div>
            </div>


            {{-- Alerts --}}

            <div class="alert-wrapper">
                @if (session('message'))
                    <div class="alert alert-success alert-position" role="alert" id="success-alert">
                        {{ session('message') }}
                    </div>
                @endif
            </div>


            <div class="d-flex justify-content-end mb-3 mx-5">
                <a href="{{ url('admin/records/create') }}" id="acic_add_new_record" class="btn add_record_button" type="button"> Add new record</a>
            </div>

            {{-- TABLE START --}}

            <div class="table-container mx-5 mb-5">
                <table id="table_data" class="table table-striped hover mt-3 table-edit mb-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                ACTION
                            </th>
                            <th class="pe-4 number">ID</th>
                            <th class="pe-4 number" >Year</th>
                            <th>Month</th>
                            <th>Folder Name</th>
                            <th>Folder Type</th>
                            <th>Number</th> <!-- Column to truncate -->
                            <th>Submission Date</th>
                            <th>Status</th>
                            <th>Others</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>
                                    <div class="icon-container">
                                        <a href="#!"><i class="fa-solid fa-trash action-icon delete-icon"></i></a>
                                        <a href="#!"><i class="fa-solid fa-pen-to-square action-icon edit-icon"></i></a>
                                        <a href="#!"><i class="fa-solid fa-eye action-icon view-icon"></i></a>
                                    </div>
                                </td>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->year->year ?? 'N/A' }}</td>
                                <td>{{ strtoupper(date('F', mktime(0, 0, 0, $record->month, 1))) }}</td>
                                <td>{{ strtoupper(str_replace('_', ' ', $record->folder_name)) }}</td>
                                <td>{{ $record->folder_type }}</td>
                                <td class="table-column-truncate">{{ $record->number }}</td>
                                <td>
                                    {{ $record->submissionYear->year ?? 'N/A' }}, {{ strtoupper(date('F', mktime(0, 0, 0, $record->submission_month, 1))) }}
                                </td>
                                <td>
                                    <div class="status {{ $record->status === 'completed' ? 'completed' : 'in-progress' }}">
                                        {{ strtoupper(str_replace('_', ' ', $record->status)) }} <!-- Format status -->
                                    </div>
                                </td>
                                <td>{{ $record->others }}</td>
                                <td>{{ $record->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</main>
<!-- end: Main -->

@endsection
