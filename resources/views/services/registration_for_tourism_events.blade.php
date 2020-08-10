@extends('layouts.manager')
@section('page-title','Registration for Tourism Events')
@section('content')
<section class="content">
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
            <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
            <a href="#" class="btn btn-primary btn-block mb-3">Events</a>
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @if(sizeof($eventFairDetails) > 0)
                        @foreach ($eventFairDetails as $eventFairDetail)
                        <li class="nav-item active">
                            <a href="#" class="nav-link showevent" data-id="{{ $eventFairDetail->id}}"><i class="fa fa-bullhorn"></i> {{ $eventFairDetail->event_name}}
                            </a>
                        </li>
                        @endforeach
                        @else
                        <p class="text-danger"> No event for this month</p>
                        @endif
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9" style="display:none" id="divshow">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Event Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 bg-info">
                                    Last Date of Registration :<span class="" id="lastDate"> </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="" >Event Name<span class="text-danger"> *</span></label>
                                        <input type="hidden" class="form-control" name="event_id" id="eventId">
                                        <input type="text" class="form-control" name="event_name" value="{{ old('event_id') }}" id="eventName">
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">To country.<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="countryId" id="countryId" value="{{ old('country_id') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="showdzongkhag">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="dzongkhag"  value="{{ old('dzongkhag') }}" autocomplete="off" id="dzongkhag" >
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Gewog<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="gewog"  value="{{ old('gewog') }}" id="gewog" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5" style="display:none" id="showvillage">
                                    <div class="form-group">
                                        <label for="">Village<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="village"  value="{{ old('village') }}" autocomplete="off" id="village" >
                                    </div>
                                </div>
                                <div class="col-md-5" style="display:one" id="showeventlocation">
                                    <div class="form-group">
                                        <label for="">location<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="locationName"  value="{{ old('location') }}" autocomplete="off" id="location" >
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Event Start Date<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="fromdate"  value="{{ old('start_date') }}" id="startDate" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Event End Date<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="todate"  value="{{ old('to_date') }}" id="endDate" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Last Date Of Registration<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="lastdate"  value="{{ old('to_date') }}" id="last_date_registration" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Website<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="webpage_url"  value="{{ old('webpage_url') }}" id="web_site" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Contact Person<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="contact_person"  value="{{ old('contact_person') }}" id="contact_person" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Email<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="email"  value="{{ old('email') }}" id="email" autocomplete="off" >
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Contact No<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="mobile_no"  value="{{ old('mobile_no') }}" id="mobile_no" autocomplete="off" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Event Details<span class="text-danger"> *</span></label>
                                        <textarea class="form-control" name="event_dtls" value="{{ old('event_dtls') }}" autocomplete="off" id="eventDtls" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-info">
                                <div class="col-md-12">
                                    Company Details                                    
                                </div>
                            </div>
                            <br>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label>Company Type<span class="text-danger">*</span></label>
                                        <select class="form-control select2bs4" name="company_type" id="company_type" style="width: 100%;">
                                            <option value="">- Select -</option>
                                            <option value=""> Tourist standard hotel </option>
                                            <option value=""> Tour operator</option>
                                            <option value=""> Air lines </option>
                                            <option value=""> Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="form-group">
                                            <label for="">CID<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no') }}" onchange="api_webservices(this.value)" >
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="applicant_name" id="app_name" value="{{ old('applicant_name') }}" autocomplete="off" id="applicant_name">
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}" autocomplete="off" id="contact_no" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Passport No<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="passport_no" value="{{ old('passport_no') }}" autocomplete="off" id="passport_no">
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Email<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Company Name<span class="text-danger"> *</span></label>
                                        <input type="text" name="company_title_name" id="company_title_name" class="form-control" value="{{ old('contact_no') }}" id="lastDate" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="">Company Website<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="webpage_url" value="{{ old('email') }}" autocomplete="off" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Remarks<span class="text-danger"> *</span></label>
                                        <textarea type="text" class="form-control" name="remarks" value="{{ old('number') }}" autocomplete="off" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer text-center">
                    <button type="submit"class="btn btn-success btn-sm"><i class="fa fa-check fa-sm"></i> APPLY</button>
                    <button type="reset"class="btn btn-danger btn-sm"><i class="fa fa-times fa-sm"></i> RESET</button>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</form>
</section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.showevent').click(function () {
                var event_id = $(this).data('id');
                $.get('/events/geteventdetails/'+event_id, function (data) {
                if(data.country_id==1){
                    $("#showdzongkhag").show();
                    $("#showvillage").show();
                    $("#showeventlocation").hide();
                }else{
                    $("#showdzongkhag").hide();
                    $("#showvillage").hide();
                    $("#showeventlocation").show();
                }
                $("#eventId").val(data.id);
                $("#eventName").val(data.event_name);
                $("#countryId").val(data.country_name);
                $("#location").val(data.event_location);
                $("#lastDate").html(data.last_date);
                $("#last_date_registration").val(data.last_date);
                $("#endDate").val(data.end_date);
                $("#startDate").val(data.start_date);
                $("#eventDtls").val(data.event_dtls);
                $("#dzongkhag").val(data.dzongkhag_name);
                $("#gewog").val(data.gewog_name);
                $("#village").val(data.village_name);
                $("#web_site").val(data.web_site);
                $("#email").val(data.email);
                $("#contact_person").val(data.contact_person);
                $("#mobile_no").val(data.mobile_no);
                $('#divshow').show();
                })
            });
        })
    </script>
@endsection




