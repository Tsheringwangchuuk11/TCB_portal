<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>

    <style>
        nav {
            height: 40px;
            background-color: #312e70;
        }

        nav ul {
            float: right;
            margin-right: 25px;
            list-style: none;
        }

        nav ul li {
            display: inline-block;
            line-height: 40px;
            margin: 0 15px;
        }

        nav ul li a {
            position: relative;
            padding: 5px 0;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: #828c39;
            text-decoration: none;
        }

        label #sign-one,
        label #sign-two {
            font-size: 20px;
            color: #fff;
            float: right;
            line-height: 40px;
            margin-right: 30px;
            cursor: pointer;
            display: none;
        }

        #res-menu {
            display: none;
        }

        @media (max-width: 870px) {
            label #sign-one {
                display: block;
                padding-left: 5px;
            }

            nav ul {
                position: fixed;
                width: 100%;
                height: 100vh;
                background: #828c39;
                top: 90px;
                left: -100%;
                text-align: center;
                transition: .5s;
                z-index: 10;
            }

            nav ul li {
                display: block;
                margin: 10px 0;
                line-height: 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                text-align: left;
                padding-left: 10px;
                padding-right: 10px;

            }

            nav ul li a {
                font-size: 18px;
                color: #fff;
            }

            nav ul li a:hover {
                font-size: 18px;
                color: #312e70;
                cursor: pointer;
            }

            #res-menu:checked ~ ul {
                left: 0;
            }

            #res-menu:checked ~ label #sign-one {
                display: none;
            }

            #res-menu:checked ~ label #sign-two {
                display: block;
                padding-left: 5px;

            }
        }
    </style>

    <style>
        p {
            color: #fff;
            line-height: 22px;
        }

        h2, h3 {
            color: #fff;
        }

        h3 {
            font-size: 30px;
        }

        .footer-top {
            background: #8a9345;
            padding: 30px 0;
        }

        .segment-one h5 {
            font-family: sans-serif;
            color: #fff;
            letter-spacing: 3px;
            margin: 10px 0;
        }

        .segment-one h5:before {
            content: '|';
            color: #312e70;
            padding-right: 10px;
        }

        .segment-one ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .segment-one ul li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            line-height: 30px;
        }

        .segment-one ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 12px;
        }

        .segment-two h5 {
            font-family: sans-serif;
            color: #fff;
            letter-spacing: 3px;
            margin: 10px 0;
        }

        .segment-two h5:before {
            content: '|';
            color: #312e70;
            padding-right: 10px;
        }

        .segment-two ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .segment-two ul li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            line-height: 30px;
        }

        .segment-two ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 12px;
        }

        .segment-three h5 {
            font-family: sans-serif;
            color: #fff;
            letter-spacing: 3px;
            margin: 10px 0;
        }

        .segment-three h5:before {
            content: '|';
            color: #312e70;
            padding-right: 10px;
        }

        .segment-three a {
            background: #494848;
            width: 40px;
            height: 40px;
            display: inline-block;
            border-radius: 50%;
        }

        .segment-three a i {
            font-size: 20px;
            color: #fff;
            padding: 10px 12px;
        }

        .segment-four h5 {
            color: #fff;
        }

        .segment-four p {
            color: #fff;
            font-size: 12px;
        }

        .segment-four h5:before {
            content: '|';
            color: #312e70;
            padding-right: 10px;
        }

        .footer-bottom-text {
            text-align: center;
            background: #798235;
            line-height: 55px;
            color: #fff;
        }

        @media only screen and (min-width: 768px) and (max-width: 991) {
            .md-mb-30 {
                margin-bottom: 30px;
            }

            .search {
                color: #fff;
                background: #8a9345;
            }

            .search:hover {
                color: #fff;
                background: #828c39;
            }
        }

        @media only screen and (max-width: 767px) {
            .sm-mb-30 {
                margin-bottom: 30px;
            }

            .search {
                color: #fff;
                background: #312e70;

            }

            .search:hover {
                color: #fff;
                background: #828c39;
            }

            .footer-top {
                padding: 50px 0;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
    <div align="center"><img src="{{ URL::to('img/tcblogo/tcb_header.jpg') }}" class="w-75" alt=""></div>
    <nav>
        <input type="checkbox" id="res-menu">
        <label for="res-menu">
            <i class="fa fa-bars" id="sign-one"></i>
            <i class="fa fa-times" id="sign-two"></i>
        </label>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li>
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm rounded-0" placeholder="Search here..."
                           aria-label="Search here..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-sm rounded-0 search" type="button">Search</button>
                        <style>
                            .search {
                                color: #fff;
                                background: #8a9345;
                            }

                            .search:hover {
                                color: #fff;
                                background: #828c39;
                            }
                        </style>
                    </div>
                </div>
            </li>
            <li>
                @if (Route::has('login'))
                <a href="{{ route('login') }}">
                    <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i>
                </a>
                @endif
            </li>
        </ul>
    </nav>
    <br/>
    @yield('content')
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12 segment-one md-mb-30 sm-mb-30">
                        <h5>Essential Links</h5>
                        <ul>
                            <li><a href="#">Bhutan Destination Website</a></li>
                            <li><a href="#">Association of Bhutanese Tour Operator</a></li>
                            <li><a href="#">Hotel & Restaurant Association of Bhutan</a></li>
                            <li><a href="#">Guides Association of Bhutan</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 segment-two md-mb-30 sm-mb-30">
                        <h5>Sonam</h5>
                        <ul>
                            <li><a href="#">Tobgay</a></li>
                            <li><a href="#">Pema</a></li>
                            <li><a href="#">Sonam</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 segment-three sm-mb-30">
                        <h5>Follow us</h5>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 segment-four sm-mb-30">
                        <h5>Contact us</h5>
                        <p>
                            Tourism Council of Bhutan <br>
                            Post Box: 126 <br>
                            Thimphu, Bhutan <br>
                            Tel: +975 2 323251/323252 <br>
                            Fax: +975 2 323695 <br>
                            Email: info@tourism.gov.bt
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-text">
            All Right Reserved &copy; <?php echo date('Y');?>
        </div>
    </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>
