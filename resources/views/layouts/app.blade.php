<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <title>Student Dashboard</title> 
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> 
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}"> 
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick/slick-theme.css') }}"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    @yield("css")
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-glass page-header-inverse main-content-boxed">
        @include("includes.student") 
        <div class="p-50"></div>
        @yield('content') 
    </div>
    @yield('js')
    <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>
    <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script> 
    <script src="{{ asset('assets/js/plugins/slick/slick.min.js') }}"></script> 
    <script>jQuery(function(){ Codebase.helpers('slick'); });</script>
</body>
</html>
