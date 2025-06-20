<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.config.system.name') }}</title>
    <link href="{{ asset('assets/img/tc-logo.ico') }}" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/thunder.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="fixed-header">
    <div class="lock-container full-height">
        <div class="full-height align-items-center d-flex">
            @yield('content')
        </div>
    </div>
    <div class="pull-bottom sm-pull-bottom full-width">
        <div class="clearfix">
            <p class="text-center m-b-30">
                <a href="{{ config('app.config.system.website') }}" class="normal thunder-color m-r-5">{{ config('app.config.system.version') }}</a> &copy; {{ date('Y') }} All Rights Reserved
            </p>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
    @stack('scripts')
    @include('includes.notify')
</html>