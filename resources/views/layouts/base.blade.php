<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta Information --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>@yield('title') - {{ config('app.name') }}</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . 'vendor/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . 'vendor/stisla/css/components.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">

    {{-- Custom Styles --}}
    @yield('styles')

    {{-- Livewire Style --}}
    @livewireStyles
</head>
<body>
    <div id="app">
        {{ $slot }}
    </div>

    {{-- Livewire Script --}}
    @livewireScripts

    {{-- Template Script --}}
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/stisla.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/scripts.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/custom.js') }}"></script>

    {{-- Custom Scripts --}}
    @stack('scripts')
</body>
</html>
