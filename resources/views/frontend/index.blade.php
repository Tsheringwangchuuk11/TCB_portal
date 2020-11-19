@extends('frontend/layouts/template')
@section('content')
<style>
    #mapcontainer {
    height: 500px; 
    width: 800px; 
    margin: 0 auto; 
    }
    .loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
    }
    .highcharts-credits {
    display: none !important;
    }
</style>
    <div class="col-8 offset-md-2 d-flex justify-content-center pt-3">
        <h2 class="text-warning">KEY HIGHLIGHTS</h2>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center pt-2">
            <div id="mapcontainer"></div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-bold">
                            INTERNATIONAL TOURISM 2020
                            <div class="h6">
                                International Tourist Arrivals
                            </div>
                        </div>
                        <img src="{{ URL::to ('img/tcblogo/world-map.png') }}" class="w-100">
                        <h5 class="text-center font-weight-bold pt-2">Total Visitors: <span class="badge bg-warning">123,900</span>
                        </h5>
                        <small style="font-size: 14px;">
                            <strong>Source: TCB </strong> <br/>
                            The total number show above is as of today's date.
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-bold">
                            REGIONAL TOURISM 2020
                            <div class="h6">
                                Regional Tourist Arrivals
                            </div>
                        </div>
                        <img src="{{ URL::to ('img/tcblogo/regional-map.png') }}" class="w-100">
                        <br>
                        <h5 class="text-center font-weight-bold pt-2">Total Visitors: <span class="badge bg-warning">240,100</span>
                        </h5>
                        <small style="font-size: 14px;">
                            <strong>Source: TCB </strong> <br/>
                            The total number show above is as of today's date.
                        </small>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row d-flex justify-content-center mb-3 pt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-bold">
                            TOURISM RECEIPT TRENDS
                            <div class="h6">
                                (in USD Million)
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>2017</th>
                                <th>2018</th>
                                <th>2019</th>
                                <th>%Change</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Gross Amount</td>
                                <td>79.81</td>
                                <td>85.41</td>
                                <td>88.63</td>
                                <td><i class="fas fa-caret-up fa-lg text-success"></i> 3.77</td>
                            </tr>
                            <tr>
                                <td>Sustainable Development</td>
                                <td>22.36</td>
                                <td>22.63</td>
                                <td>23.42</td>
                                <td><i class="fas fa-caret-up fa-lg text-success"></i> 3.47</td>
                            </tr>
                            <tr>
                                <td>Visa Fee</td>
                                <td>2.43</td>
                                <td>2.46</td>
                                <td>2.57</td>
                                <td><i class="fas fa-caret-up fa-lg text-success"></i> 4.49</td>
                            </tr>
                            <tr>
                                <td>TDS</td>
                                <td>1.09</td>
                                <td>1.20</td>
                                <td>1.24</td>
                                <td><i class="fas fa-caret-up fa-lg text-success"></i> 3.67</td>
                            </tr>
                            </tbody>
                        </table>
                        <small style="font-size: 14px;">
                            <strong>Source: TCB </strong> <br/>
                            Tourism earnings as show in the table above convertible currency earnings from MDPR.
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-bold">
                            ARRIVAL BY TOP FIVE COUNTRIES
                            <div class="h6">
                                International Tourist
                            </div>
                        </div>
                        <table class="table table-bordered table table-sm">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Country</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1.</td>
                                <td>USA</td>
                                <td><span class="badge bg-info">10,602</span></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>China</td>
                                <td><span class="badge bg-warning">7,353</span></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Singapore</td>
                                <td><span class="badge bg-success">4,391</span></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>United Kingdom</td>
                                <td><span class="badge bg-danger">3,890</span></td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Thailand</td>
                                <td><a href="/tvet/report_courses_accredited"><span
                                            class="badge bg-primary">3,037</span></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <small style="font-size: 14px;">
                            <strong>Source: TCB </strong> <br/>
                            Top 5 Source markets (Includes MDPR paying tourist only) in the year 2019.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center pt-2">
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-4">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-bold ">OUTBOUND TOURISM 2020</span>
                  <span class="info-box-number">Total: 760</span>
                  <a href="{{ url('report/public-report') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-4">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-bold">DOMESTIC TOURISM 2020</span>
                  <span class="info-box-number">Total: 2,000</span>
                  <a href="{{ url('report/public-report') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-olive h3 font-weight-bold pb-2">SERVICES
                        </div>
                        <div class="row text-center">
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-bed text-olive"></i></span>
                                    <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tourist Standard Hotel</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-home text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Village Home Stay </a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-utensils text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Restaurant</a></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-address-card text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tour Operator</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-calendar-check text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tourism Product</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-balance-scale-right text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Grievance Redressal</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-olive pb-1">
                        <p class="text-white-50 text-lg">You can avail above services using <a href="{{ url('login') }}" class="text-white text-uppercase font-weight-bold"><u> Single Sign-On</u></a> (SSO)- One pass for citizens to avail online government services. Register in  <a href="https://sso.dit.gov.bt"  target="_blank" class="text-white font-weight-bold"><u>DIGITAL IDENTITY SERVICE </u></a> for new. </p>
                    </div>
                </div>
            </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="text-center h2 p-3 font-weight-bold"> OTHER SERVICES
        </div>
        <div class="row p-2">
            <div class="col text-center">
                <a href="https://www.tourism.gov.bt/" target="_blank" class="text-reset">
                    <i class="fas fa-bullhorn fa-3x text-teal"></i>
                    <br>
                    <h5>Tourism Council Website</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="https://www.bhutan.travel/" target="_blank" class="text-reset">
                    <i class="fas fa-map-marker-alt fa-3x text-danger"></i>
                    <br>
                    <h5>Bhutan Destination Website</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="https://gms.tourism.gov.bt/" target="_blank" class="text-reset">
                    <i class="fas fa-certificate fa-3x text-maroon"></i>
                    <br>
                    <h5>Guide Management System</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="http://tashel.gov.bt/" target="_blank" class="text-reset">
                    <i class="fab fa-cc-visa fa-3x text-success"></i>
                    <br>
                    <h5>Tashel Online Visa</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="http://tax.tashel.gov.bt" target="_blank" class="text-reset">
                    <i class="far fa-money-bill-alt fa-3x text-info"></i>
                    <br>
                    <h5>Tax Exemption System</h5>
                </a>
            </div>
            <div class="col text-center">
                <a href="ftp://drive.tourism.gov.bt/files" target="_blank" class="text-reset">
                    <i class="fas fa-folder-open fa-3x text-warning"></i>
                    <br>
                    <h5>Resource Directory</h5>
                </a>
            </div>
        </div>
    </div>
<!-- high maps -->
<script src="{{ asset('plugins/highcharts/highmaps.js') }}"></script> 
<script src="{{ asset('plugins/highcharts/world.js') }}"></script> 
<script>
    data=[
	{
		"name": "Afghanistan",
		"value": 53,
	},
    {
		"name": "Bhutan",
		"value": 53,
	},
    {
		"name": "Australia",
		"value": 6,
	},
	{
		"name": "Bangladesh",
		"value": 1251,
	},
	
	{
		"name": "Bhutan",
		"value": 20,
	},
	{
		"name": "Canada",
		"value": 3,
	},
	{
		"name": "Switzerland",
		"value": 211,
	},
	{
		"name": "China",
		"value": 146,
	},
	{
		"name": "Congo, Rep.",
		"value": 15,
	},

	{
		"name": "Germany",
		"value": 236,
	},
	
	{
		"name": "Denmark",
		"value": 135,
	},
	{
		"name": "United Kingdom",
		"value": 271,
	},
	{
		"name": "Hong Kong SAR, China",
		"value": 6987,
	},
	
	{
		"name": "Indonesia",
		"value": 144,
	},
	{
		"name": "India",
		"value": 445,
	},

	{
		"name": "Italy",
		"value": 206,
	},
	{
		"name": "Jamaica",
		"value": 266,
	},
	{
		"name": "Jordan",
		"value": 106,
	},
	{
		"name": "Japan",
		"value": 348,
	},
	{
		"name": "Kazakhstan",
		"value": 6,
	},
	{
		"name": "Kenya",
		"value": 85,
	},
	{
		"name": "Kyrgyz Republic",
		"value": 31,
	},
	{
		"name": "Cambodia",
		"value": 89,
	},
	{
		"name": "Korea, Rep.",
		"value": 525,
	},
	{
		"name": "Kuwait",
		"value": 227,
	},
	{
		"name": "Sri Lanka",
		"value": 338,
	},

	{
		"name": "Macao SAR, China",
		"value": 20405,
	},
	{
		"name": "Maldives",
		"value": 1425,
	},
	{
		"name": "Mexico",
		"value": 65,
	},
	
	{
		"name": "Malaysia",
		"value": 94,
	},
	{
		"name": "Netherlands",
		"value": 505,
	},
	{
		"name": "Norway",
		"value": 14,
	},
	{
		"name": "Nepal",
		"value": 202,
	},
	{
		"name": "New Zealand",
		"value": 17,
	},
	{
		"name": "Pakistan",
		"value": 250,
	},
	{
		"name": "Philippines",
		"value": 346,
	},
	{
		"name": "Korea, Dem. People’s Rep.",
		"value": 210,
	},
	{
		"name": "Qatar",
		"value": 221,
	},
	{
		"name": "Singapore",
		"value": 7908,
	},
	{
		"name": "Sweden",
		"value": 24,
	},
	{
		"name": "Swaziland",
		"value": 78,
	},
	{
		"name": "Thailand",
		"value": 134,
	},

	{
		"name": "United States",
		"value": 35,
	},
]
// Prevent logarithmic errors in color calulcation
total=2000;
 data.forEach(function (p) {
  p.value = (p.value < 1 ? 1 : p.value);
}); 
// Initiate the chart
Highcharts.mapChart('mapcontainer', {
title: {
    text: ' INBOUND TOURISM 2020'
  },
  legend: {
    title: {
      text: 'Total Visitors :' + total,
      style: {
        color: ( // theme
          Highcharts.defaultOptions &&
          Highcharts.defaultOptions.legend &&
          Highcharts.defaultOptions.legend.title &&
          Highcharts.defaultOptions.legend.title.style &&
          Highcharts.defaultOptions.legend.title.style.color
        ) || 'black'
      }
    }
  },
mapNavigation: {
    enabled: true,
    buttonOptions: {
        verticalAlign: 'bottom'
    }
},
colorAxis: {
    min: 1,
    max: 1000,
    type: 'logarithmic'
},
series: [{
    data: data,
    mapData: Highcharts.maps['custom/world'],
    joinBy: ['name', 'name'],
    name: 'Total Tourist',
    borderColor: 'black',
    borderWidth: 0.2,
    states: {
        hover: {
            borderWidth: 1
        }
    },
    }]
});
</script>
@endsection
