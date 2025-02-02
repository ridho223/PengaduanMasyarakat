<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (optional, for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <style>
        /* Sidebar */
        .navbar-nav.sidebar {
            background: linear-gradient(135deg, #333333, #555555, #ffffff);
        }

        /* Warna teks pada sidebar dan topbar */
        .navbar-nav.sidebar .nav-link,
        .navbar.topbar .nav-link,
        .navbar.topbar .navbar-nav .nav-item .nav-link,
        .navbar.topbar .navbar-nav .nav-item .dropdown-menu .dropdown-item {
            color: #fff;
        }

        /* Warna ikon pada sidebar dan topbar */
        .navbar-nav.sidebar .nav-link i,
        .navbar.topbar .nav-link i {
            color: #fff;
        }

        /* Warna teks saat hover pada sidebar dan topbar */
        .navbar-nav.sidebar .nav-link:hover,
        .nav-link:hover,
        .navbar-nav .nav-item .nav-link:hover,
        .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover .navbar-nav.nav-item.nav-link.i:hover {
            color: #000;
            background-color: #776767;
        }

        /* Warna latar belakang item aktif pada sidebar */
        .navbar-nav.sidebar .nav-item.active {
            background-color: #776767;
        }

        /* Warna teks item aktif pada sidebar */
        .navbar-nav.sidebar .nav-item.active .nav-link {
            color: #000;
            background-color: #776767;
        }

        h2 {
            color: #776767 !important;
            /* color: linear-gradient(135deg, #333333, #555555, #ffffff); */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @if (Route::currentRouteName() !== 'auth.login')
            @if(auth()->user()->status == 'Admin')
                @include('layouts.sidebar')
            @endif
        @endif
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @if (Route::currentRouteName() !== 'auth.login')
                    @if (auth()->user() && auth()->user()->status == 'Admin')
                        @include('layouts.topbar')
                    @elseif (auth()->user() && auth()->user()->status == 'User')
                        @include('layouts.topbar-user')
                    @endif
                @endif
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @if (!in_array(Route::currentRouteName(), ['auth.login', 'admin.resident.create', 'admin.resident.edit', 'user.pengaduan.create', 'user.pengaduan.edit', 'admin.dashboard', 'admin.kategori_pengaduan.create', 'admin.kategori_pengaduan.edit', 'admin.profile.edit', 'user.profile.edit']))
                @if (auth()->user() && auth()->user()->status == 'Admin')
                    @include('layouts.footer') <!-- Footer untuk Admin -->
                @elseif (auth()->user() && auth()->user()->status == 'User')
                    @include('layouts.footer-user') <!-- Footer untuk Pengguna -->
                @endif
            @endif
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>


    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include DataTables JS and Bootstrap integration -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true,
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    }
                }
            });
        });  
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '<strong>Berhasil!</strong>',
                html: '<p>{{ session('success') }}</p>',
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                background: '#e9f7ef',
                color: '#28a745',
                customClass: {
                    popup: 'animated tada'
                }
            });
        </script>
    @endif
    {{--
    @if (session('deleted'))
    <script>
        Swal.fire({
            title: '<i class="ti-trash" style="color: #dc3545; font-size: 24px;"></i> <strong>Data Dihapus!</strong>',
            html: '<p>{{ session('deleted') }}</p>',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            background: '#fdecea',
            color: '#dc3545',
            customClass: {
                popup: 'animated bounceIn'
            }
        });
    </script>

    @endif --}}
</body>

</html>