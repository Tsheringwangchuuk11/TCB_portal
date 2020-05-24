@extends('layouts.manager')
@section('page-title','Tourist Standard Hotel Ownership Change')
@section('content')
<form action="{{ url('verification/hotel-ownership-change') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title">General Information</h4>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Application No. <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">License Number <span class="text-danger"> *</span> </label>
                            <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Registration Type</label>
                            <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                                <option value="">- Select -</option>
                                @foreach ($starCategoryLists as $starCategoryList)
                                <option value="{{ $starCategoryList->id }}" {{ old('star_category_id', $applicantInfo->star_category_id) == $starCategoryList->id ? 'selected' : '' }}> {{ $starCategoryList->star_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">License Date </label>
                            <input type="text" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Hotel Name </label>
                            <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_title_name }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Owner Name</label>
                            <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">CID No. </label>
                            <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Address </label>
                            <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Contact No. </label>
                            <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Fax </label>
                            <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Email </label>
                            <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Internet Homepage </label>
                            <input type="text" class="form-control" name="webpage_url" value="{{ $applicantInfo->webpage_url }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Number of Beds </label>
                            <input type="number" class="form-control" name="number" value="{{ $applicantInfo->number }}">
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Location </label>
                            <input type="text" class="form-control" name="location_id" value="{{ $applicantInfo->location_id }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="card">
        <div class="card-header">
             <h4 class="card-title">Document Attachment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Title</label>
                </div>
                <div class="form-group col-md-6">
                    <label>Download Files</label>
                </div>
                @forelse ($documentInfos as $documentInfo)
                <div class="form-group col-md-6">
                    <span>{{ $documentInfo->document_name }}</span>
                </div>
                <div class="form-group col-md-6">
                    <a href="{{ url($documentInfo->upload_url) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-link"></i> View</a>                
                </div>
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
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
