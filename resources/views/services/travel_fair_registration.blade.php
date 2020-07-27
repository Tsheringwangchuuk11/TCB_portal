@extends('layouts.manager')
@section('page-title','Event Registration for Travel Fairs')
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
            <div class="card-header">
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                @if(sizeof($eventFairDetails) > 0)
                    @foreach ($eventFairDetails as $eventFairDetail)
                    <li class="nav-item active">
                        <a href="#" class="nav-link showevent" data-value='["{{$eventFairDetail->event_name}}", "{{ $eventFairDetail->id}}", "{{ $eventFairDetail->country_name}}","{{ $eventFairDetail->event_location}}","{{ $eventFairDetail->last_date}}",
                            "{{ $eventFairDetail->start_date}}","{{ $eventFairDetail->end_date}}","{{ $eventFairDetail->event_dtls}}"]' >
                          <i class="fa fa-bullhorn"></i> {{ $eventFairDetail->event_name}}
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
                        </div><br>
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
                        <div class="row">
                            <div class="col-md-5">
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
                                    <input type="text" class="form-control" name="lastdate"  value="{{ old('to_date') }}" id="lastdate" autocomplete="off" >
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
                          Tour Operator Details
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">CID<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no') }}" onchange="getTourOperatorDetails(this.value)" >
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="">Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off" id="applicant_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Email<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" id="email">
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
                                    <label for="">Company Name<span class="text-danger"> *</span></label>
                                    <input type="text" name="company_title_name" id="company_title_name" class="form-control" value="{{ old('contact_no') }}" id="lastDate" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="">Date Of Registration<span class="text-danger"> *</span></label>
                                    <input type="date" name="date" class="form-control" value="{{ old('date') }}" id="date" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
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
      <!-- /.row -->
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.showevent').click(function () {
            var data = $(this).data('value');   // JQuery parses the JSON data
            var eventName = data[0];
            var eventId = data[1];
            var countryName = data[2];
            var location = data[3];
            var lastDate = data[4];
            var startDate = data[5];
            var endDate = data[6];
            var eventDtls = data[7];
            $("#eventId").val(eventId);
            $("#eventName").val(eventName);
            $("#countryId").val(countryName);
            $("#location").val(location);
            $("#lastDate").html(lastDate);
            $("#lastdate").val(lastDate);
            $("#endDate").val(endDate);
            $("#startDate").val(startDate);
            $("#eventDtls").val(eventDtls);
            $('#divshow').show();
            });
        })
        function getTourOperatorDetails(cid){
        $.ajax({
              url:'/application/get-tour_operator-info/'+cid,
               type: "GET",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
               dataType: "json",
               success:function(data) {
                $('#company_title_name').val(data.company_name);
                $('#cid_no').val(data.cid_no);
                $('#applicant_name').val(data.name);
                $('#email').val(data.email);
                $('#contact_no').val(data.contact_no);
               } 
            });
        }
    </script>
@endsection




