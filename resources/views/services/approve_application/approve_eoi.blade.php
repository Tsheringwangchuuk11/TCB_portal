@extends('layouts.manager')
@section('page-title','EOI')
@section('content')
<form action="{{ url('verification/eoi') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Proponent Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Application No.<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Name<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Citizen ID<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                    </div>
                </div> 
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Email<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Contact No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Addresss <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
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
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Product Type<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="product_type" value="{{ $productInfo->product_type }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Implementing modality <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="modality" value="{{ $productInfo->modality }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Product Summary <span class="text-danger">*</span> </label>
                      <textarea class="form-control" name="product_des" rows="3">{{ $productInfo->product_des }}</textarea>
                    </div>
                </div> 
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Activities and/or results framework <span class="text-danger">*</span> </label>
                    <textarea class="form-control" name="activities_results" rows="3"> {{ $productInfo->activities_results }}</textarea>
                  </div>
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
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $productInfo->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value="">{{ $productInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $productInfo->village_id }}">{{ $productInfo->village_name }} </option>
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

