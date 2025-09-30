<ul class="navbar-nav bg-attendance sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
        <div class="sidebar-brand-text">Attendance System</div>
    </a>
    <li class="nav-item {{ Request::routeIs('index') || Request::is('dashboard*')? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fas fa-tasks"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Presensi
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fas fa-chart-area"></i>
            <span>Riwayat Presensi</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('request*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('request.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Pengajuan Ijin</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master Data
    </div>
    <li class="nav-item {{ Request::is('master/users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pegawai</span>
        </a>
    </li>
    

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
