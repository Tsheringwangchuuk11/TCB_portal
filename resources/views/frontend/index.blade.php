@extends('frontend/layouts/template')
@section('content')
<style>
    #mapcontainer {
    height: 500px; 
    width: 980px; 
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center pt-2">
                        <div id="mapcontainer"></div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3 pt-4">
                            <div class="col-md-4">
                                <div class="info-box border border-info text-center">
                                    <div class="info-box-content">
                                        <span class="info-box-number">Visitor Arrivals</span>
                                            <span class="info-box-text">
                                                315,599<br>
                                            </span>
                                            <i class="fa fa-arrow-up text-success" style="font-size:25px"></i> 15 %
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box mb-3 border border-info text-center">
                                    <div class="info-box-content">
                                        <span class=" info-box-number">Foreign Exchange Earnings</span>
                                            <span class="info-box-text">USD $ 88.65 million<br>
                                                <i class="fa fa-arrow-up text-success" style="font-size:25px"></i>  3.79 %
                                            </span>
                                        <span class=" info-box-number">Direct Revenue(SDF)</span>
                                            <span class="info-box-text">USD $ 23.42 million<br>
                                                <i class="fa fa-arrow-up text-success" style="font-size:25px"></i>  3.49 %
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box mb-3 border border-info text-center">
                                    <div class="info-box-content">
                                    <span class="info-box-number">Tourism Enterprises</span>
                                        <span class="info-box-text"> Tour Operators - 3020<br>
                                            Hotels - 160<br>
                                            Village Homestays - 149<br>
                                            Guides - 4600
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="info-box border border-info text-center">
                                <div class="info-box-content">
                                    <span class=" info-box-number">Average Expenditure</span>
                                        <span class="info-box-text">
                                            Trip Exp.$1,354<br>
                                            Daily Exp.$235
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box mb-3 border border-info text-center">
                                <div class="info-box-content">
                                    <span class="info-box-number">Gross Tourism Receipts</span>
                                       <span class="info-box-text">USD $ 345.88 million
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3 border border-info text-center">
                                <div class="info-box-content">
                                    <span class="info-box-number">Average Length of stay</span>
                                         <span class="info-box-text"> 7 nights
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center pt-2 ml-5 mr-5">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plane-arrival"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-bold ">INBOUND TOURISM</span>
                                    {{-- <span class="info-box-number">Total: 315,599</span> --}}
                                    <a href="{{ url('report/public-report/'.'1') }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plane-departure"></i></span>
                                <div class="info-box-content">
                                     <span class="info-box-text text-bold ">OUTBOUND TOURISM</span>
                                    {{-- <span class="info-box-number">Total: 760</span> --}}
                                    <a href="{{ url('report/public-report/'.'2') }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-suitcase"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-bold">DOMESTIC TOURISM</span>
                                     {{-- <span class="info-box-number">Total: 2,000</span> --}}
                                     <a href="{{ url('report/public-report/'.'3') }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-left pt-2 pt-2 ml-5 mr-5">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-sitemap"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-bold">TOURISM ENTERPRISE</span>
                                    {{-- <span class="info-box-number">Total: 7929</span> --}}
                                    <a href="{{ url('report/public-report/'.'4') }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-bold">EMPLOYMENT</span>
                                    {{-- <span class="info-box-number">Total: 2,000</span> --}}
                                    <a href="{{ url('report/public-report/'.'5') }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center text-olive h3 font-weight-bold pb-2">ONLINE SERVICES
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
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-calendar-check text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tented Accommodation</a></span>
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
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fa-balance-scale-right text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Grievance Redressal</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fas fa-book-open text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('training-registration') }}" class="text-reset">Training Registration</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fas fa-business-time text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tourism Product</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="info-box elevation-0">
                                    <div class="info-box-content">
                                        <span class="bg-white elevation-0"><i class="fas fa-2x fas fa-globe text-olive"></i></span>
                                        <span class="info-box-text"><a href="{{ url('application/new-application') }}" class="text-reset">Tourism Event</a></span>
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
var visitors={!! json_encode($visitors) !!};
/* data=[
	{
		"name": "United States of America",
		"value": 1023,
	},
    {
		"name": "Argentina",
		"value": 24,
	},
	{
		"name": "Australia",
		"value": 241,
	},
	
	{
		"name": "Austria",
		"value": 39,
	},
	{
		"name": "Bahrain",
		"value": 1,
	},
	{
		"name": "Bangladesh",
		"value": 125,
	},
	{
		"name": "Belarus",
		"value": 1,
	},
	{
		"name": "Belgium",
		"value": 93,
	},

	{
		"name": "Bolivia",
		"value": 1,
	},
	
	{
		"name": "Brazil",
		"value": 95,
	},
	{
		"name": "United Kingdom",
		"value": 477,
	},
	{
		"name": "Brunei",
		"value": 3,
	},
	
	{
		"name": "Bulgaria",
		"value": 6,
	},
	{
		"name": "Myanmar",
		"value": 19,
	},

	{
		"name": "Cambodia",
		"value": 10,
	},
	{
		"name": "Canada",
		"value": 128,
	},
	{
		"name": "Chile",
		"value": 9,
	},
	{
		"name": "Japan",
		"value": 348,
	},
	{
		"name": "China",
		"value": 713,
	},
	{
		"name": "Colombia",
		"value": 5,
	},
	{
		"name": "Cyprus",
		"value": 3,
	},
	{
		"name": "Cambodia",
		"value": 89,
	},
	{
		"name": "Czech Republic",
		"value": 4,
	},
	{
		"name": "Denmark",
		"value": 53,
	},
	{
		"name": "Dominica",
		"value": 1,
	},

	{
		"name": "Netherlands",
		"value": 69,
	},
	{
		"name": "Estonia",
		"value": 4,
	},
	{
		"name": "Philippines",
		"value": 48,
	},
	
	{
		"name": "Finland",
		"value": 3,
	},
	{
		"name": "France",
		"value": 141,
	},
	{
		"name": "Germany",
		"value": 374,
	},
	{
		"name": "Greece",
		"value": 4,
	},
	{
		"name": "Grenada",
		"value": 1,
	},
	{
		"name": "Guatemala ",
		"value": 4,
	},
	{
		"name": "Hungary",
		"value": 9,
	},
	{
		"name": "India",
		"value": 3271,
	},
	{
		"name": "Indonesia",
		"value": 49,
	},
	{
		"name": "Ireland",
		"value": 16,
	},
	{
		"name": "Israel",
		"value": 31,
	},
	{
		"name": "Italy",
		"value": 126,
	},
	{
		"name": "Japan",
		"value": 216,
	},

	{
		"name": "Jordan",
		"value": 3,
	}, 
    {
		"name": "Kuwait",
		"value": 2,
	}, 
      {
		"name": "Laos",
		"value": 2,
	}, 
    {
		"name": "Latvia",
		"value": 2,
	}, 
    {
		"name": "Luxembourg",
		"value": 6,
	}, 
    {
		"name": "Malaysia",
		"value": 233,
	}, 
    {
		"name": "Malta",
		"value": 18,
	}, 
    {
		"name": "Mexico",
		"value": 69,
	}, 
    {
		"name": "Monaco",
		"value": 2,
	}, 
    {
		"name": "Nepal",
		"value": 54,
	},
    {
		"name": "New Zealand ",
		"value": 29,
	},
    {
		"name": "Norway",
		"value": 16,
	},
    {
		"name": "Pakistan",
		"value": 1,
	},
    {
		"name": "Poland",
		"value": 25,
	},
    {
		"name": "Portugal",
		"value": 22,
	},
    {
		"name": "Qatar",
		"value": 1,
	},
    {
		"name": "Romania",
		"value": 2,
	},
    {
		"name": "Russia",
		"value": 46,
	},
    {
		"name": "Saudi Arabia",
		"value": 1,
	},
    {
		"name": "Seychelles",
		"value": 1,
	},
    {
		"name": "Singapore",
		"value": 235,
	},
    {
		"name": "Slovakia",
		"value": 1,
	},
    {
		"name": "Slovenia",
		"value": 2,
	},
    {
		"name": "South Africa",
		"value": 12,
	},
    {
		"name": "South Korea",
		"value": 133,
	},
    {
		"name": "Spain",
		"value": 74,
	},
    {
		"name": "Sri Lanka",
		"value": 13,
	},
    {
		"name": "Sweden",
		"value": 34,
	},
    {
		"name": "Switzerland",
		"value": 55,
	},
    {
		"name": "Taiwan",
		"value":188,
	},
    {
		"name": "Thailand",
		"value":215,
	},
    {
		"name": "Turkey",
		"value": 3,
	},
    {
		"name": "Ukraine",
		"value": 21,
	},
    {
		"name": "Uruguay",
		"value": 1,
	},
    {
		"name": "Venezuela",
		"value": 1,
	},
    {
		"name": "Vietnam",
		"value": 282,
	},
    {
		"name": "Yemen",
		"value": 1,
	}
] */

// Prevent logarithmic errors in color calulcation
       
total= 315599;
visitors.forEach(function (p) {
  p.value = (p.value < 1 ? 1 : p.value);
}); 
// Initiate the chart
Highcharts.mapChart('mapcontainer', {
title: {
    text: 'INBOUND TOURISM' 
  },
  subtitle: {
            text: 'Provisional data'
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
    data: visitors,
    mapData: Highcharts.maps['custom/world'],
    joinBy: ['name', 'name'],
    name: 'Total Tourist',
    borderColor: 'black',
    borderWidth: 0.2,
    states: {
        hover: {
            color: '#a4edba',
            borderWidth: 1
        }
        },
    }]
});
</script>
@endsection
