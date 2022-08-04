<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">SILATIK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @role('admin')

            @endrole

            @role('kabps')
                @include('components.partials.sidebar-template.template-kepala')
            @endrole

            @role('kabag')
                @include('components.partials.sidebar-template.template-kabag')
            @endrole

            @role('kf')
                @include('components.partials.sidebar-template.template-kf')
            @endrole

            @role('skf')
                @include('components.partials.sidebar-template.template-skf')
            @endrole

            @role('sekretaris')
                @include('components.partials.sidebar-template.template-sekretaris')
            @endrole

            @role('staf')
                @include('components.partials.sidebar-template.template-staf')
            @endrole
        </ul>
    </aside>
  </div>
