@extends('layouts.enduser')
@section('page-title','Recommendation Letter For New Tourism Product')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Proponent Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Citizen ID<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="cid_no" onchange="api_webservices(this.value)" maxlength="11">
                        <span id="webserviceError" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="applicant_name" id="applicant_name" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" id="address" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="contact_no" id="contact_no" autocomplete="off" maxlength="8">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Product Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Product/Infrastructure Type <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="product_type" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Objective<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="objective" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Product/Infrastructure description in detail<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="product_des" autocomplete="off">  
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for=""> Project cost (In Million)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project_cost" autocomplete="off">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Start Date<span class="text-danger">*</span></label>
                <div class="input-group date" id="start_date" data-target-input="nearest">
                    <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#start_date" value="{{ old('start_date') }}">
                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">End Date<span class="text-danger">*</span></label>
                <div class="input-group date" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date" value="{{ old('end_date') }}">
                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contribution" autocomplete="off">  
            </div>
        </div>
    </div>
</div>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">Product Location</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($dzongkhagLists as $dzongkhagList)
                            <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Gewog<span class="text-danger"> *</span></label>
                        <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    1.&nbsp;<em>Detailed Project Proposal</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="project_proposal_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="project_proposal_files"></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                    2.&nbsp;<em>Sector clearance from all relevant agencies (Note: Merge to one pdf and upload if there is more than one file)</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="sector_clearance_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="sector_clearance_files"></div>
                </div><br>
            </div>
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
        $('#start_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#end_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
         // form validation
    $('#form_data').validate({
                    rules: {
                        cid_no: {
                            required: true,
                            maxlength: 11,
                            minlength: 11,
                            digits: true,                    
                        },
                        applicant_name: {
                            required: true,
                        },
                        contact_no: {
                            required: true,
                            digits: true,                    
                        },
                        email: {
                            required: true,
                            email: true,                    
                        },
                        dzongkhag_id: {
                            required: true,
                        },
                        gewog_id: {
                            required: true,
                        },
                        establishment_village_id: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        product_type: {
                            required: true,
                        },
                        product_des: {
                            required: true,
                        },
                        objective: {
                            required: true,
                        },
                        project_cost: {
                            required: true,
                        },
                        contribution: {
                            required: true,
                        },
                        start_date: {
                            required: true,
                        },
                        end_date: {
                            required: true,
                        },
                    },
                    messages: {
                        cid_no: {
                            required: "Please provide a cid number",
                            maxlength: "Your cid must be 11 characters long",
                            minlength: "Your cid must be at least 11 characters long",
                            digits: "This field accept only digits",
                        },
                        applicant_name: {
                            required: "Enter the name",
                        },
                        contact_no: {
                            required: "Please provide a contact number",
                            digits: "This field accept only digits",
                        },
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a vaild email address"
                        },
                        dzongkhag_id: {
                            required: "Please select dzongkhag",
                        },
                        gewog_id: {
                            required: "Please select gewog",
                        },
                        establishment_village_id: {
                            required: "Please select village",
                        },
                        address: {
                            required:"Please enter the address",
                        },
                        product_type: {
                            required: "Please enter product type",
                        },
                        product_des: {
                            required: "Please enter your product type  description",
                        },
                        objective: {
                            required: "Please enter objective",
                        },
                        project_cost: {
                            required: "Please enter the project cost",
                        },
                        contribution: {
                            required: "Please enter the the project contribution",
                        },
                        start_date: {
                            required: "Please enter start date",
                        },
                        end_date: {
                            required: "Please enter end date",
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
            });
    });
</script>
@endsection
