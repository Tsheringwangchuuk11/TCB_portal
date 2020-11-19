@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tour Operators Office')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" id="form_data" enctype="multipart/form-data">
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
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" value="{{ old('company_title_name') }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" value="{{ old('cid_no') }}" onchange="api_webservices(this.value)">
                    <span id="webserviceError" class="text-danger"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ old('owner_name') }}" id="applicant_name">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no') }}" id="contact_no">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ old('license_no') }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">License Date.<span class="text-danger">*</span> </label>
                    <div class="input-group date" id="license_date" data-target-input="nearest">
                        <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ old('license_date') }}">
                        <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Website<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url" value="{{ old('webpage_url') }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Email.<span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
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
<div id="showdivid"></div>
<div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ml-3">
                        <div class="form-check">
                            <ol>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;<em>A copy of the valid trade license.</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp; <em>Office building photo</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp; <em>Sign board</em>
                                </li>
                                <li>
                                    <input type="checkbox" name="checkboxes"  class="check-one">&nbsp;A copy of the letter of authorization from the building owner stating that the applicant is authorized to operate the office in his/her property or ownership certificate in case of own building</em>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center" >
            <button type="submit"class="btn btn-success">
                <li class="fas fa-check"></li>
                APPLY
            </button>
            <button type="reset" class="btn btn-danger">
                <li class="fas fa-times"></li>
                RESET
            </button>
        </div>
    </div>
<form>
@endsection
@section('scripts')
    <script>
         $(document).ready(function () {
            $('#license_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            function loadChecklistDetails() {
                var url="{{ url('application/get-checklist') }}";
                    var options = {target:'#showdivid',
                    url:url,
                    type:'POST',
                    data: $("#form_data").serialize()};
                    $("#form_data").ajaxSubmit(options);
            }
           window.onload=loadChecklistDetails();
         });
          // document check list validation
        var chck = $('input[type=checkbox]');
        var numItems = $('.check-one').length;
        chck.hasClass('check-one');
        $.validator.addMethod('check_one', function (value) {
            return (chck.filter(':checked').length ==numItems);
        }, 'Submit all the document mention above'); 

         $('#form_data').validate({
                rules: {
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                     checkboxes: {
                             check_one: true,
                    },
                     license_date: {
                        required: true,
                    },
                    company_title_name: {
                        required: true,
                    },
                    license_no: {
                        required: true,
                    },
                    owner_name: {
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
                    webpage_url: {
                        required: true,
                        url: true,
                        normalizer: function( value ) {
                        var url = value;
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                        // then prefix with http://
                        url = "http://" + url;
                        }
                        // Return the new url
                        return url;
                        }
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
                    owner_name: {
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
                    webpage_url: {
                        required: "Please enter webpage_url",
                    },
                    company_title_name: {
                        required: "Please enter company name",
                    },
                    license_date: {
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