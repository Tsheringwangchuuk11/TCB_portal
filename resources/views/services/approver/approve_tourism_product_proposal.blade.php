@extends('layouts.manager')
@section('page-title','Tourism Product Proposal')
@section('content')
<form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
@csrf
<input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
<input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Proponent Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Application Number <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="applicant_name" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">CID<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                    </div>
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
            <div class="form-group col-md-5">
                <label for="">Type <span class="text-danger">*</span> </label>
                <select  name="staff_gender" class="form-control required">
                    <option value="">---SELECT---</option>
                    @foreach (config()->get('settings.type') as $k => $v)
                    <option value="{{ $k }}" {{ old('type', $productInfo->type) == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Location <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="location" value="{{ $productInfo->location }}">
            </div>
        </div>
        <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Objective<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="objective" value="{{ $productInfo->objective }}">  
                </div> 
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Product description in detail<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="product_des" value="{{ $productInfo->product_des }}">  
                </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for=""> Project cost<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project_cost" value="{{ $productInfo->project_cost }}">  
            </div> 
            <div class="form-group col-md-5 offset-md-2">
                <label for=""> Product implementation timeline<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="timeline" value="{{ $productInfo->timeline }}">  
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
            <label for="">Contribution to tourism industry<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="contribution" value="{{ $productInfo->contribution }}">  
        </div>
        </div>
    </div>
    <div class="card-footer text-center">
      <button type="submit"class="btn btn-success btn-sm"><i class="fa fa-check fa-sm"></i> APPROVE</button>
      <button type="reset"class="btn btn-danger btn-sm"><i class="fa fa-times fa-sm"></i> CANCEL</button>
    </div>
</div>
</form>
@endsection