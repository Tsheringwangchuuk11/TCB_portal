@extends('layouts.manager')
@section('page-title','Propreiter Card')
@section('content')
<form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="applicant_name" value="{{ $applicantInfo->applicant_name}}">
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
                                <input type="text" class="form-control" name="company_title_name" value="{{ $applicantInfo->company_title_name }}">
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
                <span><a href="{{ URL::to($documentInfo->upload_url) }}">{{ $documentInfo->document_name }}</a></span>
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
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPROVE</button>
            <a href="#" class="btn btn-danger"><li class="fas fa-times fa-sm"></li> CANCEL</a>
        </div>
    </div>
</form>          
@endsection







