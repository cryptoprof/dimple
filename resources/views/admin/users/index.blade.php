@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Пользователи</h2>
                <router-view name="usersIndex"></router-view>
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
