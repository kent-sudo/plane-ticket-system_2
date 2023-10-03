<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('favicon.ico') }}' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    @vite(['resources/sass/app.scss', 'public/js/app.js'])

    @yield('page-styles')

</head>

<body>

    @auth('users')
        <div class="page-content">
            @yield('content')
            <div class="button-container fixed-bottom row4" >
                <a href="{{ route('ticketRequirement.index') }}" class="btn btn-primary">票務需求</a>
                <a href="{{ route('inventory.index') }}" class="btn btn-primary">我的票倉</a>
                <a href="{{ route('userDetails.index') }}" class="btn btn-primary">個人中心</a>
            </div>


        </div>
    @else
        @yield('guest-content')
    @endauth


    @yield('page-scripts')

</body>

</html>
