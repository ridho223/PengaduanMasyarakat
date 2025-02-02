<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <h3 class="sidebar-brand-text mx-3" style="color: rgb(247, 238, 238); font-style:italic;">Halo Pak</h3>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link"
            href="{{ route(auth()->user()->status == 'Admin' ? 'admin.dashboard' : 'user.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Data Masyarakat - Hanya terlihat untuk Admin -->
    @if(auth()->user()->status == 'Admin')
        <li class="nav-item {{ request()->is('admin/resident*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.resident.index') }}">
                <i class="fas fa-users"></i>
                <span>Data Masyarakat</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->status == 'Admin')
        <li class="nav-item {{ request()->is('admin/Admin*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.Admin.index') }}">
                <i class="fas fa-user-tie"></i>
                <span>Data Admin</span>
            </a>
        </li>
    @endif

    <!-- Data Pengaduan - Hanya terlihat untuk Pengguna -->
    {{-- @if(auth()->user()->status == 'User')
    <li class="nav-item {{ request()->is('user/pengaduan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.pengaduan.index') }}">
            <i class="fas fa-file-alt"></i>
            <span>Pengaduan</span>
        </a>
    </li>
    @endif --}}

    <!-- Rekap Laporan - Hanya terlihat untuk Admin -->
    @if(auth()->user()->status == 'Admin')
        <li class="nav-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.pengaduan.index') }}">
                <i class="fas fa-chart-bar"></i>
                <span> Data Pengaduan</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->status == 'Admin')
        <li class="nav-item {{ request()->is('admin/kategori_pengaduan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kategori_pengaduan.index') }}">
                <i class="fas fa-chart-bar"></i>
                <span> Kategori Pengaduan</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->status == 'Admin')
        <li class="nav-item {{ request()->is('admin/rekap*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.rekap.index') }}">
                <i class="fas fa-chart-bar"></i>
                <span>Rekap Pengaduan</span>
            </a>
        </li>
    @endif

    <!-- Profile Akun -->
    <li class="nav-item {{ request()->is('admin/profil') || request()->is('user/profil') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route(auth()->user()->status == 'Admin' ? 'admin.profile' : 'user.profile') }}">
            <i class="fas fa-user"></i>
            <span>Profile Akun</span>
        </a>
    </li>
</ul>