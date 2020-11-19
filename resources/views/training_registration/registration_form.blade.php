@extends('frontend/layouts/template')
@section('content')
<div class="container">
    <form id="registration_form" action="{{ url('save-trainee-dtls') }}" class="form-horizontal" method="POST">
        <input type="hidden" class="form-control" name="service_id" value="21">
        <input type="hidden" class="form-control" name="service_name" value="Training">
        <input type="hidden" class="form-control" name="course_dtl_id" value="{{$id}}">
        @csrf
        <div class="card m-4">
            <div class="card-header">
                <h5 class="card-title">Applicant Details</h5>
            </div>
            <div class="card-body">
                <div class="row"> 
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Citizen ID<span class="text-danger "> *</span></label>
                            <input type="text" id="cid_no" name="applicant_cid_no" class="form-control" onchange="api_webservices(this.value)">
                            <span id="webserviceError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Name<span class="text-danger "> *</span></label>
                            <input type="text" id= "applicant_name" name="applicant_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">DOB<span class="text-danger "> *</span></label>
                            <input type="text" id= "applicant_dob" name="applicant_dob" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Contact No.<span class="text-danger "> *</span></label>
                            <input type="text" id= "contact_no" name="applicant_contact_no" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Email<span class="text-danger "> *</span></label>
                            <input type="email" id= "email" name="applicant_email" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                        <label for="">Gender<span class="text-danger "> *</span></label>
                        <select class="form-control select2bs4" name="applicant_gender" id="gender">
                            <option value="">- Select -</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('applicant_gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <input type="text" id= "dzongkhag_name" name="dzongkhag_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Gewog<span class="text-danger"> *</span></label>
                            <input type="text" id= "gewog_name" name="gewog_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Village<span class="text-danger"> *</span></label>
                            <input type="hidden" id= "permanent_village_id" name="applicant_village_id" class="form-control">
                            <input type="text" id= "village_name" name="village_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Present working Address</label>
                            <textarea class="form-control" name="present_working_address"></textarea>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        <div class="card m-4">
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
                                       Valid Concern / Nomination letter
                                    </li>
                                    <li>
                                       Letter of Undertaking
                                    </li>
                                    <li>
                                       Security Clearance Certificate (generate from online link)
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            @include('services/fileupload/fileupload')
            </div>
            <div class="card-footer text-center" >
                <button type="submit"class="btn btn-success"><li class="fas fa-check"></li>APPLY</button>
                <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li>RESET</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
			$('.select2bs4').on('change', function () {
				$(this).valid();
			});
		});
    $(function() {
        $('#registration_form').validate({
            rules: {
                applicant_cid_no: {
                    required: true,
                    maxlength: 11,
                    minlength: 11,
                    digits: true,  
                },
                applicant_name: {
                    required: true,
                },
                applicant_dob: {
                     required: true,
                },
                applicant_contact_no: {
                    required: true,
                    digits: true,  
                },
                applicant_email: {
                    required: true,
                    email: true,                    
                },
                dzongkhag_id: {
                    required: true,
                },
                applicant_gender: {
                    required: true,
                },
                applicant_email: {
                    required: true,
                    email: true,
                },
                gewog_id: {
                    required: true,
                },
                establishment_village_id:{
                    required: true,
                },
            },
            
            messages: {
                applicant_cid_no: {
                    required: "Please provide a cid number",
                    maxlength: "Your cid must be 11 characters long",
                    minlength: "Your cid must be at least 11 characters long",
                    digits: "This field accept only digits",
                },
                applicant_name: {
                    required: "Please enter your name",
                },
                applicant_dob: {
                     required: "Please select dob",
                },
                applicant_contact_no: {
                    required: "Please enter your contact number",
                    digits: "This field accept only digits",
                },
                applicant_email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                dzongkhag_id:{
                    required: "Please select your dzongkhag",
                },
                applicant_gender: {
                    required: "Please select your gewog",
                },
                gewog_id: {
                   required: "Please enter phone number",
                },
                establishment_village_id: {
                    required: "Please select your village",
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
