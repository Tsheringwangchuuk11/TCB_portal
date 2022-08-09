@extends('layouts.enduser')
@section('page-title','Tour Operator License Clearance - New License')
@section('content')
<form action="{{ url('application/save-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <input type="hidden" name="application_type_id" value="{{ $applicationTypes[0]->id }}" id="application_type_id">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Citizen ID<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" onchange="api_webservices(this.value)" maxlength="11">
                    <span id="webserviceError" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="" >Name <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="applicant_name" id="applicant_name">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">DOB <span class="text-danger"> *</span></label>
                    <div class="input-group date"  data-target-input="nearest">
                        <input type="text" name="dob" id="dob" class="form-control datetimepicker-input" data-target="#dob" value="{{ old('dob') }}">
                        <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender" id="gender" autocomplete="off">
                      <option value="">- Select -</option>
                      @foreach (config()->get('settings.gender') as $k => $v)
                      <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_name" id="dzongkhag_name" class="form-control select2bs4 permanentdzongkhagdropdown" style="width: 100%;">
                      <option value=""> -Select-</option>
                      @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="permanent_gewog_id" class="form-control select2bs4 permanentgewogdropdown" id="permanent_gewog_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>                   </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="permanent_village_id" class="form-control select2bs4" id="permanent_village_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>
                  </div>

                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Email<span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" name="email" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <input type="checkbox" name="partnership" autocomplete="off" value="1" id="checkboxId">&nbsp;
                    <label for="" class="text-info"> Check in case of partnership</label>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="card" style="display: none" id="partnerInfo">
        <div class="card-header">
             <h4 class="card-title">Partner's General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Citizen ID<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="partner_cid_no" id="cid" autocomplete="off" maxlength="11">
                </div>
              </div>
              <div class="col-md-5 offset-md-2">
                <div class="form-group">
                  <label for="">Name<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="partner_name" autocomplete="off">
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">DOB<span class="text-danger"> *</span></label>
                    <div class="input-group date" id="pdate_of_birth" data-target-input="nearest">
                      <input type="text" name="partner_dob" class="form-control datetimepicker-input" data-target="#pdate_of_birth" value="{{ old('partner_dob') }}">
                      <div class="input-group-append" data-target="#pdate_of_birth" data-toggle="datetimepicker">
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
                      <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="partner_dzongkhag_id" id="partner_dzongkhag_id" class="form-control select2bs4 partnerdzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                          <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="partner_gewog_id" class="form-control select2bs4 partnergewogropdown" id="partner_gewog_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Village <span class="text-danger"> *</span></label>
                    <select  name="partner_village_id" class="form-control select2bs4" id="partner_village_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Email<span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" name="partner_email" autocomplete="off">
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Name, Address and Contact Information of the Establishment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-right text-danger"></small>
                    <input type="text" class="form-control" name="company_title_name"  autocomplete="off" onchange="checkCompanyName(this.value)" id="company_title_name">
                  </div>
                  <div class="alert alert-danger alert-dismissible" id="alertMgsId" style="display: none">
                    <i class="fa fa-info-circle fa-lg"></i><strong><span id="showMsg"></span> Company name  already exists and enter different name</strong>
                </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                          <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>  
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Village <span class="text-danger"> *</span></label>
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                      <option value=""> -Select-</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Postal Address<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="address" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Contact No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_no" autocomplete="off" maxlength="8">
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
            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-5">
                  1.&nbsp;<em>Academic transcript of the applicant or the person who intends to manage the business</em> 
                  </div>
                  <div class="col-md-2">
                      <span class="btn bg-purple fileinput-button btn-sm">
                          <i class="fas fa-plus fa-sm"></i>
                          <span>Add file...</span>
                          <input id="academic_transcript_upload" type="file" name="filename"> 
                      </span>
                  </div>
                  <div class="col-md-5" id="academic_transcript_files"></div>
              </div><br>
              <div class="row">
                  <div class="col-md-5">
                  2.&nbsp;<em>Copy of Lease Agreement/Undertaking letter from the Landlord for office space or ownership certificate in case of own building</em> 
                  </div>
                  <div class="col-md-2">
                      <span class="btn bg-purple fileinput-button btn-sm">
                          <i class="fas fa-plus fa-sm"></i>
                          <span>Add file...</span>
                          <input id="lease_agreement_upload" type="file" name="filename"> 
                      </span>
                  </div>
                  <div class="col-md-5" id="lease_agreement_files"></div>
              </div><br>
              <div class="row">
                  <div class="col-md-5">
                  3.&nbsp;<em>Copy of Security Clearance Certificate</em> 
                  </div>
                  <div class="col-md-2">
                      <span class="btn bg-purple fileinput-button btn-sm">
                          <i class="fas fa-plus fa-sm"></i>
                          <span>Add file...</span>
                          <input id="security_clearance_upload" type="file" name="filename"> 
                      </span>
                  </div>
                  <div class="col-md-5" id="security_clearance_files"></div>
              </div><br>
              <div class="row">
                  <div class="col-md-5">
                  4.&nbsp;<em>Declaration signed by the applicant that he/she is not a Civil Servant, employee of a Government Controlled Organization or Corporate Body as set out in Annexure A of TRR 2017</em> 
                  </div>
                  <div class="col-md-2">
                      <span class="btn bg-purple fileinput-button btn-sm">
                          <i class="fas fa-plus fa-sm"></i>
                          <span>Add file...</span>
                          <input id="declaration_upload" type="file" name="filename"> 
                      </span>
                  </div>
                  <div class="col-md-5" id="declaration_files"></div>
              </div><br>
            </div>
	    <div class="form-group col-md-6">
				<a href="{{ url('MyDocument/TourOperatorLicenseClearanceForm.doc') }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-link"></i> 
					Download Letter of Undertaking Form
				</a>                
			</div>
      </div>
        <div class="row">
          <div class="col-md-12">
          <div class="ml-3 form-group">
              <div class="form-check">
                <input type="checkbox" name="terms" class="form-check-input" id="exampleCheck2">
                <p>I declare that the information given in this form is true and complete in all aspects to the best of my knowledge</p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center card-footer">
            <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger"><li class="fas fa-ban"></li> RESET</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
  $('#checkboxId').click(function() {
    $("#partnerInfo").toggle(this.checked);
});
$(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
            $('#dob').datetimepicker({
                format: 'MM/DD/YYYY',
            });
            $('#pdate_of_birth').datetimepicker({
                format: 'MM/DD/YYYY',
            });
        });
function checkCompanyName(companyName){
  $.ajax({
	url:'/application/get-companyname',
		type: "GET",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				companyName: companyName
			},
			dataType: "json",
		success:function(data) {
			if(data==true){
			$('#showMsg').html(data.msg);
			$('#alertMgsId').show().delay(3000).queue(function (n) {
			$(this).hide();
			n();
			});
			$('#company_title_name').val('');
			}
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
				permanent_gewog_id: {
					required: true,
				},
				permanent_village_id: {
					required: true,
				},
				company_title_name: {
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

