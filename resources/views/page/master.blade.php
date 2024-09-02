<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
    @vite(['resources/sass/page.scss','resources/js/page.js'])

    {{--    style--}}
    @stack('style')
</head>
<body class="bg-black">
<main id="app" class="container-fluid">
    <div class="container">
        @include('page.navigationBar')
        <hr>
        @yield('content')
    </div>
</main>

@stack('script')

</body>
</html>
