@extends('layouts.manager')
@section('page-title','Tour Operator Name/Ownership/Location Change')
@section('content')
<form action="{{ url('verification/tour-operator-name-owner-location-change') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}"> 
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    <input type="hidden" class="form-control" name="dispatch_no" value="{{ $applicantInfo->dispatch_no }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Application No.<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
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
              <div class="col-md-5">
                  <div class="form-group">
                    <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                  </div>
              </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                        <div class="input-group date" id="license_date" data-target-input="nearest">
                            <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
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
                  <input type="text" class="form-control" name="company_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
              </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="name" value="{{ $applicantInfo->owner_name }}">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                </div>
              </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Contact No. <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                    </div>
                  </div>
            </div>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Email <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
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
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
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
                        <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_name_one }}">
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
                        <label for="">CID No. <span class="text-danger"> *</span></label>
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

@if ($applicantInfo->application_type_id==31)
<div class="card">
  <div class="card-header">
      <h4 class="card-title">New Company Location</h4>
  </div>
  <div class="card-body">
      <div class="row">
          <div class="col-md-5">
              <div class="form-group">
                  <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                  <select  name="new_dzongkhag_id" id="new_dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
                      <option value=""> -Select-</option>
                      @foreach ($dzongkhagLists as $dzongkhagList)
                      <option value="{{ $dzongkhagList->id }}" {{ old('new_dzongkhag_id', $applicantInfo->new_dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-5 offset-md-2">
              <div class="form-group">
                  <label for="">Gewog<span class="text-danger"> *</span></label>
                  <select  name="new_gewog_id" class="form-control select2bs4 " id="new_gewog_id" style="width: 100%;">
                      <option value="">{{ $applicantInfo->new_gewog_name }} </option>
                  </select>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <div class="form-group">
                  <label for="">Village<span class="text-danger"> *</span></label>
                  <select  name="new_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                      <option value="{{ $applicantInfo->new_village_id }}">{{ $applicantInfo->new_village_name }} </option>
                  </select>
              </div>
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
        @include('services/fileupload/fileupload')
        <div class="row">
            <div class="form-group col-md-8">
                <label for="">Remarks <span class="text-danger">*</span> </label>
                <textarea type="text" class="form-control" id="remarks" name="remarks" row="3"></textarea>
                <div id="remarks_error" class="text-danger"></div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="card-footer text-center">
            <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
            <button name="status" value="RESUBMIT"  class="btn btn-warning" onclick="return requiredRemarks(this.value)"><li class="fas fa-ban"></li> RESUBMIT</button>
            <button name="status"value="REJECTED" class="btn btn-danger" onclick="return requiredRemarks()"> <li class="fas fa-times"></li> REJECT</button>
        </div>
    </div>
</div>
<form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#license_date').datetimepicker({
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

