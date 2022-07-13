<x-layouts.base>
    <div class="main-wrapper">
        @include('components.partials.navbar')

        @include('components.partials.sidebar')

        <div class="main-content">
            {{ $slot }}
        </div>

        @include('components.partials.footer')
    </div>
</x-layouts.base>
