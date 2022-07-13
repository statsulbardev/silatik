<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ env('APP_URL') . 'dashboard' }}">SILATIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item active">
                <a href="{{ env('APP_URL') . 'dashboard' }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Surat Masuk</li>
            <li class="nav-item">
                <a href="{{ env('APP_URL') . 'surat-masuk' }}" class="nav-link">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Daftar Surat</span>
                </a>
                <a href="{{ env('APP_URL') . 'surat-masuk/tambah' }}" class="nav-link">
                    <i class="fas fa-envelope-open"></i>
                    <span>Tambah Surat</span>
                </a>
            </li>
            <li class="menu-header">Surat Keluar</li>
            <li class="nav-item">
                <a href="{{ env('APP_URL') . 'surat-keluar'}}" class="nav-link">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Daftar Surat</span>
                </a>
                <a href="{{ env('APP_URL') . 'surat-keluar/tambah' }}" class="nav-link">
                    <i class="fas fa-envelope-open"></i>
                    <span>Tambah Surat</span>
                </a>
            </li>
        </ul>
    </aside>
  </div>
