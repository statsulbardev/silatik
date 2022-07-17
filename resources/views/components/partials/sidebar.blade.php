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
            <li class="menu-header">PERSURATAN</li>
            <li>
                @switch(auth()->user()->roles[0]->name)
                    @case('kabps')
                        <a href="{{ env('APP_URL') . 'surat-masuk/pemeriksaan' }}" class="nav-link">
                            <i class="fas fa-mail-bulk"></i>
                            <span>Surat Masuk</span>
                        </a>
                        @break
                    @default
                    <a href="{{ env('APP_URL') . 'surat-masuk' }}" class="nav-link">
                        <i class="fas fa-mail-bulk"></i>
                        <span>Surat Masuk</span>
                    </a>
                @endswitch
            </li>
            <li>
                <a href="{{ env('APP_URL') . 'surat-keluar'}}" class="nav-link">
                    <i class="fas fa-inbox"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>
            <li class="menu-header">PENGATURAN</li>
        </ul>
    </aside>
  </div>
