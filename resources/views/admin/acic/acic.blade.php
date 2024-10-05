@extends('base')

@section('title')
    Admin ACIC Records
@endsection

@section('content')

        <!-- start: Sidebar -->
        <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
                <div class="d-flex align-items-center p-3">
                    <a href="{{ url('admin/dashboard') }}" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4 text-center logo-text">ADMIN</a>
                    <i class="sidebar-toggle fa-solid fa-bars ms-auto fs-5 d-none d-md-block burger"></i>
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


            @if(Auth::check())
                <div class="dropdown">
                    <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-sm-block pe-2">{{ Auth::user()->name }}</span>
                        <img class="navbar-profile-image" src="{{ asset('assets/img/ched_logo.png') }}" alt="Image" />
                    </div>
                    <ul class="dropdown-menu ms-5" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('admin/profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
                        <hr class="w-100">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>

        <!-- start: Content -->
        <div class="py-4 mt-5">
            <!-- start: Summary -->

            {{-- <div class="d-flex justify-content-end mb-3 mx-5">
                <a href="{{ url('admin/acic/add') }}" id="acic_add_new_record" class="btn add_record_button" type="button"> Add new ACIC record</a>
            </div> --}}


            {{-- MODAL --}}
            @foreach ($acic_records as $record)
                <!-- Modal for viewing record details -->
                <div class="modal fade" id="viewRecordModal{{ $record->id }}" tabindex="-1" aria-labelledby="viewRecordLabel{{ $record->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header my-auto status-container {{ $record->status === 'completed' ? 'completed' : 'in-progress' }}" style="display: flex; align-items: center; justify-content: center; position: relative;">
                                <span class="text-center">{{ strtoupper(str_replace('_', ' ', $record->status)) }} <!-- Format status --></span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px;"></button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="head-folder-container mb-4">
                                    {{-- <div class="mb-3 mb-2 status-container {{ $record->status === 'completed' ? 'completed' : 'in-progress' }} ">
                                        {{ strtoupper(str_replace('_', ' ', $record->status)) }} <!-- Format status -->
                                    </div> --}}

                                    <div class="folder-name-container">
                                        <h2>{{ strtoupper(str_replace('_', ' ', $record->folder_name)) }}</h2> <!-- Capitalize folder name -->
                                    </div>

                                    <div class="date-container">
                                        <span class="date">{{ strtoupper(date('F', mktime(0, 0, 0, $record->month, 1))) }}</span>
                                        <span class="date">{{ strtoupper($record->year->year) }}</span>
                                    </div>
                                </div>

                                <div class="footer-folder-container">
                                    <div class="type-container">{{ strtoupper($record->folder_type) }} NUMBER</div>
                                    <div class="others-container mb-2">{{ $record->others }}</div>
                                    <div class="number-container">{{ $record->number }}</div>
                                    <div class="sub-date-container mt-3 mb-3">
                                        <p><b>SUBMISSION DATE:</b> {{ strtoupper(date('F', mktime(0, 0, 0, $record->submission_month, 1))) }}, {{ strtoupper($record->submissionYear->year ?? 'N/A') }}</p>
                                    </div>
                                    <div class="remarks-container">{{ $record->remarks }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- END MODAL --}}


            <div class="table-container mb-5">
                <table id="table_data" class="table table-striped table-hover mt-3 table-edit mb-3" style="width:100%">
                    <thead>
                        <tr>
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
                            <th>
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acic_records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->year->year ?? 'N/A' }}</td>
                                <td>{{ strtoupper(date('F', mktime(0, 0, 0, $record->month, 1))) }}</td>
                                <td>{{ strtoupper(str_replace('_', ' ', $record->folder_name)) }}</td>
                                <td>{{ strtoupper($record->folder_type) }} NUMBER</td>
                                <td class="table-column-truncate">{{ $record->number }}</td>
                                <td>
                                    {{ $record->submissionYear->year ?? 'N/A' }}, {{ strtoupper(date('F', mktime(0, 0, 0, $record->submission_month, 1))) }}
                                </td>
                                <td>{{ $record->others }}</td>
                                <td>{{ $record->remarks }}</td>
                                <td>
                                    <div class="status {{ $record->status === 'completed' ? 'completed' : 'in-progress' }}">
                                        {{ strtoupper(str_replace('_', ' ', $record->status)) }} <!-- Format status -->
                                    </div>
                                </td>
                                <td>
                                    <div class="icon-container">
                                        <a href="javascript:void(0);" role="button" data-bs-toggle="modal" data-bs-target="#viewRecordModal{{ $record->id }}" type="button">
                                            <i class="fa-solid fa-eye action-icon view-icon"></i>
                                        </a>
                                        <a href="{{ url('admin/records/'. $record->id .'/edit') }}">
                                            <i class="fa-solid fa-pen-to-square action-icon edit-icon"></i>
                                        </a>
                                        <form id="delete-form-{{ $record->id }}" action="{{ url('admin/records/' . $record->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-button" data-id="{{ $record->id }}" style="border: none; background: none; padding: 0;">
                                                <i class="fa-solid fa-trash action-icon delete-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <script>
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const recordId = this.getAttribute('data-id');
                        const form = document.getElementById(`delete-form-${recordId}`);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Submit the form to delete the record

                                // // Display success message
                                // Swal.fire({
                                //     title: 'Deleted!',
                                //     text: 'Your file has been deleted.',
                                //     icon: 'success',
                                //     timer: 2000, // Message will last for 2 seconds
                                //     showConfirmButton: false // Hide confirm button
                                // });
                            }
                        });
                    });
                });
            </script>

            <!-- end: Content -->
        </div>
    </div>
</main>
<!-- end: Main -->

@endsection
