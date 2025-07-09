<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/PLN.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="width: 35px; height: 35px; opacity: .9; margin-right: 10px;">
        <span class="brand-text font-weight-bold text-white">⚡ My PLN</span>
    </a>

    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.informasi-pemadaman.index') }}" class="nav-link {{ request()->routeIs('admin.informasi-pemadaman.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bolt"></i>
                        <p>Informasi Pemadaman</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.informasi-gangguan.index') }}" class="nav-link {{ request()->routeIs('admin.informasi-gangguan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>Informasi Gangguan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.laporan-gangguan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan-gangguan.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Gangguan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.pengguna.index') }}" class="nav-link {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
