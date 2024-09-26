@extends('base')

@section('title')
    Admin Edit Record
@endsection

@section('content')

        <!-- start: Sidebar -->
        <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
                <div class="d-flex align-items-center p-3">
                    <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4 text-center logo-text">ADMIN</a>
                    <i class="sidebar-toggle fa-solid fa-bars ms-auto fs-5 d-none d-md-block burger"></i>
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

            <h5 class="fw-bold mb-0 me-auto" id="head">Edit Record Section</h5>


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


            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form id="editRecordForm" action="{{ url('admin/records/'.$record->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mx-3">
                            <h6 class="heading-form">Folder Year and Month</h6>

                            <div class="col-lg-6 mb-3">
                                <label for="yearSelect" class="form-label required">Year</label>
                                <select id="yearSelect" name="year_id" class="form-select" required>
                                    <option value="">Select Folder Year</option>
                                    @foreach ($years as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $record->year_id ? 'selected' : '' }}>{{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="monthSelect" class="form-label required">Month</label>
                                <select id="monthSelect" name="month" class="form-select" required>
                                    <option value="">Select Month</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ str_pad($month, 2, '0', STR_PAD_LEFT) == $record->month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="folder_name_select" class="form-label required">Folder Name</label>
                                <select id="folder_name_select" name="folder_name" class="form-select" required>
                                    <option value="">Select Folder Name</option>
                                    <option value="acic_151" {{ $record->folder_name == 'acic_151' ? 'selected' : '' }}>ACIC 151</option>
                                    <option value="acic_101" {{ $record->folder_name == 'acic_101' ? 'selected' : '' }}>ACIC 101</option>
                                    <option value="acic_cosco" {{ $record->folder_name == 'acic_cosco' ? 'selected' : '' }}>ACIC COSCO</option>
                                    <option value="mds_151" {{ $record->folder_name == 'mds_151' ? 'selected' : '' }}>MDS 151</option>
                                    <option value="mds_101" {{ $record->folder_name == 'mds_101' ? 'selected' : '' }}>MDS 101</option>
                                </select>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label for="folder_number_select" class="form-label required">Folder Type</label>
                                <select id="folder_number_select" name="folder_type" class="form-select" required>
                                    <option value="">Select Folder Type</option>
                                    <option value="check" {{ $record->folder_type == 'check' ? 'selected' : '' }}>Check Number</option>
                                    <option value="acic" {{ $record->folder_type == 'acic' ? 'selected' : '' }}>Acic Number</option>
                                </select>
                            </div>

                            <div class="col-lg-8 mb-3">
                                <label for="text_num" class="form-label required">Number</label>
                                <textarea id="text_num" name="number" cols="30" rows="4" class="form-control" placeholder="Please Enter Acic / Check Number Here" required>{{ $record->number }}</textarea>
                            </div>

                            <h6 class="heading-form">Submission Date</h6>

                            <div class="col-lg-6 mb-3">
                                <label for="submission_year_select" class="form-label required">Submission Year</label>
                                <select id="submission_year_select" name="submission_year_id" class="form-select" required>
                                    <option value="">Select Submission Year</option>
                                    @foreach ($submission_years as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $record->submission_year_id ? 'selected' : '' }}>{{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="submission_month_select" class="form-label required">Submission Month</label>
                                <select id="submission_month_select" name="submission_month" class="form-select" required>
                                    <option value="">Select Month</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ str_pad($month, 2, '0', STR_PAD_LEFT) == $record->submission_month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="status" class="form-label required">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="in_progress" {{ $record->status == 'in_progress' ? 'selected' : '' }}>In-Progress</option>
                                    <option value="completed" {{ $record->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="others" class="form-label required">Others</label>
                                <input type="text" name="others" id="others" class="form-control" value="{{ $record->others }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea id="remarks" name="remarks" cols="30" rows="4" class="form-control" placeholder="Enter your remarks or comments here">{{ $record->remarks }}</textarea>
                            </div>

                            <div class="d-flex flex-column flex-md-row justify-content-between">
                                <a href="{{ url('admin/dashboard') }}" type="button" class="btn btn-secondary w-100 w-md-50 me-0 me-md-2 mb-2 mb-md-0 p-2">Back</a>
                                <button type="submit" id="updateRecord" class="btn btn-success w-100 w-md-50 ms-0 ms-md-2 p-2">Update Record</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




            <!-- end: Content -->
        </div>
    </div>
</main>
<!-- end: Main -->

@endsection

