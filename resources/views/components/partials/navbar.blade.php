<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    {{-- <div class="mr-auto"></div> --}}
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="unit-kerja">
            <span class="text-white font-weight-bold">{{ auth()->user()->relasiUnitKerja->nama }}</span>
        </div>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ secure_asset(env('APP_URL') . 'icons/avatar.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->nama }}</div>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profil Saya
                </a>
                <a href="{{ route('versi') }}" class="dropdown-item has-icon">
                    <i class="fas fa-tags"></i> Versi Aplikasi
                </a>
                <div class="dropdown-divider"></div>
                <livewire:auth.logout />
            </div>
        </li>
    </ul>
</nav>
