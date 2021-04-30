@extends('layouts.enduser')
@section('page-title','Tour Operator New License Clearance')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
  @csrf
  <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
  <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
  <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
  <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
  <input type="hidden" name="application_type_id" value="{{ $applicantInfo->application_type_id }}" id="application_type_id">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Application Number<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                      </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="" >Name <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="applicant_name" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Citizen ID <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">DOB <span class="text-danger"> *</span></label>
                      <div class="input-group date" id="dob" data-target-input="nearest">
                          <input type="text" name="dob" class="form-control datetimepicker-input" data-target="#dob" value="{{ $applicantInfo->dob}}">
                          <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>     
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender" autocomplete="off">
                      <option value="">- Select -</option>
                      @foreach (config()->get('settings.gender') as $k => $v)
                      <option value="{{ $k }}" {{ old('gender', $applicantInfo->gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                       <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                       <input type="text" class="form-control" name="dzongkhag_name" id="dzongkhag_name" value="{{ $applicantInfo->permanent_dzongkhag_name }}">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="gewog_name" id="gewog_name" value="{{ $applicantInfo->permanent_gewog_name }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <input type="hidden" class="form-control" name="permanent_village_id" id="permanent_village_id" value="{{ $applicantInfo->permanent_village_id }}">
                      <input type="text" class="form-control" name="village_name" id="village_name" value="{{ $applicantInfo->permanent_village_name }}">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $applicantInfo->email }} ">
                  </div>
                </div>
              </div>
        </div>
    </div>
@if (!is_null($partnerInfo))
    <input type="hidden" name="partnership" autocomplete="off" value="1" id="checkboxId">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Partner’s General Information (In case of partnership)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_name" value="{{ $partnerInfo->partner_name }}">
                    <input type="hidden" class="form-control" name="partner_record_id" value="{{ $partnerInfo->id }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Citizen ID<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_cid_no" value="{{ $partnerInfo->partner_cid_no }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">DOB<span class="text-danger"> *</span></label>
                    <div class="input-group date" id="partner_dob" data-target-input="nearest">
                        <input type="text" name="partner_dob" class="form-control datetimepicker-input" data-target="#partner_dob" value="{{ $partnerInfo->partner_dob}}">
                        <div class="input-group-append" data-target="#partner_dob" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>  
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select  class="form-control" name="partner_gender">
                      <option value="">-Select-</option>
                      @foreach (config()->get('settings.gender') as $k => $v)
                      <option value="{{ $k }}" {{ old('gender', $partnerInfo->partner_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="partner_dzongkhag_id" class="form-control partnerdzongkhagdropdo select2bs4" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $partnerInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 partnergewogropdown" id="partner_gewog_id" style="width: 100%;">
                      <option value="{{ $partnerInfo->gewog_id }}">{{ $partnerInfo->gewog_name }}</option>
                    </select>  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Village <span class="text-danger"> *</span></label>
                    <select  name="partner_village_id" class="form-control select2bs4 partnergewogropdown" id="partner_village_id" style="width: 100%;">
                      <option value="{{ $partnerInfo->partner_village_id }}">{{ $partnerInfo->village_name }}</option>
                    </select>  
                  </div>
                </div>
                  <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" name="partner_email" class="form-control" value="{{ $partnerInfo->partner_email }} ">
                    </div>
                  </div>
               </div>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Name, Address and Contact Information of the Establishment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option one]</small>
                    <input type="text" class="form-control" name="company_title_name"  value="{{ $applicantInfo->company_title_name }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option Two]</small>
                    <input type="text" class="form-control" name="company_name_one" value="{{ $applicantInfo->company_name_one }}">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option Three]</small>
                    <input type="text" class="form-control" name="company_name_two"  value="{{ $applicantInfo->company_name_two }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control dzongkhagdropdown select2bs4" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control gewogdropdown select2bs4" id="gewog_id" style="width: 100%;">
                      <option value="{{ $applicantInfo->gewog_id }}"> {{ $applicantInfo->gewog_name }}</option>
                    </select> 
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}"> {{ $applicantInfo->village_name }} </option>
                      </select> 
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Postal Address<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Contact No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
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
        <h6> Required supporting documents:</h6>
        <ol>
          <li>
            <em>Copy of Citizenship Identity Card</em>      
          </li>

          <li>
            <em>Security Clearance Certificate</em>      
          </li>

          <li>
            <em>Academic transcript of the applicant or the person who intends to manage the business</em>      
          </li>

          <li>
            <em>Copy of Lease Agreement/Undertaking letter from the Landlord for office space or ownership certificate in case of own building</em>      
          </li>
          <li>
            <em>Declaration signed by the applicant that he/she is not a Civil Servant, employee of a Government Controlled Organization or Corporate Body as set out in Annexure A of TRR 2017 </em>      
          </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="form-group ml-3">
            <div class="form-check">
              <input type="checkbox" name="terms" class="form-check-input" id="exampleCheck2">
              <p>I declare that the information given in this form is true and complete in all aspects to the best of my knowledge</p>
            </div>
          </div>
        </div>
      </div>
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
        <button type="reset" class="btn btn-danger"><li class="fas fa-ban"></li> RESET</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
	<script>
     $(document).ready(function(){
        $('#partner_dob').datetimepicker({
            format: 'MM/DD/YYYY',
        });
        $('#dob').datetimepicker({
            format: 'MM/DD/YYYY',
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
                    dob: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                applicant_name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,                    
                },
                dzongkhag_name: {
                    required: true,
                },
                gewog_name: {
                    required: true,
                },
                village_name: {
                    required: true,
                },
                company_title_name: {
                    required: true,
                },
                company_name_one: {
                    required: true,
                },
                company_name_two: {
                    required: true,
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
                contact_no: {
                    required: true,
                },
                partner_cid_no: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                }, 
                partner_name: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                },
                partner_dob: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                },  
                partner_gender: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                }, 
                partner_dzongkhag_id: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                },
                partner_gewog_id: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                },
                partner_village_id: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                },
                partner_email: {
                    required: function(element) {
                        return $("#checkboxId").val() ==1;
                    }
                }, 
                terms: {
                    required:true,
                },   
            },
            messages: {
                cid_no: {
                    required: "Please provide a cid number",
                    maxlength: "Your cid must be 11 characters long",
                    minlength: "Your cid must be at least 11 characters long",
                    digits: "This field accept only digits",
                },
                terms: {
                    required:"Please accept our terms",
                    },
                applicant_name: {
                    required: "Enter the name",
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                dob: {
                    required: "Please enter dob",
                },
                dzongkhag_name: {
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



