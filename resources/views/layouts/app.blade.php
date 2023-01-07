<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="./assets/css/soft-ui-dashboard-tailwind.css?v=1.0.4" rel="stylesheet" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/dash.js') }}" defer></script>
{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('flatlogic/css/application.css')}}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    <div id="app">
            @yield('content')
    </div>
    <!-- common libraries. required for every page-->
    <script src="{{ asset('flatlogic/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/jquery-pjax/jquery.pjax.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/widgster/widgster.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/underscore/underscore.js') }}"></script>

    <!-- common application js -->
    <script src="{{ asset('flatlogic/js/settings.js') }}"></script>
</body>
</html>
