@extends('layouts.enduser')
@section('page-title','Registration for Tourism Events')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $serviceId }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $moduleId }}" id="module_id">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Event Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Event Name<span class="text-danger"> *</span></label>
                    <input type="hidden" class="form-control" name="tourism_event_id" value="{{$eventdtl->id}}" id="eventId">
                        <input type="text" class="form-control" name="event_name" value="{{$eventdtl->event_name}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">To country.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="countryId" value="{{$eventdtl->dropdown_name}}"  readonly="true">
                    </div>
                </div>
            </div>
            <div class="row" style="display:none" id="showdzongkhag">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="dzongkhag"  value="{{$eventdtl->dzongkhag_name}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Gewog<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="gewog"  value="{{$eventdtl->gewog_name}}" readonly="true" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5" style="display:none" id="showvillage">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="village" value="{{$eventdtl->village_name}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5" style="display:one" id="showeventlocation">
                    <div class="form-group">
                        <label for="">location<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="locationName" value="{{$eventdtl->event_location}}" >
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Event Start Date<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="fromdate" value="{{$eventdtl->start_date}}" readonly="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Event End Date<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="todate" value="{{$eventdtl->end_date}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Last Date Of Registration<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="lastdate" value="{{$eventdtl->last_date}}" readonly="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Website<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="web_site" value="{{$eventdtl->web_site}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Contact Person<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="contact_person" value="{{$eventdtl->contact_person}}" readonly="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="contact_person_email" value="{{$eventdtl->email}}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Contact No<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="mobile_no" value="{{$eventdtl->mobile_no}}" readonly="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Event Details<span class="text-danger"> *</span></label>
                    <textarea class="form-control" name="event_dtls" readonly="true">{{$eventdtl->event_dtls}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Company Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Company Type<span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($companyTypes as $companyType)
                        <option value="{{$companyType->id}}">{{$companyType->dropdown_name}}</option>
                        @endforeach
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
                    <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off" id="applicant_name">
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
                    <input type="text" class="form-control" name="number" value="{{ old('number') }}" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Email<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Company Name<span class="text-danger"> *</span></label>
                    <input type="text" name="company_title_name" id="company_title_name" class="form-control" value="{{ old('contact_no') }}"  autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Company Website<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="webpage_url" value="{{ old('webpage_url') }}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Remarks<span class="text-danger"> *</span></label>
                    <textarea type="text" class="form-control" name="remarks" value="{{ old('remarks') }}" autocomplete="off" ></textarea>
                </div>
            </div>
        </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var countryId="{!! $eventdtl->country_id !!}";
                if(countryId==80){
                    $("#showdzongkhag").show();
                    $("#showvillage").show();
                    $("#showeventlocation").hide();
                }else{
                    $("#showdzongkhag").hide();
                    $("#showvillage").hide();
                    $("#showeventlocation").show();
                }
        })
    </script>
@endsection




