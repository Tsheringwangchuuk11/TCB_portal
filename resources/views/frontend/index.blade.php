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
                    <div class="row">
                        <div class="col-md-8 offset-md-2 d-flex justify-content-center"><h5>INBOUND TOURISM <span id="yearId"></span></h5>
                        </div>
                    <div class="col-md-2 d-inline-flex">
                        <label>Year</label> :<input type="text" name="year" class="form-control input-sm" id="year" data-toggle="datetimepicker" data-target="#year" onchange="getKeyHighLightData(this.value)"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="mapcontainer"></div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3 pt-4">
                            <div class="col-md-4">
                                <div class="info-box border border-info">
                                    <span class="info-box-icon"><i class="fas fa-users text-danger"></i></span>
                                    <div class="info-box-content">
                                         <span class="info-box-number"> Visitor Arrivals</span>
                                         <span class="info-box-text" id="visitor_arrival_id"><br></span>
                                         <i style="font-size:25px" id="percent_classId"></i> 
                                         <span id="percentId"></span>%
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box border border-info mb-3">
                                    <span class="info-box-icon"><i class="fas fa-dollar-sign text-success"></i></span>
                                    <div class="info-box-content">
                                        <span class=" info-box-number">Foreign Exchange Earnings</span>
                                            <span class="info-box-text">
                                                USD $<span id="f_exchange_earning"> </span> million <br>
                                                <i style="font-size:25px" id="f_earning_classId"></i> 
                                                <span id="f_earning_percent"></span> %
                                            </span>
                                        <span class=" info-box-number">Direct Revenue(SDF)</span>
                                            <span class="info-box-text">
                                                USD $<span id="direct_revenue"> </span> million <br>
                                                <i style="font-size:25px" id="direct_revenue_classId"></i> 
                                                <span id="direct_revenue_percent"> </span> %
                                            </span>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-box border border-info mb-3">
                                    <span class="info-box-icon"><i class="fas fa-sitemap text-info"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-number">Tourism Enterprises</span>
                                            <span class="info-box-text"> 
                                                Tour Operators - <span id="t_operator"></span><br>
                                                Hotels - <span id="hotels"> </span><br>
                                                Village Homestays - <span id="home_stay"></span><br>
                                                Guides - <span id="guide"></span>
                                            </span>
                                        </div>
                                  </div>
                            </div>
                        <div class="col-md-4">
                            <div class="info-box border border-info mb-3">
                                <span class="info-box-icon"><i class="fas fa-coins text-danger"></i></span>
                                <div class="info-box-content">
                                    <span class=" info-box-number">Average Expenditure</span>
                                        <span class="info-box-text">
                                            Trip Exp.$<span id="trip_expenditure"></span><br>
                                            Daily Exp.$<span id="daily_expenditure"></span>
                                        </span>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box border border-info mb-3">
                                <span class="info-box-icon"><i class="fas fa-hand-holding-usd text-success"></i></span>
                                 <div class="info-box-content">
                                    <span class="info-box-number">Gross Tourism Receipts</span>
                                        <span class="info-box-text" id="gross_tourism_receipts">
                                    </span>
                                </div>
                              </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box border border-info mb-3">
                                <span class="info-box-icon"><i class="fas fa-bed text-info"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-number">Average Length of stay</span>
                                         <span class="info-box-text" id="average_length"> 
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
                    <div class="row d-flex pt-2 ml-5 mr-5">
                        @foreach ($reporttypes as $reporttype)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-4">
                                <span class="info-box-icon bg-info elevation-1"><i class="{{ $reporttype->icon }}"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text text-bold ">{{ $reporttype->report_type }}</span>
                                        {{-- <span class="info-box-number">Total: 315,599</span> --}}
                                        <a href="{{ url('report/public-report/'.$reporttype->report_type_id) }}" class="small-box-footer text-reset">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                        <p class="text-white-50 text-lg">You can avail above services using <a href="{{ url('sso/redirect') }}" class="text-white text-uppercase font-weight-bold"><u> Single Sign-On</u></a> (SSO)- One pass for citizens to avail online government services. Register in  <a href="https://sso.dit.gov.bt"  target="_blank" class="text-white font-weight-bold"><u>DIGITAL IDENTITY SERVICE </u></a> for new. </p>
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
@endsection
@section('scripts')
<!-- high maps -->
<script src="{{ asset('plugins/highcharts/highmaps.js') }}"></script> 
<script src="{{ asset('plugins/highcharts/world.js') }}"></script> 
<script>
    $(document).ready(function () {
        var previous_year = new Date().getFullYear();
        $('#year').datetimepicker({
                viewMode: 'years',
                    format: 'YYYY',
                    useCurrent: true
                }); 
        $('#year').val(previous_year).trigger("change");
    });

    function getKeyHighLightData(year){
        $("#yearId").html(year);
        $.ajax({
                url: '/getmapdata',
                type: "GET",
                data: {
                    year: year,
                },
                success: function (data) {
                    data.visitors.forEach(function (p) {
                        p.value = (p.value < 1 ? 1 : p.value);
                        }); 
                        // Initiate the chart
                        Highcharts.mapChart('mapcontainer', {
                        title: {
                            useHTML: true,
                            text: ''
                        }, 
                        subtitle: {
                                    text: data.msg
                                    },
                        legend: {
                            title: {
                            text: 'Total Visitors :' + data.totalvisitors,
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
                                verticalAlign: 'top'
                            },
                        },
                        colorAxis: {
                            min: 1,
                            max: 1000,
                            type: 'logarithmic'
                        },
                        series: [{
                            data:data.visitors,
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
                        if(data.keyhighlights !=''){
                        data.keyhighlights.forEach(function (keyhighlight) {
                            if(keyhighlight.highlight_type_id==349){
                                $("#visitor_arrival_id").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==350){
                                $("#f_exchange_earning").html(keyhighlight.total_no);
                                $("#f_earning_percent").html(keyhighlight.percent);
                            }
                            else if(keyhighlight.highlight_type_id==351){
                                $("#direct_revenue").html(keyhighlight.total_no);
                                $("#direct_revenue_percent").html(keyhighlight.percent);
                            }
                            else if(keyhighlight.highlight_type_id==352){
                                $("#t_operator").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==353){
                                $("#hotels").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==354){
                                $("#home_stay").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==355){
                                $("#guide").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==358){
                                var gross_tourism_receipts = "USD $ "+ keyhighlight.total_no + " million ";
                                $("#gross_tourism_receipts").html(gross_tourism_receipts);
                            }
                            else if(keyhighlight.highlight_type_id==359){
                                var average_length = ""+ parseInt(keyhighlight.total_no) + " nights";
                                $("#average_length").html(average_length);
                            } 
                            else if(keyhighlight.highlight_type_id==356){
                                $("#trip_expenditure").html(parseInt(keyhighlight.total_no));
                            }
                            else if(keyhighlight.highlight_type_id==357){
                                $("#daily_expenditure").html(parseInt(keyhighlight.total_no));
                            }
                          }); 
                        } 
                        else{
                            $("#visitor_arrival_id").html('');
                            $("#f_exchange_earning").html('');
                            $("#f_earning_percent").html('');
                            $("#direct_revenue").html('');
                            $("#direct_revenue_percent").html('');
                            $("#t_operator").html('');
                            $("#hotels").html('');
                            $("#home_stay").html('');
                            $("#guide").html('');
                            $("#gross_tourism_receipts").html('');
                            $("#average_length").html('');
                            $("#trip_expenditure").html('');
                            $("#daily_expenditure").html('');
                        }
                        if(data.current_percentage!=null){
                        $("#percentId").html(data.current_percentage);
                        if(data.percentage_status=="increase"){
                            document.getElementById("percent_classId").className = "fas fa-caret-up text-success";
                            document.getElementById("f_earning_classId").className = "fas fa-caret-up text-success";
                            document.getElementById("direct_revenue_classId").className = "fas fa-caret-up text-success";
                        }else{
                            document.getElementById("percent_classId").className = "fas fa-caret-down text-danger";
                            document.getElementById("f_earning_classId").className = "fas fa-caret-down text-danger";
                            document.getElementById("direct_revenue_classId").className = "fas fa-caret-down text-danger";
                         }
                        }else{
                            $("#percentId").html('');
                            $("#percent_classId").removeClass("fas fa-caret-down text-danger fas fa-caret-up text-success");
                            $("#f_earning_classId").removeClass("fas fa-caret-down text-danger fas fa-caret-up text-success");
                            $("#direct_revenue_classId").removeClass("fas fa-caret-down text-danger fas fa-caret-up text-success");
                        }
                    }
            });
     }
</script>
@endsection
