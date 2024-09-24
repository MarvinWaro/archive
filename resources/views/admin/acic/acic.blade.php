@extends('base')

@section('title')
    Admin | Acic  Folder
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
                    <li class="sidebar-menu-item">
                        <a href="{{ url('admin/dashboard') }}" class="fw-semibold">
                            <i class="fa-solid fa-chart-pie sidebar-menu-item-icon py-2"></i>
                            {{-- <i class="ri-dashboard-line sidebar-menu-item-icon"></i> --}}
                            DASHBOARD
                        </a>
                    </li>

                    <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">ACIC</li>

                    <li class="sidebar-menu-item active">
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

            <h5 class="fw-bold mb-0 me-auto" id="head">ACIC</h5>


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
        <div class="py-4 mt-5">
            <!-- start: Summary -->

            {{-- <div class="d-flex justify-content-end mb-3 mx-5">
                <a href="{{ url('admin/acic/add') }}" id="acic_add_new_record" class="btn add_record_button" type="button"> Add new ACIC record</a>
            </div> --}}


            {{-- MODAL --}}
            {{-- <div class="modal fade" id="addNewRecordModal" tabindex="-1" aria-labelledby="addNewRecordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewRecordModalLabel">Add New MDS Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                <form id="addRecordForm">
                                    <div class="row mx-3">

                                        <h6>Folder Year and Month</h6>
                                        <div class="col-lg-6 mb-3">
                                            <label for="yearSelect" class="form-label">Year</label>
                                            <select id="yearSelect" class="form-select">
                                                <!-- Generate year options dynamically if needed -->
                                                <option value="">Select Year</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="monthSelect" class="form-label">Month</label>
                                            <select id="monthSelect" class="form-select">
                                                <!-- Placeholder for month selection -->
                                                <option value="">Select Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="folder_name_select" class="form-label">Folder Name</label>
                                            <select id="folder_name_select" class="form-select">
                                                <!-- Generate year options dynamically if needed -->
                                                <option value="">Select Folder Name</option>
                                                <option value="acic_151">ACIC 151</option>
                                                <option value="acic_101">ACIC 101</option>
                                                <option value="acic_cosco">ACIC COSCO</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label for="folder_number_select" class="form-label">Folder Number</label>
                                            <select id="folder_number_select" class="form-select">
                                                <!-- Generate year options dynamically if needed -->
                                                <option value="">Select Year</option>
                                                <option value="check">Check Number</option>
                                                <option value="acic">Acic Number</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>
                                        <div class="col-lg-8 mb-3">
                                            <label for="text_num" class="form-label">Number</label>
                                            <textarea name="text_area" id="text_area" cols="30" rows="4" class="form-control" placeholder="Please Enter Acic / Check Number Here"></textarea>
                                        </div>

                                        <h6>Submission Date</h6>
                                        <div class="col-lg-6 mb-3">
                                            <label for="yearSelect" class="form-label">Year</label>
                                            <select id="yearSelect" class="form-select">
                                                <!-- Generate year options dynamically if needed -->
                                                <option value="">Select Year</option>
                                                <option value="2024">2024</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="monthSelect" class="form-label">Month</label>
                                            <select id="monthSelect" class="form-select">
                                                <!-- Placeholder for month selection -->
                                                <option value="">Select Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" class="form-select">
                                                <!-- Generate year options dynamically if needed -->
                                                <option value="">Select Status</option>
                                                <option value="in_progress">In-Progress</option>
                                                <option value="completed">Completed</option>
                                                <!-- Add more years as needed -->
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="others" class="form-label">Others</label>
                                            <input type="text" name="others" id="others" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea name="text_area" id="text_area" cols="30" rows="4" class="form-control" placeholder="Enter your remarks or comments here"></textarea>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveRecordButton">Save Record</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- END MODAL --}}


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
                        @foreach ($acic_records as $record)
                            <tr>
                                <td>
                                    <div class="icon-container">
                                        <!-- Delete Button -->
                                        <form action="{{ url('admin/records/' . $record->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none; padding: 0;">
                                                <i class="fa-solid fa-trash action-icon delete-icon"></i>
                                            </button>
                                        </form>
                                        <!-- Edit Button -->
                                        <a href="{{ url('admin/records/'. $record->id .'/edit') }}">
                                            <i class="fa-solid fa-pen-to-square action-icon edit-icon"></i>
                                        </a>
                                        <!-- View Button -->
                                        <a href="#!">
                                            <i class="fa-solid fa-eye action-icon view-icon"></i>
                                        </a>
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


            <!-- end: Content -->
        </div>
    </div>
</main>
<!-- end: Main -->

@endsection
