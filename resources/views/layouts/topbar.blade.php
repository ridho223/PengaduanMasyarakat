<style>
    .topbar {
        background: linear-gradient(135deg, #333333, #555555, #ffffff);
        color: #fff;
    }

    .nav-link:hover {
        text-decoration: none;
        background-color: transparent;
        color: inherit;
    }

    /* Warna dropdown saat hover */
    .navbar-nav .nav-dropdown .dropdown-menu .dropdown-item:hover {
        background-color: aqua;
        color: #000;
    }

    /* Warna isi dropdown */
    .dropdown-menu {
        background-color: rgba(30, 30, 30, 0.9);
        border: none;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #776767;
        color: black;
    }

    .btn {
        background-color: #776767;
    }

    .btn:hover {
        background-color: rgba(30, 30, 30, 0.9);
    }
</style>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-custom-green topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- User Information -->
        <li class="nav dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark small">{{ Auth::user()->email }}</span>
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mm&s=30' }}"
                    class="rounded-circle" width="30" height="30" alt="User Avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-white" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-white" href="#" onclick="confirmLogout(event)">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>
<script>
    function confirmLogout(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Keluar dari Aplikasi?',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Keluar',
            confirmButtonColor: '#776767',
            cancelButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit(); // Kirim form logout
            }
        });
    }
</script>

{{--
<script>
    document.getElementById('logoutLink').addEventListener('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: `
        Apakah Anda yakin ingin keluar?
        <small class="text-muted">klik keluar untuk logout !</small>
    `,
            customClass: {
                icon: 'swal-custom-icon',
                popup: 'swal-custom-pop',
                title: 'swal-title',
                confirmButton: 'swal-confirm-button',
                denyButton: 'swal-deny-button',
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            confirmButtonColor: '#FDD97C',
            cancelButtonColor: 'black'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    });
</script> --}}
<!-- End of Topbar -->