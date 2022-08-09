@extends('layouts.manager')
@section('page-title','Tour Operator New License Clearance')
@section('content')
<form action="{{ url('verification/operator-technical-clearance') }}" method="POST" files="true" id="formId" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
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
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" disabled>
                      </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="" >Name <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name }}" disabled>
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Citizen ID <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}" disabled>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">DOB <span class="text-danger"> *</span></label>
                      <div class="input-group date" id="dob" data-target-input="nearest">
                        <input type="text" name="dob" class="form-control" value="{{ $applicantInfo->dob}}" disabled>
                    </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender" autocomplete="off" disabled>
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
                      <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control dzongkhagdropdown select2bs4" style="width: 100%;" disabled>
                          <option value=""> -Select-</option>
                          @foreach ($dzongkhagLists as $dzongkhagList)
                          <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->permanent_dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control gewogdropdown select2bs4" id="gewog_id" style="width: 100%;" disabled>
                      <option value=""> {{ $applicantInfo->permanent_gewog_name }}</option>

                    </select> 
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <select  name="applicant_location" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
                        <option value="{{ $applicantInfo->permanent_village_id }}"> {{ $applicantInfo->permanent_village_name }} </option>
                      </select> 
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $applicantInfo->email }}" disabled>
                  </div>
                </div>
              </div>
        </div>
    </div>
@if(isset($partnerInfo->id))
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Partner’s General Information (In case of partnership)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_name" value="{{ $partnerInfo->partner_name }}" disabled>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Citizen ID<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_cid_no" value="{{ $partnerInfo->partner_cid_no }}" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">DOB<span class="text-danger"> *</span></label>
                    <div class="input-group date" id="partner_dob" data-target-input="nearest">
                      <input type="text" name="partner_dob" class="form-control" value="{{ $partnerInfo->partner_dob}}" disabled>
                  </div>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select  class="form-control" name="partner_gender" disabled>
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
                    <select  name="dzongkhag_id" id="partner_dzongkhag_id" class="form-control partnerdzongkhagdropdo select2bs4" style="width: 100%;" disabled>
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
                    <select  name="gewog_id" class="form-control select2bs4 partnergewogropdown" id="partner_gewog_id" style="width: 100%;" disabled>
                      <option value="">{{ $partnerInfo->gewog_name }}</option>
                    </select>  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Village <span class="text-danger"> *</span></label>
                    <select  name="partner_village_id" class="form-control select2bs4 partnergewogropdown" id="partner_village_id" style="width: 100%;" disabled>
                      <option value="{{ $partnerInfo->partner_village_id }}">{{ $partnerInfo->village_name }}</option>
                    </select>  
                  </div>
                </div>
                  <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" name="partner_email" class="form-control" value="{{ $partnerInfo->partner_email }}" disabled>
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
                    <label for="">Name Of Company<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="company_name"  value="{{ $applicantInfo->company_title_name }}" disabled>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control dzongkhagdropdown select2bs4" style="width: 100%;" disabled>
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
                    <select  name="gewog_id" class="form-control gewogdropdown select2bs4" id="gewog_id" style="width: 100%;" disabled>
                      <option value=""> {{ $applicantInfo->gewog_name }}</option>

                    </select> 
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
                        <option value="{{ $applicantInfo->establishment_village_id }}"> {{ $applicantInfo->village_name }} </option>
                      </select> 
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Postal Address<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}" disabled>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Contact No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}" disabled>
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
        @include('services/fileupload/fileupload')
        <div class="row">
                  <div class="form-group col-md-5">
            <label for="">Remarks <span class="text-danger">*</span> </label>
            <textarea type="text" class="form-control" id="remarks" name="remarks" row="3" disabled></textarea>
                      <div id="remarks_error" class="text-danger"></div>
                  </div>
                  <div class="form-group col-md-5 offset-md-2">
                      <label for="">Reference No<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="reference_no" disabled>
                  </div>
              </div>
        </div>
      </div>
   
</form>
@endsection
@section('scripts')
	<script>
    $(document).ready(function(){
    $('#dob').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    $('#partner_dob').datetimepicker({
        format: 'MM/DD/YYYY',
    });
});
		function requiredRemarks(status) {
			$("#remarks_error").html('');
			if($("#remarks").val() ==""){
				if(status=="RESUBMIT"){
					$("#remarks_error").html('Please provide reason for resubmit!');
				}else{
					$("#remarks_error").html('Please provide reason for rejection!');
				}
				return false;
			}
		}
	</script>
@endsection



