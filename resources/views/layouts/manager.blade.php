<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>


		<!-- Styles -->
            <!-- Font Awesome Icons -->
        <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet" type="text/css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
        <!-- IonIcons -->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
        <!-- Jquery fileupload -->
        <link href="{{ asset('fileupload/jquery.fileupload.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div id="app">
                @include('layouts.include.header')
                @include('layouts.include.sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1 class="m-0 text-dark">@yield('page-title')</h1>
                                </div>
                                <div class="col-md-4 text-right">
                                    @yield('buttons')
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            {{-- @include('layouts.includes.admin-message') --}}
							@include('layouts.include.message')
                            @yield('content')
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                @include('layouts.include.footer')
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @yield('scripts')
            @include('layouts.include.alert_message')
        </div>
    </body>
</html>
