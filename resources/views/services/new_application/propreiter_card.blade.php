@extends('layouts.enduser')
@section('page-title','Issuance Of Propreiters Card')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">License No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="license_no" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Company Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="company_title_name" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Validity Date<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="validity_date" data-target-input="nearest">
                                    <input type="text" name="validity_date" class="form-control datetimepicker-input" data-target="#validity_date" value="{{ old('license_date') }}">
                                    <div class="input-group-append" data-target="#validity_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Citizen ID<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="cid_no" autocomplete="off" maxlength="11">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="">Phone No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="contact_no" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Location</h4>
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
                    1.&nbsp;<em>Valid Business License</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="proprieter_card_license_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="proprieter_card_license_files"></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                    2.&nbsp;<em>Valid NOC</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="noc_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="noc_files"></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                    3.&nbsp;<em>BIT clearance</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="bit_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="bit_files"></div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                    4.&nbsp;<em>CID copy</em> 
                    </div>
                    <div class="col-md-3">
                        <span class="btn bg-purple fileinput-button btn-sm">
                            <i class="fas fa-plus fa-sm"></i>
                            <span>Add file...</span>
                            <input id="proprieter_cid_upload" type="file" name="filename"> 
                        </span>
                    </div>
                    <div class="col-md-5" id="proprieter_cid_files"></div>
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
        $(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
            $('#validity_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
        $('#form_data').validate({
                rules: {
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                     validity_date: {
                        required: true,
                    },
                    company_title_name: {
                        required: true,
                    },
                    license_no: {
                        required: true,
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
                },
                messages: {
                    cid_no: {
                        required: "Please provide a cid number",
                        maxlength: "Your cid must be 11 characters long",
                        minlength: "Your cid must be at least 11 characters long",
                        digits: "This field accept only digits",
                    },
                    contact_no: {
                        required: "Please provide a contact number",
                        digits: "This field accept only digits",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    company_title_name: {
                        required: "Please enter company name",
                    },
                    validity_date: {
                        required: "Please enter license date",
                    },
                    license_no: {
                        required: "Please enter license number",
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
    </script>
@endsection








