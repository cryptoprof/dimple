<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('flatlogic/css/application.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
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
