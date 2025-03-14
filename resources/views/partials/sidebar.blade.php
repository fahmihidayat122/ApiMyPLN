<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">My PLN</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.informasi-pemadaman.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bolt"></i>
                        <p>Informasi Pemadaman</p>
                    </a>
                </li>    
                <li class="nav-item">
                    <a href="{{ route('admin.informasi-gangguan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>Informasi Gangguan</p>
                    </a>
                </li>  
                <li class="nav-item">
                    <a href="{{ route('admin.laporan-gangguan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Gangguan</p>
                    </a>
                </li>  
                <!-- Menu Lihat Daftar Pengguna -->
                <li class="nav-item">
                    <a href="{{ route('admin.pengguna.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Lihat Daftar Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
