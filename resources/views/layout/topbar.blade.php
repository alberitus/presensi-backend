<nav class="navbar navbar-expand navbar-light bg-attendance topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}">
                <i class="fas fa-user-lock text-warning"></i>
                <span class="ms-4">{{ ucwords(Auth::user()->nama_lengkap) }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt text-danger"></i>
            </a>
        </li>
    </ul>
</nav>