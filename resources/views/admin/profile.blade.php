@extends('base')

@section('title')
    Admin Profile
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

            <h5 class="fw-bold mb-0 me-auto" id="head">Profile</h5>


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


        <!-- Success Message -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: '{{ session('success') }}',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Okay',
                    timer: 5000,
                    backdrop: `rgba(0, 0, 0, 0.5)`,
                    customClass: {
                        title: 'my-title',
                        popup: 'my-popup',
                        confirmButton: 'my-confirm-button',
                    },
                    position: 'top-end',
                    width: '400px',
                    padding: '10px',
                });
            </script>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <script>
                Swal.fire({
                    title: '{{ session('error') }}',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    timer: 5000,
                    backdrop: `rgba(0, 0, 0, 0.5)`,
                    customClass: {
                        title: 'my-danger-title',
                        popup: 'my-danger-popup',
                        confirmButton: 'my-danger-confirm-button',
                    },
                    position: 'top-end',
                    width: '400px',
                    padding: '10px',
                });
            </script>
        @endif

        <!-- Validation Error Handling -->
        @if($errors->any())
            <script>
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    html: `<ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    timer: 5000,
                    backdrop: `rgba(0, 0, 0, 0.5)`,
                    customClass: {
                        title: 'my-danger-title',
                        popup: 'my-danger-popup',
                        confirmButton: 'my-danger-confirm-button',
                    },
                    position: 'top-end',
                    width: '400px',
                    padding: '10px',
                });
            </script>
        @endif



        <!-- start: Content -->
        <div class="py-4 mt-5">
            <!-- start: Summary -->
                <div class="container ">

                    <div class="profile-wrapper mb-5">
                        <h3 class="maincolor fw-bold mt-3 mb-5"><i class="fa-solid fa-user me-3"></i>Profile Information</h3>
                        <div class="mt-4">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf <!-- Add this for form security -->
                                @method('PUT') <!-- Use PUT for updating data -->

                                <div class="mb-3">
                                    <label for="name" class="form-label label-custom">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label label-custom">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="profile-wrapper mb-5">

                        <h3 class="maincolor fw-bold mt-3 mb-5"><i class="fa-solid fa-shield-halved me-3"></i>Account and Security</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="">
                                        <h5 class="mb-3 text-center">Account Password</h5>
                                        <form action="{{ route('admin.updatePassword') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="current_password" class="form-label label-custom">Current Password</label>
                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="new_password" class="form-label label-custom">New Password</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="new_password_confirmation" class="form-label label-custom">Confirm New Password</label>
                                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary mb-3">Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="li-wrapper">
                                        <h5 class="mb-5 text-center">Login History</h5>

                                        <ul class="list-group">
                                            @foreach ($user->loginHistories->sortByDesc('logged_in_at')->take(5) as $login)
                                                <li class="list-group-item">
                                                    Logged in on <strong>{{ $login->logged_in_at->format('Y-m-d H:i:s') }}</strong> from IP address <strong>{{ $login->ip_address }}</strong> using <strong>{{ $login->browser }} (v{{ $login->browser_version }})</strong> on <strong>{{ $login->os }} {{ $login->os_version }}</strong>.
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if ($user->loginHistories->count() > 5)
                                            <!-- View More Button -->
                                            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#loginHistoryModal">
                                                View More
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- View All Modal -->
                                <div class="modal fade" id="loginHistoryModal" tabindex="-1" aria-labelledby="loginHistoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Added modal-dialog-centered here -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="loginHistoryModalLabel">Full Login History</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                <ul class="list-group">
                                                    @foreach ($user->loginHistories->sortByDesc('logged_in_at') as $login)
                                                        <li class="list-group-item">
                                                            Logged in on <strong>{{ $login->logged_in_at->format('Y-m-d H:i:s') }}</strong> from IP address <strong>{{ $login->ip_address }}</strong> using <strong>{{ $login->browser }} (v{{ $login->browser_version }})</strong> on <strong>{{ $login->os }} {{ $login->os_version }}</strong>.
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </div>

                    <div class="profile-wrapper mb-5">
                        <h3 class="maincolor fw-bold mt-3 mb-5">
                            <i class="fa-solid fa-triangle-exclamation me-3"></i>Danger Zone
                        </h3>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-center">
                                <div class="container delete-account-custom">
                                    <h6 class="mt-3 delete-account-heading">Delete Account</h6>
                                    <p class="delete-account-subheading">Warning. Once you delete your account, there's no going back</p>
                                    <form class="delete-button-profile" id="delete-account-form" action="{{ route('deleteAccount') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" id="delete-account-btn">Delete This Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('delete-account-btn').addEventListener('click', function (e) {
                            e.preventDefault(); // Prevent the form from submitting immediately
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This action is irreversible. Do you really want to delete your account?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // If the user confirmed, submit the form
                                    document.getElementById('delete-account-form').submit();
                                }
                            });
                        });
                    </script>

                </div>


            <!-- end: Content -->
        </div>
    </div>
</main>
<!-- end: Main -->

@endsection
