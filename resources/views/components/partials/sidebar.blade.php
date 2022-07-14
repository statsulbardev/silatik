<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ env('APP_URL') . 'dashboard' }}">SILATIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ env('APP_URL') . 'dashboard' }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ env('APP_URL') . 'surat-masuk' }}" class="nav-link">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{ env('APP_URL') . 'surat-keluar'}}" class="nav-link">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>
            <li>
                <a href="" class="nav-link">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Disposisi Surat</span>
                </a>
            </li>
        </ul>
    </aside>
  </div>
