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
            @switch(auth()->user()->roles->sortDesc()->max()->name)
                @case('admin')
                    @break
                @case('kabps')
                    @include('components.partials.sidebar-template.template-kepala')
                    @break
                @case('sekretaris')
                    @include('components.partials.sidebar-template.template-sekretaris')
                    @break
                @case('kf')
                    @include('components.partials.sidebar-template.template-kf')
                    @break
                @case('kabag')
                    @include('components.partials.sidebar-template.template-kabag')
                    @break
                @case('skf')
                    @include('components.partials.sidebar-template.template-skf')
                    @break
                @case('staf')
                    @include('components.partials.sidebar-template.template-staf')
                    @break
            @endswitch
        </ul>
    </aside>
  </div>
