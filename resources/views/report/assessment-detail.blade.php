@extends('layouts.manager')
@section('page-title', 'Hotel Assessment Details')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{	url(Request::server('REQUEST_URI').'?&print=true') }}" class="btn btn-sm btn-danger btn-flat" target="_blank"><i class="fa fa-print"></i> Print PDF</a>    
    <a href="{{url('report/assessment-reports')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back to List</a>
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Application Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Application No.</label>
                        <p class="float-right">{{$application->application_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Contact No.</label>
                        <p class="float-right">{{$application->contact_no}}</p>
                    </div>                    
                    <div class="form-group">
                        <label for="">Email.</label>
                        <p class="float-right">{{$application->email}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Dzongkhag</label>
                        {{-- <p class="float-right">{{$application->dzongkhag->dzongkhag_name}}</p> --}}
                    </div>
                    @if($application->road_distance)
                    <div class="form-group">
                        <label for="">Road Distance</label>
                        <p class="float-right">{{$application->road_distance}}</p>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="">Condition</label>
                        <p class="float-right">{{$application->condition}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Module</label>
                        <p class="float-right">{{$application->module_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Service</label>
                        <p class="float-right">{{$application->service_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">End User ID</label>
                        <p class="float-right">{{$application->end_user_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <p class="float-right">{{$application->gender}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <p class="float-right">{{$application->dob}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Designation</label>
                        <p class="float-right">{{$application->designation}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Applicant Flat No.</label>
                        <p class="float-right">{{$application->applicant_flat_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Applicabt Buiding No.</label>
                        <p class="float-right">{{$application->applicant_building_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Applicant Location</label>
                        <p class="float-right">{{$application->applicant_location}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Comapny Title</label>
                        <p class="float-right">{{$application->company_title_name}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Comapny Name</label>
                        <p class="float-right">{{$application->company_name_one}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Comapny Other Name</label>
                        <p class="float-right">{{$application->company_name_two}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Road Distance</label>
                        <p class="float-right">{{$application->road_distance}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Application Name</label>
                        <p class="float-right">{{$application->applicant_name}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Thram No.</label>
                        <p class="float-right">{{$application->thram_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">House No.</label>
                        <p class="float-right">{{$application->house_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <p class="float-right">{{$application->location}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Location ID</label>
                        <p class="float-right">{{$application->location_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Tentative Cons</label>
                        <p class="float-right">{{$application->tentative_cons}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Tentative Com</label>
                        <p class="float-right">{{$application->tentative_com}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">DRawing Dt.</label>
                        <p class="float-right">{{$application->drawing_date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Star Category</label>
                        <p class="float-right">{{$application->star_category_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">license No.</label>
                        <p class="float-right">{{$application->license_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">License Dt.</label>
                        <p class="float-right">{{$application->license_date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Owner Name</label>
                        <p class="float-right">{{$application->owner_name}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <p class="float-right">{{$application->address}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Fax. No.</label>
                        <p class="float-right">{{$application->fax}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Web URL</label>
                        <p class="float-right">{{$application->webpage_url}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Number</label>
                        <p class="float-right">{{$application->number}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Town Distance</label>
                        <p class="float-right">{{$application->town_distance}}</p>
                    </div>      
                    <div class="form-group">
                        <label for="">Financial Year</label>
                        <p class="float-right">{{$application->financial_year}}</p>
                    </div>               
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">CID</label>
                        <p class="float-right">{{$application->cid_no}}</p>
                    </div>                   
                    <div class="form-group">
                        <label for="">Condtion</label>
                        <p class="float-right">{{$application->condition}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">validity Dt.</label>
                        <p class="float-right">{{$application->validity_date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Float No.</label>
                        <p class="float-right">{{$application->flat_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Building No.</label>
                        <p class="float-right">{{$application->building_no}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Village</label>
                        <p class="float-right">{{$application->village_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Gewog</label>
                        <p class="float-right">{{$application->gewog_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <p class="float-right">{{$application->city}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Country</label>
                        <p class="float-right">{{$application->country_id}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Purpose</label>
                        <p class="float-right">{{$application->visit_purpose}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Destination</label>
                        <p class="float-right">{{$application->sell_destination}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Sell Bhutan</label>
                        <p class="float-right">{{$application->sell_bhutan}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Destination Year</label>
                        <p class="float-right">{{$application->destination_year}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Bhutan Year</label>
                        <p class="float-right">{{$application->bhutan_year}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <p class="float-right">{{$application->date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">From Dt.</label>
                        <p class="float-right">{{$application->from_date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">To Date</label>
                        <p class="float-right">{{$application->to_date}}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <p class="float-right">{!!nl2br($application->remarks)!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection