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
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ URL::to ('img/tcblogo/logo.png') }}" width="100px;">
    </a>
  </div>
  <div class="col-md-3">
      <a class="navbar-brand" href="{{url('/')}}"><span><h2>TOURISM PORTAL</h2></span></a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>

      <div class="container-fluid">
          <div class="row p-3">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Tourist Arrival over the years</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body d-flex justify-content-around">
                          <div class="col-md-10">
                              <div class="chart">
                                  <canvas id="barTotal"
                                          style="min-height: 316px; height: 356px; max-height: 356px; max-width: 1000px; display: block; width: 100%;"
                                          width="100%" height="356px" class="chartjs-render-monitor">
                                  </canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="container-fluid">
          <div class="row bg-light p-3">
              <div class="col-md-4">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="text-center">Total Visitors by Nationality 2018</h6>
                          <table class="table table-bordered">
                              <thead>
                              <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Country</th>
                                  <th style="width: 40px">Number</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>1.</td>
                                  <td>USA</td>
                                  <td><span class="badge bg-info">10,561</span></td>
                              </tr>
                              <tr>
                                  <td>2.</td>
                                  <td>China</td>
                                  <td><span class="badge bg-warning">6,878</span></td>
                              </tr>
                              <tr>
                                  <td>3.</td>
                                  <td>Singapore</td>
                                  <td><span class="badge bg-primary">3,886</span></td>
                              </tr>
                              <tr>
                                  <td>4.</td>
                                  <td>Thailand</td>
                                  <td><span class="badge bg-success">3,886</span></td>
                              </tr>
                              <tr>
                                  <td>5.</td>
                                  <td>United Kingdom</td>
                                  <td><a href="/tvet/report_institute"><span class="badge bg-info">3,586</span></a></td>
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="card card-success">
                      <div class="card-body">
                          <h6 class="text-center">Tourist by Activity in Percentage 2018</h6>
                          <table class="table table-bordered table">
                              <thead>
                              <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Category</th>
                                  <th style="width: 40px">%</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>1.</td>
                                  <td>Culture</td>
                                  <td><span class="badge bg-info">86.41%</span></td>
                              </tr>
                              <tr>
                                  <td>2.</td>
                                  <td>Trekking</td>
                                  <td><span class="badge bg-warning">5.97%</span></td>
                              </tr>
                              <tr>
                                  <td>3.</td>
                                  <td>Nature</td>
                                  <td><span class="badge bg-info">3.76%</span></td>
                              </tr>
                              <tr>
                                  <td>4.</td>
                                  <td>Adventure</td>
                                  <td><span class="badge bg-warning">3.13%</span></td>
                              </tr>
                              <tr>
                                  <td>5.</td>
                                  <td>Spiritual and Wellness</td>
                                  <td><span class="badge bg-info">0.72%</span></td>
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>


              <div class="col-md-4">
                  <div class="card card-success">
                      <div class="card-body">
                          <h6 class="text-center">Tourist Arrival by Season 2018</h6>
                          <table class="table table-bordered table">
                              <thead>
                              <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Season</th>
                                  <th style="width: 40px">Percentage</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>1.</td>
                                  <td>Spring</td>
                                  <td><span class="badge bg-info">30%</span></td>
                              </tr>
                              <tr>
                                  <td>2.</td>
                                  <td>Summer</td>
                                  <td><span class="badge bg-warning">10%</span></td>
                              </tr>
                              <tr>
                                  <td>3.</td>
                                  <td>Autumn </td>
                                  <td><span class="badge bg-info">50%</span></td>
                              </tr>
                              <tr>
                                  <td>4.</td>
                                  <td>Winter</td>
                                  <td><span class="badge bg-warning">10%</span></td>
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>

  <div class="container-fluid">
      <div class="row p-3">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5>OTHER SERVICES</h5>
                  </div>
                  <div class="card-body">
                      <div class="col-md-3">
                          <div class="card bg-light">
                              <div class="card-header text-muted border-bottom-0">
                                  Digital Strategist
                              </div>
                              <div class="card-body pt-0">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class="lead"><b>Nicole Pearson</b></h2>
                                          <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                          <ul class="ml-4 mb-0 fa-ul text-muted">
                                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                          </ul>
                                      </div>
                                      <div class="col-5 text-center">
                                          <img src="../../dist/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">
                                      </div>
                                  </div>
                              </div>
                              <div class="card-footer">
                                  <div class="text-right">
                                      <a href="#" class="btn btn-sm bg-teal">
                                          <i class="fas fa-comments"></i>
                                      </a>
                                      <a href="#" class="btn btn-sm btn-primary">
                                          <i class="fas fa-user"></i> View Profile
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
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

  <script>
      $(function () {
          /* ChartJS barTotal */
          var barTotal = {
              labels: ['2012', '2013', '2014', '2015', '2016', '2017','2018','2019'],
              datasets: [
                  {
                      label: 'Total',
                      backgroundColor: 'rgba(60,141,188,0.9)',
                      borderColor: 'rgba(60,141,188,0.8)',
                      pointRadius: false,
                      pointColor: '#3b8bba',
                      pointStrokeColor: 'rgba(60,141,188,1)',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data: [110000, 120000, 140000, 160000, 210000, 260000, 270000, 110000]
                  },
              ]
          }
          var barChartCanvas = $('#barTotal').get(0).getContext('2d')
          var barChartData = jQuery.extend(true, {}, barTotal)
          var temp0 = barTotal.datasets[0]
          barChartData.datasets[0] = temp0
          var barChartOptions = {
              responsive: true,
              maintainAspectRatio: false,
              datasetFill: false,
              legend: false
          }
          var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
          })

          /* ChartJS coursesTotal */
          var coursesTotal = {
              labels: ['Automobile', 'Trekking Guide', 'Computer Hardware Technician', 'Construction Carpentry',
                  'Computer Application Assistant', 'Electrical', 'Mechanical', 'Beautician', 'Plumbing', 'Patra', 'House Keeping'],
              datasets: [
                  {
                      label: 'Total Course Accredited',
                      backgroundColor: 'rgba(60,141,188,0.9)',
                      borderColor: 'rgba(60,141,188,0.8)',
                      pointRadius: false,
                      pointColor: '#3b8bba',
                      pointStrokeColor: 'rgba(60,141,188,1)',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data: [228, 248, 340, 119, 86, 127, 20, 29.100, 290, 13, 45]
                  },
              ]
          }
          var barChartCanvas = $('#coursesTotal').get(0).getContext('2d')
          var barChartData = jQuery.extend(true, {}, coursesTotal)
          var temp0 = coursesTotal.datasets[0]
          barChartData.datasets[0] = temp0
          var barChartOptions = {
              responsive: true,
              maintainAspectRatio: false,
              datasetFill: false,
              legend: false
          }
          var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
          })
      })
  </script>
</body>
</html>


