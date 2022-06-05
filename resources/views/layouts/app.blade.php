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
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
        <div class="logo">
            <h4><a href="/home">Dimple <strong>Simple</strong></a></h4>
        </div>
        <nav id="sidebar" class="sidebar nav-collapse collapse">
            <ul id="side-nav" class="side-nav">
                <li class="@if(Route::is('home') ) active @endif">
                    <a href="{{route('home')}}"><i class="fa fa-home"></i> <span class="name">Дашборд</span></a>
                </li>
                <li class="@if(Route::is('users')) active @endif">
                    <a href="{{route('users')}}"><i class="fa fa-users"></i> Пользователи</a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-table"></i> Задачи</a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-cogs"></i> Проекты</a>
                </li>
            </ul>

            <h5 class="sidebar-nav-title">Метки <a class="action-link" href="#"><i class="glyphicon glyphicon-plus"></i></a></h5>
            <!-- some styled links in sidebar. ready to use as links to email folders, projects, groups, etc -->
            <ul class="sidebar-labels">
                <li>
                    <a href="#">
                        <!-- yep, .circle again -->
                        <i class="fa fa-circle text-success"></i>
                        <span class="label-name">Тикет #29 поправить верстку</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-circle text-primary"></i>
                        <span class="label-name">Разработать функционал поиска по ТЗ</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-circle text-danger"></i>
                        <span class="label-name">Проработать раздел SEO</span>
                    </a>
                </li>
            </ul>

            <h5 class="sidebar-nav-title">Прогресс избранных проектов</h5>
            <!-- A place for sidebar notifications & alerts -->
            <div class="sidebar-alerts">
                <div class="alert fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    <span class="text-white fw-semi-bold">Разработка e-zh.ru</span> <br>
                    <div class="progress progress-xs mt-xs mb-0">
                        <div class="progress-bar progress-bar-gray-light" style="width: 16%"></div>
                    </div>
                    <small>Calculating x-axis bias... 65%</small>
                </div>
                <div class="alert fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    <span class="text-white fw-semi-bold">Новый функционал simplytourit.com</span> <br>
                    <div class="progress progress-xs mt-xs mb-0">
                        <div class="progress-bar progress-bar-danger" style="width: 23%"></div>
                    </div>
                    <small>Provide required notes</small>
                </div>
            </div>
        </nav>
        <div class="wrap">
            <header class="page-header">
                <div class="navbar">
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="visible-phone-landscape">
                            <a href="#" id="search-toggle">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="divider"></li>
                        @if (Auth::check())
                        <li class="hidden-xs dropdown">
                            <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                            </a>
                            <ul id="account-menu" class="dropdown-menu account" role="menu">
                                <li role="presentation" class="account-picture">
                                    <img src="/flatlogic/img/avatars/5.png" alt="" class="img-circle">
                                    {{ Auth::user()->name }}
                                </li>
                                <li role="presentation">
                                    <a href="#" class="link">
                                        <i class="fa fa-user"></i>
                                        Профиль
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="visible-xs">
                            <a href="#" class="btn-navbar" data-toggle="collapse" data-target=".sidebar" title="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        <li class="hidden-xs">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="glyphicon glyphicon-off"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif
                        </li>
                    </ul>
                    <form id="search-form" class="navbar-form pull-right" role="search">
                        <input type="search" class="form-control search-query" placeholder="Поиск ...">
                    </form>
                </div>
            </header>
            <div class="content container">
            @yield('content')
            </div>
        </div>
    </div>
    <!-- common libraries. required for every page-->
    <script src="{{ asset('flatlogic/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/jquery-pjax/jquery.pjax.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/widgster/widgster.js') }}"></script>
    <script src="{{ asset('flatlogic/lib/underscore/underscore.js') }}"></script>

    <!-- common application js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('flatlogic/js/settings.js') }}"></script>
</body>
</html>
