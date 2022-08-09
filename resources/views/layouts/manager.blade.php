<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <link rel="shortcut icon" href="{{ URL::to('img/favicon.png') }}">

		<!-- Styles -->
            <!-- Font Awesome Icons -->
        <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
        <!-- Theme style -->
        <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet" type="text/css">
         <!-- summernote -->
         <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
        <!-- IonIcons -->
        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">
       
        <!-- Google Font: Source Sans Pro -->
        {{--     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
      
        <!-- Select2 -->

        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
         <!-- daterange picker -->
         <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
         
        <!-- Jquery fileupload -->
        <link href="{{ asset('fileupload/jquery.fileupload.css') }}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
       
         <!-- high chart -->
         <link rel="stylesheet" href="{{ asset('css/highchart.css')}}">
        <style>
            .hide{
                display: none;
            }

            .form-group .help-block{
                font-size: 11px;
                color: #dd4b39;
                position: absolute;
                top: 5px;
                width: 100%;
                right: 0;
                text-align: right;
                z-index: 9;
             }
             .dataTables_wrapper {
                font-size: 15px;
            }
        </style> 
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
                                    <h4 class="m-0 text-dark">@yield('page-title')</h4>
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
    <script>
        $(function () {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
</html>

