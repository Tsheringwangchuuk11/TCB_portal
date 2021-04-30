@extends('layouts.enduser')
@section('page-title','Tourist Standard Restuarant Name Change')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tourist Standard Restuarant Name Change</h4>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Application No. <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label>Application Type <span class="text-danger">*</span></label>
                            <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                                <option value="">- Select -</option>
                                @foreach ($applicationTypes as $applicationType)
                                <option value="{{ $applicationType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}> {{ $applicationType->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">License Number <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">License Date <span class="text-danger"> *</span> </label>
                            <div class="input-group date" id="license_date" data-target-input="nearest">
                                <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
                                <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>                             
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Restuarant Name </label>
                            <input type="text" class="form-control" name="company_title_name" value="{{ $applicantInfo->company_title_name }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Owner Name </label>
                            <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Address </label>
                            <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Citizen ID</label>
                            <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Contact No. </label>
                            <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Fax </label>
                            <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Email </label>
                            <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Internet Homepage </label>
                            <input type="text" class="form-control" name="webpage_url" value="{{ $applicantInfo->webpage_url }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Hotel Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $applicantInfo->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value="">{{ $applicantInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($applicantInfo->application_type_id==28)
    <div class="card">
        <div class="card-header">
            <h4 class="card-tile"> New Hotel Name</h4>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">New Name <span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_name_one }}">
                    </div>
                </div>
        </div>
    </div>
@endif
@if ($applicantInfo->application_type_id==29)
    <div class="card">
        <div class="card-header">
            <h4 class="card-tile">New Owner Information</h4>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Owner Name <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_owner_name" value="{{ $applicantInfo->new_owner_name }}">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">CID No. <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_cid_no" value="{{ $applicantInfo->new_cid_no }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_address" value="{{ $applicantInfo->new_address }}">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_contact_no" value="{{ $applicantInfo->new_contact_no }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email <span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="new_email" value="{{ $applicantInfo->new_email }}">
                    </div>
                </div>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol id="ownership_change" style="display:none">
            <li>
                <em>
                Aggreement letter between Old owner and new owner with legal stamp</em> 
            </li>
            <li>  
                <em>CID copy</em>
            </li>
            <li>  
                <em>Business license</em>
            </li>
            <li>  
                <em>Tax clearance </em>
            </li>
        </ol>
        <ol id="name_change" style="display:none">
            <li>  
                <em>CID copy</em>
            </li>
            <li>  
                <em>Business license</em>
            </li>
            <li>  
                <em>Tax clearance </em>
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <!-- card body ends -->
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
    <script>
          $(document).ready(function(){
                var application_type=$("#application_type_id").val();
                if(application_type == "28"){
                    $("#name_change_info").show();
                    $("#name_change").show();
                    $("#ownership_change").hide();
                    $("#newowner").hide();
                } 
                else {
                    $("#ownership_change").show();
                    $("#newowner").show();
                    $("#name_change_info").hide();
                    $("#name_change").hide();
                } 
                $('#license_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                });
        });
    </script>
@endsection
