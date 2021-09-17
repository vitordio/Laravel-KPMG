<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    {{-- Data tables --}}
    <link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }} " rel="stylesheet">

    <!-- SELECT2 -->
    <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet">

    <!-- Core css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="app">
        {{-- Loading screen --}}
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        @include('layouts.partials.header')

        <div class="page-container">
            <div class="main-content">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        <div class="d-flex align-items-center justify-content-start">
                            <span class="alert-icon">
                                <i class="anticon anticon-check-o"></i>
                            </span>
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    </div>
                @elseif (Session::get('error'))
                    <div class="alert alert-danger">
                        <div class="d-flex align-items-center justify-content-start">
                            <span class="alert-icon">
                                <i class="anticon anticon-close-o"></i>
                            </span>
                            <span>{{ Session::get('error') }}</span>
                        </div>
                    </div>
                @endif
                @yield('content')
            @include('layouts.partials.footer')
        </div>
    </div>
</body>
</html>
