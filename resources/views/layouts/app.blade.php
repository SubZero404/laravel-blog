<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}

    <!-- Scripts -->

    @vite(['resources/sass/app.scss','resources/js/app.js'])

    {{--    style--}}
    @stack('style')
</head>
<body>
    <main id="app" class="container-fluid">
        @auth
            <div class="row">
                <!--            navigation menu bar start -->
                <div class="col-sm-3 col-lg-2 d-none d-sm-block vh-100 bg-black overflow-scroll scrollbar">
                    @include('layouts.sideBar')
                </div>
                <!--            navigation menu bar end-->

                <!--            navigation bar start-->
                <div class="col-12 col-sm-9 col-lg-10 vh-100 overflow-scroll scrollbar">
                    @include('layouts.navigationBar')
                    @yield('content')
                </div>
                <!--            navigation bar end-->
            </div>
        @endauth

        @guest
            @include('layouts.navigationBar')
            @yield('content')
        @endguest
    </main>

    @stack('script')

{{--    show status by sweetalert 2--}}
    <script type="module">
        @if( session('status') )
        showToast("{{ session('status') }}")
        @endif

        @if( session('warning') )
        showToast("{{ session('warning') }}",'warning')
        @endif
    </script>

</body>
</html>
