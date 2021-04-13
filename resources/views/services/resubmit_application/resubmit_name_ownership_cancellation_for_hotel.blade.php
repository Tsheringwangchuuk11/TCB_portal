@extends('layouts.manager')
@section('page-title','Tourist Standard Hotel Ownership Change')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
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
                            <label>Star Category</label>
                            <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                                <option value="">- Select -</option>
                                @foreach ($starCategoryLists as $starCategoryList)
                                <option value="{{ $starCategoryList->id }}" {{ old('star_category_id', $applicantInfo->star_category_id) == $starCategoryList->id ? 'selected' : '' }}> {{ $starCategoryList->star_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">License Number <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">License Date </label>
                            <div class="input-group date" id="license_date" data-target-input="nearest">
                                <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
                                <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Hotel Name </label>
                            <input type="text" class="form-control" name="company_title_name" value="{{ $applicantInfo->company_title_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Owner Name</label>
                            <input type="text" class="form-control" name="old_owner_name" value="{{ $applicantInfo->owner_name }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Citizen ID</label>
                            <input type="text" class="form-control" name="old_cid_no" value="{{ $applicantInfo->cid_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Address </label>
                            <input type="text" class="form-control" name="old_address" value="{{ $applicantInfo->address }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Contact No. </label>
                            <input type="text" class="form-control" name="old_contact_no" value="{{ $applicantInfo->contact_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Manager Name<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="manager_name" value="{{ $applicantInfo->manager_name }}" autocomplete="off">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for=""> Manager Contact No <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="manager_mobile_no" value="{{ $applicantInfo->manager_mobile_no }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Fax </label>
                            <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Email </label>
                            <input type="email" class="form-control" name="old_email" value="{{ $applicantInfo->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Internet Homepage </label>
                            <input type="text" class="form-control" name="webpage_url" value="{{ $applicantInfo->webpage_url }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Number of Beds </label>
                            <input type="number" class="form-control" name="bed_no" value="{{ $applicantInfo->number }}">
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
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
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
                        <input type="text" class="form-control" name="company_name_one" value="{{ $applicantInfo->company_name_one }}">
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
                        <label for="">Citizen ID<span class="text-danger"> *</span></label>
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
                <li><em>Valid business license</em></li>
                <li><em>CID copy</em></li>
            </ol>
            <ol id="cancelllation" style="display:none">
                <li><em>Valid business license</em></li>
                <li><em>CID copy</em></li>
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
                    $("#newowner").hide();
                    $("#ownership_change").hide();
                    $("#name_change").show();
                    $("#name_change_info").show();
                    $("#cancelllation").hide();
                } 
                else if(application_type == "29"){
                    $("#newowner").show();
                    $("#ownership_change").show();
                    $("#name_change").hide();
                    $("#cancelllation").hide();
                    $("#name_change_info").hide();
                } 
                else if(application_type == "30"){
                    $("#newowner").hide();
                    $("#ownership_change").hide();
                    $("#name_change").hide();
                    $("#cancelllation").show();
                    $("#name_change_info").hide();
                }
                $('#license_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                });
        });
    </script>
@endsection
