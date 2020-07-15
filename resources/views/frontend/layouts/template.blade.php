<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal | Tourism Council of Bhutan</title>
    <link rel="shortcut icon" href="{{ URL::to('img/favicon.png') }}">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Jquery fileupload -->
    <link href="{{ asset('fileupload/jquery.fileupload.css') }}" rel="stylesheet" type="text/css">
    <style>
        .show > .dropdown-menu {
            /* left: 50%; */
            /* transform: translateX(15%); */
        }

        .bg-primary-2 {
            background-color: #312e70 /*#0099cc;*/
        }
    </style>

    <style>
        /*to make hover menu */
        .bs-example {
            margin: 20px;
        }

        @media screen and (min-width: 768px) {
            .dropdown:hover .dropdown-menu, .btn-group:hover .dropdown-menu {
                display: block;
            }

            .dropdown-menu {
                margin-top: 0;
            }

            .dropdown-toggle {
                margin-bottom: 2px;
            }

            .navbar .dropdown-toggle, .nav-tabs .dropdown-toggle {
                margin-bottom: 0;
            }
        }
    </style>
    <style>
        .navbar {
            padding: 0rem 0rem;
        }

        /* main menu height reduce*/
    </style>
    <style>
        .navbar {
            padding: 0rem 0rem;
        }

        /* main menu height reduce*/
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid bg-gray-light p-1">
        <div class="row w-100">
            <div class="col-4 pt-1 pl-5">
                <a href="https://www.facebook.com/destinationbhutan" target="_blank" class="fab fa-facebook text-reset pl-2"></a>
                <a href="https://twitter.com/tourismbhutan" target="_blank" class="fab fa-twitter text-reset pl-1"></a>
                <a href="https://www.instagram.com/tourismbhutan/" target="_blank" class="fab fa-instagram text-reset pl-1"></a>
                <a href="https://www.youtube.com/channel/UC0xvpQniEmwX9gZbdthEUQw" target="_blank" class="fab fa-youtube text-reset pl-1"></a>
                <a href="https://vimeo.com/tourismbhutan" target="_blank" class="fab fa-vimeo text-reset pl-1"></a>
            </div>
            <div class="col-4">
                <form>
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar bg-white alert-default-dark" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4 text-right">
                <div class="btn btn-sm btn-warning"><a href="{{ url('login') }}" class="text-white">
                        <i class="fas fa-sign-in-alt"></i>&nbsp;Login</a></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="text-center"><a href="/"><img src="{{ URL::to('img/tcblogo/tcb_header.jpg') }}" class="w-100"
                                                  alt="Tourism Portal"></a></div>
    </div>


    <nav class="navbar navbar-expand-sm navbar-light bg-primary-2" id="myNavbar">
        <div class="container"><a href="/" class="navbar-brand text-white">&nbsp;<i class="fas fa-home"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-2"><a href="#" class="nav-link  text-white">ABOUT US</a>
                    </li>
                    <li class="nav-item px-2"><a href="#" class="nav-link  text-white">REPORTS</a>
                    </li>
                    <li class="nav-item px-2"><a href="#" class="nav-link  text-white">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @include('layouts.include.message')
    @yield('content')
    <div class="container-fluid p-3 text-white bg-gradient-gray-dark">
        <div class="row">
            <div class="col-sm-3 pl-4">
                <h5 class="">Other Links</h5>
                <a href="https://www.citizenservices.gov.bt" target="_blank" class="text-white-50 text-sm">G2C Services</a> <br>
                <a href="http://www.mohca.gov.bt" target="_blank" class="text-white-50 text-sm">Ministry of Home and Cultural Affairs</a> <br>
                <a href="https://www.mfa.gov.bt" target="_blank" class="text-white-50 text-sm">Ministry of Foreign Affairs</a> <br>
                <a href="https://www.doi.gov.bt"target="_blank" class="text-white-50 text-sm">Department of Immigration</a>
            </div>
            <div class="col-sm-6 text-center">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.688868518874!2d89.63672361453321!3d27.47894404210028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e1943e00c9fcab%3A0x67a49e29e167d001!2sTourism%20Council%20of%20Bhutan!5e0!3m2!1sen!2sbt!4v1594613529846!5m2!1sen!2sbt"
                    width="600" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="col-sm-3 pr-4">
                <h5>Contact Information</h5>
                <a href="#" class="text-white-50 text-sm">Contact Us</a> <br>
                <a href="{{ route('feedback') }}" class="text-white-50 text-sm">Feedback</a> <br>
                <a href="#" class="text-white-50 text-sm">Sitemap</a> <br>
                <a href="#" class="text-white-50 text-sm">Policies & Disclaimer</a>
            </div>
        </div>
    </div>

    <!-- Start of Copyright Bar -->
    <div class="container-fluid p-2 bg-gray text-sm">
        <div class="text-center text-white-50"> Copyright &copy;<?php echo date('Y');?> All Rights Reserved. Tourism
            Council of Bhutan
        </div>
    </div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- fileupload -->
<script src="{{ asset('fileupload/jquery.fileupload.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
@yield('scripts')
</body>
</html>
