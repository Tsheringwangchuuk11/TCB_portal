@extends('layouts.manager')
@section('page-title','Propreiter Card')
@section('content')
<form action="{{ url('verification/proprieter-card') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Propertetor Card Form </h4>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="" >Application Number<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">CID No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control numeric-only" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Company Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="company_name" value="{{ $applicantInfo->company_title_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Trade License No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="">Phone No.<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control numeric-only" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $applicantInfo->email }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">validity Date<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="validity_date" value="{{ $applicantInfo->validity_date }}">
                            </div>
                        </div>
                    </div>
                    <div cLass="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="">Office Location<span class="text-danger"> *</span></label>
                                <input type="text" name="location" class="form-control" value="{{ $applicantInfo->location }}">
                            </div>
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







