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
            @switch(auth()->user()->roles[0]->name)
                @case('kabps')
                    @include('components.partials.sidebar-template.template-kepala')
                    @break
                @case('sekretaris')
                    @include('components.partials.sidebar-template.template-sekretaris')
                    @break
                @case('kf')
                    @include('components.partials.sidebar-template.template-kf')
                    @break
            @endswitch
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
