<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <!-- end: Icons -->

    <!-- start: CSS -->
    <link rel="icon" href="{{ asset('assets/img/ched_logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- end: CSS -->

    {{-- Font Awesome --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css"> --}}
    {{-- <script src="<script src="https://kit.fontawesome.com/0be17aec56.js" crossorigin="anonymous"></script>"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- Data Tables --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">


    {{-- Sweetalert --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css"> --}}



    <title>CHED | @yield('title')</title>
</head>

<body>

    <div class="main-container">
        @yield('content')
    </div>

    <!-- start: JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- end: JS -->

    {{-- Data table Js --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

{{--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}

    {{-- sweetalert --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script> --}}

    <script>
        $(document).ready(function () {
            // Initialize DataTable if not already initialized
            if (!$.fn.DataTable.isDataTable('#table_data')) {
                var table = $('#table_data').DataTable({
                    responsive: true,
                    columnDefs: [
                        {
                            targets: 6, // The "Number" column (7th column, 0-indexed)
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 7) {
                                    // Truncate the data to 7 characters and append '...'
                                    return data.substring(0, 7) + '...';
                                }
                                return data; // Return the original data for all other types (search, sort, etc.)
                            }
                        },
                        {
                            targets: 9, // The "Others" column (10th column, 0-indexed)
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 10) {
                                    // Truncate the data to 10 characters and append '...'
                                    return data.substring(0, 10) + '...';
                                }
                                return data; // Return the original data for other types
                            }
                        },
                        {
                            targets: 10, // The "Remarks" column (11th column, 0-indexed)
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 10) {
                                    // Truncate the data to 10 characters and append '...'
                                    return data.substring(0, 10) + '...';
                                }
                                return data; // Return the original data for other types
                            }
                        }
                    ],
                    language: {
                        emptyTable: "No records available" // Custom message when the table has no data
                    }
                });

                // Enable FixedHeader
                new $.fn.dataTable.FixedHeader(table);
            }
        });
    </script>


</body>
</html>
