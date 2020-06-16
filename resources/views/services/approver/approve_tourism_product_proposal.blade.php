@extends('layouts.manager')
@section('page-title','Tourism Product Proposal')
@section('content')
<form action="{{ url('verification/product-proposal') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name }}">
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
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Registration No<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="registration_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Receipt Date<span class="text-danger">*</span> </label>
                        <input type="date" class="form-control" name="receipt_date">
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
                <select  name="type" class="form-control required">
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
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Remarks <span class="text-danger">*</span> </label>
                <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"><li class="fas fa-times"></li> REJECT</button>
    </div>
</div>
<div class="modal fade" id="confirmModal">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Message</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Are you sure,you want to reject &hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button name="status"value="REJECTED" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection