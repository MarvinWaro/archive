<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/img/ched_logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>CHED | @yield('title')</title>
</head>

<body>
    <div class="main-container">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#table_data')) {
                var table = $('#table_data').DataTable({
                    responsive: true,
                    columnDefs: [
                        {
                            targets: 5,
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 7) {
                                    return data.substring(0, 7) + '...';
                                }
                                return data;
                            }
                        },
                        {
                            targets: 7,
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 10) {
                                    return data.substring(0, 10) + '...';
                                }
                                return data;
                            }
                        },
                        {
                            targets: 8,
                            render: function (data, type, row) {
                                if (type === 'display' && data.length > 10) {
                                    return data.substring(0, 10) + '...';
                                }
                                return data;
                            }
                        }
                    ],
                    language: {
                        emptyTable: "No records available"
                    }
                });

                new $.fn.dataTable.FixedHeader(table);
            }
        });
    </script>
</body>
</html>
