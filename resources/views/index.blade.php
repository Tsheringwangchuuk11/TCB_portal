<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>TCB </title>
  <!-- Font Awesome Icons -->
  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Theme style -->
  <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet" type="text/css"> 
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css"> 
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">
    <!-- Top Bar -->
    <div class="row fixed-top top_bar">
      <div class="col-md-4 ml-3">
        <strong> <span>icttcb@gmail.com |</span></strong>
        <strong> <span> +975-02-359774</span></strong>
      </div>
      <div class="col-md-4">
        <form class="ml-3">
          <div class="input-group input-group-sm">
           <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
           <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    @if (Route::has('login'))
    <div class="col-md-3 inline-block login_btn">
     <a href="{{ route('login') }}"><button  class="btn btn-sm">Login</button></a>
   </div>
   @endif
 </div>
 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light custom_navbar">
  <div class="col-md-2">
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ URL::to ('img/tcblogo/logo.png') }}" width="150px;">
    </a>
  </div>
  <div class="col-md-3">
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ URL::to ('img/tcblogo/dzo_logo.png') }}" height="50px;"></a>
    <a class="navbar-brand" href="{{url('/')}}"><span><strong>TOURISM COUNCIL OF BHUTAN</strong></span></a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse topnav" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}"><i class="fas fa-home fa-lg"></i><span>Home</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fas fa-users fa-lg"></i><span>About Us</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fas fa-comment-dots fa-lg"></i><span>Feedback</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"><i class="fas fa-phone fa-lg"></i><span>Contact Us</span></a>
      </li>
    </ul>
  </div>
</nav>
<!-- /.navbar -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div id="bs4-slide-carousel" class="carousel" data-ride="carousel" >
      <ol class="carousel-indicators">
        <li data-target="#bs4-slide-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#bs4-slide-carousel" data-slide-to="1"></li>
        <li data-target="#bs4-slide-carousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-inline w-100" src="{{ URL::to('img/tcblogo/banner1.jpg')}}" alt="Slide One">
        </div>

        <div class="carousel-item">
          <img class="d-inline w-100" src="{{URL::to('img/tcblogo/banner2.jpg')}}" alt="Slide Two">

        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{URL::to('img/tcblogo/bannerads.jpg')}}" alt="Slide Three">
        </div>
      </div>

      <a class="carousel-control-prev" href="#bs4-slide-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#bs4-slide-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> 
    </div>
  </div>
</div> 

<!-- solid graph -->
<div class="card bg-gradient-info">
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-th mr-1"></i>Tourist Arrival by month (%)
    </h3>
  </div>
  <div class="card-body">
    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
    </canvas>
  </div>
  <div class="card-footer bg-transparent">
  </div>
</div>

<!-- Main content -->
<div class="row portal">
  <!-- portal -->
  <div class="col-md-10 offset-md-1 text-center">
    <h3 class="pt-5">What is TCB Portal?</h3>
    <hr class="my">
    <p>In pursuance to the RGOB initiative of improving public service delivery and TCB's mandate tp promote sustenable tourism growth and development through effective and efficient tourism service delivery and infornation sharing.</p>
  </div>

  <!-- portal works -->
  <div class="col-md-10 offset-md-1 text-center">
    <h3 class="pt-5">How TCB Portal Works?</h3>
    <hr class="my">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <i class="fa fa-4x fa-sign-in-alt fa-color"></i>
            <h3>Dashboard</h3>
            <p>Information related to Dashboard</p>
          </div>
          <div class="col-md-4">
            <i class="fas fa-utensils fa-4x fa-color"></i>
            <h3>Restuarant</h3>
            <p>Information related to Restuarant</p>
          </div>
          <div class="col-md-4">
            <i class="fas fa-4x fa-hotel fa-color"></i>
            <h3>Hotel</h3>
            <p>Information related to Hotel</p>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <i class="fab fa-4x fa-product-hunt fa-color"></i>
            <h3>Tourism Product</h3>
            <p>Information related to Tourism Product</p>
          </div>
          <div class="col-md-6">
            <i class="fas fa-4x fa-building fa-color"></i>
            <h3>Tour Operator</h3>
            <p>Information related to Tour Operator</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- contact -->
  <div class="col-md-10 offset-md-1 text-center">
    <h3 class="pt-5">Contact Us</h3>
    <hr class="my">
    <p>If you have anything to ask please let us know.</p>
    <div class="row">
      <div class="col-md-3">
        <i class="fa fa-phone-square fa-3x"></i>
        <p>Toll Free No. 2300</p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-mobile fa-3x"></i>
        <p>+975 2 323251/323252</p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-envelope fa-3x"></i>
        <p>info@tourism.gov.bt</p>
      </div>
      <div class="col-md-3">
        <i class="fa fa-globe fa-3x"></i>
        <p>www.tourism.gov.bt</p>
      </div>
    </div>
  </div>
</div> 
<!-- Main Footer -->
<footer class="main-footer text-center footer_color">
  <!-- To the right -->
  <strong> &copy; 2020 <a href="https://www.tourism.gov.bt">Tourism Council of Bhutan</a></strong>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
</body>
</html>


