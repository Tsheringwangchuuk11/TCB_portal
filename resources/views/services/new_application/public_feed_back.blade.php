@extends('frontend/layouts/template')
@section('page-title','Grievance')
@section('content')
<div class="col-8 offset-md-2 d-flex justify-content-center pt-3">
    <h3 class="text-default"> Tourism Grievance</h3>
</div>
<div class="container">
    <form action="{{ url('save-grievance-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Complainant information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Applicant Type<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4" name="applicant_type_id" id="applicant_type_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($applicantTypes as $applicantType)
                            <option value="{{$applicantType->id}}">{{$applicantType->dropdown_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2" id="complainant">
                    <div class="form-group">
                        <label for="">Name of complainant <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="complainant_name" value="{{ old('complainant_name') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2" style="display:None " id="representative">
                    <div class="form-group">
                        <label for="">Name of the Representative:
                        <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="representative_name" value="{{ old('representative_name') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Authentic address for correspondence <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="complainant_address" value="{{ old('complainant_address') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Telephone</label>
                        <input type="text" class="form-control" name="complainant_telephone_no" value="{{ old('complainant_telephone_no') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="complainant_mobile_no" value="{{ old('complainant_mobile_no') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="complainant_email" value="{{ old('complainant_email') }}" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Respondent</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of Respondent <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_name" value="{{ old('respondent_name') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label>Category of service provider <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="service_provider_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($serviceproviders as $serviceprovider)
                            <option value="{{ $serviceprovider->id }}">{{ $serviceprovider->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Telephone</label>
                        <input type="text" class="form-control" name="respondent_telephone_no" value="{{ old('respondent_telephone_no') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_mobile_no" value="{{ old('respondent_mobile_no') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_address" value="{{ old('respondent_address') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="respondent_email" value="{{ old('respondent_email') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Summary of the Claim<span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="claim_summary"  row="4" value="{{ old('claim_summary') }}" autocomplete="off"></textarea>
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
                <li id="showlist" style="display: none">
                    <em>please provide a copy of the document authorizing the representation (“power of attorney”) together with the following details</em>
                </li>
                <li>
                    <em>Please indicate what supporting documents you propose to submit in support of your Application and, where appropriate: (Please attach additional sheet where necessary to fully describe your evidence)</em>
                </li>
                <li>
                    <em>This Claim is accompanied by:<br>
                    (a)	a copy of the contract document including email correspondences, itinerary, copy of remittance, between the Claimant and the Respondent
                    </em>
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Remedy sought</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="">Remedy sought<span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remedy_sought"  value="{{ old('remedy_sought') }}" row="4" autocomplete="off"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Statement of Adherence</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Location <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="location_id" id="location_id" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($dzongkhagLists as $dzongkhagList)
                            <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ml-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terms" id="exampleCheck2">
                            I hereby declare that
                            <P>The above information is true and accurate to the best of my/our knowledge and belief.
                                The complaint submitted are genuine and not in bad faith and
                                all important information material for resolving of this complaint are shared or will be shared with the Tourism Council of Bhutan.
                            </P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> SUBMIT</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
</form>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('#applicant_type_id').on('change',function(e) {
        var applicantype=e.target.value;
        if(applicantype=="5" || applicantype=="6"){
            $("#representative").show();
            $("#showlist").show();
            $("#complainant").hide();
        }else{
            $("#complainant").show();
            $("#representative").hide();
            $("#showlist").hide();
        }
    });
  });
$('#form_data').validate({
      ignore: [],
      rules: {
        complainant_email: {
            required: true,
            email: true,
         },
         applicant_type_id: {
            required: true,
         },
         complainant_name: {
            required: function(element) {
                var a=$("#applicant_type_id").val();
                if(a==4){
                    return $("#applicant_type_id").val() ==4;
                    }
            }
        }, 
        representative_name: {
            required: function(element) {
                var a=$("#applicant_type_id").val();
                if(a==5){
                    return $("#applicant_type_id").val() ==5;
                    }
                if(a==6){
                    return $("#applicant_type_id").val() ==6;
                 }
            }
        }, 
         respondent_name: {
            required: true,
         },
         complainant_address: {
            required: true,
         },
         complainant_telephone_no: {
            required: true,
            digits:true,
         },
         complainant_mobile_no: {
            required: true,
            digit:true,
         },
         service_provider_id: {
            required: true,
         },
         claim_summary: {
            required: true,
         },
         remedy_sought: {
            required: true,
         },
         location_id: {
            required: true,
         },
         respondent_email: {
            required: true,
            email:true
         },
         terms: {
            required:true,
         },
         respondent_address: {
            required:true,
         },
         respondent_mobile_no: {
            required:true,
         },
         respondent_telephone_no: {
            required:true,
         },
      },
    messages: {
    terms: "Please accept our terms"
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