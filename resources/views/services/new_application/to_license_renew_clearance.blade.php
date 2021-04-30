@extends('layouts.enduser')
@section('page-title','Tour Operator License Clearance For Renewal Of Expired Trade License')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<input type="hidden" name="application_type_id" value="{{ $applicationTypes[0]->id }}" id="application_type_id">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" onchange="getTourOperatorDetails(this.value)">
                </div>
            </div>
            <div class="col-md-5  offset-md-2">
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
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" id="company_title_name" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" id="owner_name" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" id="contact_no" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Email<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Website<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url" id="webpage_url" value="{{ old('webpage_url') }}">
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
                            <input type="text" class="form-control" name="gewog_name" id="gewog_name" readonly="true">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="village_name" id="village_name" readonly="true">
                        <input type="hidden" class="form-control" name="establishment_village_id" id="village_id">
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
        <ol>
            <li>
                <em>A copy of the valid trade license.</em>      
            </li>
            <li>
                <em>Valid Tax Clearance</em>      
            </li>
            <li>
                <em>A copy of the letter of authorization from the building owner stating that the applicant is authorized to operate the office in his/her property or ownership certificate in case of own building</em>      
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
    </div>
</div>
<form>
@endsection
@section('scripts')
	<script>
        $(document).ready(function () {
            $('#license_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });
        });
		function getTourOperatorDetails(licenseNo){
			$.ajax({
				url:'/application/get-hotel-details/'+licenseNo,
				type: "GET",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				dataType: "json",
				success:function(data) {
					$('#company_title_name').val(data.tourist_standard_name);
					$('#cid_no').val(data.cid_no);
					$('#owner_name').val(data.owner_name);
					$('#license_date').val(data.license_date);
                    $('#contact_no').val(data.contact_no);
                    $('#email').val(data.email);
                    $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                    $('#gewog_name').val(data.gewog_name);
                    $('#village_name').val(data.village_name);
                    $('#village_id').val(data.village_id);
                    $('#webpage_url').val(data.webpage_url);
				  } 
				});
			} 
            $('#form_data').validate({
                rules: {
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
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
                    gewog_name: {
                        required: true,
                    },
                    village_name: {
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
                    gewog_name: {
                        required: "Please select gewog",
                    },
                    village_name: {
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
