<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
        <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <!-- jquery-validation -->
        <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- Moment Min Js -->
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- date-range-picker -->
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <!-- fileupload -->
        <script src="{{ asset('fileupload/jquery.fileupload.js') }}"></script>
        <!-- CommonUtil -->
        <script src="{{ asset('js/commonUtil.js') }}"></script>

            <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                            @yield('content')
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <footer class="main-footer">
                    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                    All rights reserved.
                    <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.2
                    </div>
                </footer>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <script type="text/javascript">
                var appUrl = "{{ url('/') }}/";
            </script>
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <!-- jQuery -->
            <script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
            <script>
            $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
            <!-- Sparkline -->
            <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
            <!-- JQVMap -->
            <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
            <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
            <!-- Select2 -->
            <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
            <!-- jquery-validation -->
            <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
            <!-- AdminLTE App -->
            <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
            <!-- Moment Min Js -->
            <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
            <!-- date-range-picker -->
            <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
            <!-- bs-custom-file-input -->
            <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
            <!-- ChartJS -->
            <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
            <!-- fileupload -->
            <script src="{{ asset('fileupload/jquery.fileupload.js') }}"></script>
            <!-- CommonUtil -->
            <script src="{{ asset('js/commonUtil.js') }}"></script>
            <script src="{{ asset('js/common.js') }}"></script>
            <script src="{{ asset('js/validation.js') }}"></script>
            @yield('scripts')
        </div>
    </body>
</html>
