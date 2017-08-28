@extends('layouts.logged-out')


@section('page-title')
    Lecturer Dashboard
@endsection


@section('custom-styles')
<style>

    .rightside-area {
        background: #FFF;
    }

    .top-bar {
        text-align: right;
    }

    .top-bar a {
        display: inline-block;
        padding: 10px;
    }

    .title {
        font-size: 36px;
        text-align: center;
        margin-top: 150px;
        font-weight: 300;
    }

    .title-image {
        margin-bottom: 50px;
    }

    .links {
        text-align: center;
    }

    .links a {
        display: inline-block;
        padding: 10px;
    }

    .notice-container {
        padding-top: 50px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

</style>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="top-bar">
            @if (Route::has('login'))
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>

        <div class="title">
            <div class="title-image">
                <img width="200px" src="{{url('/img/unisa-logo.png')}}" alt="">
            </div>

            e-Content System
        </div>

        <div class="links">
            <a href="https://github.com/EonConsulting">Github</a>
            <a href="https://github.com/orgs/EonConsulting/people">Team</a>
        </div>

        <div class="notice-container">
            <div class="beta-notice">
                Please note that this site is currently in development and is not complete. Certain features in this website are currently under construction, and they do not represent the final intended functionality. This site is available to allow you to have a look at progress, and to get an idea of where this site is headed.
            </div>
        </div>

    </div>

@endsection
