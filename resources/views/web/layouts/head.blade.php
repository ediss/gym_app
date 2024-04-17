<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GYM APP</title>

    <!--plugins-->
    <link href="{{  asset('frontend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{  asset('frontend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{  asset('frontend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{  asset('frontend/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{  asset('frontend/js/pace.min.js') }}"></script>
    <!--Styles-->
    <link href="{{  asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('frontend/css/icons.css')}}" >

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{  asset('frontend/css/main.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/dark-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/semi-dark-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/minimal-theme.css' )}}" rel="stylesheet">
    <link href="{{  asset('frontend/css/shadow-theme.css' )}}" rel="stylesheet">

    <link href="{{  asset('frontend/css/extra-icons.css' )}}" rel="stylesheet">

    {{-- <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('frontend/images/logo-icon.png') }}"> --}}
    <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('frontend/images/logo.svg') }}">
    

    {{-- <link rel="shortcut icon" href="{{ asset('frontend/images/logo2.ico') }}" sizes="any"> --}}

    
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo.png') }}" sizes="144x144"> <!-- Desktop browser icon -->
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">


    @yield('custom-css')
</head>
