<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name') }}</title>

    {{-- Deliver By CDN --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- For Development Use Only --}}
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . 'vendor/stisla/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . 'vendor/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset(env('APP_URL') . 'vendor/stisla/css/components.css') }}">

    @livewireStyles
</head>
<body>
    <div id="app">
        {{ $slot }}
    </div>

    @livewireScripts

    @if (config('app.env') == 'production')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    @else
        <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/temp/jquery.min.js') }}"></script>
        <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/temp/popper.min.js') }}"></script>
        <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/temp/bootstrap.min.js') }}"></script>
        <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/temp/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/temp/moment.min.js') }}"></script>
    @endif

    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/stisla.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/scripts.js') }}"></script>
    <script src="{{ secure_asset(env('APP_URL') . 'vendor/stisla/js/custom.js') }}"></script>
</body>
</html>
