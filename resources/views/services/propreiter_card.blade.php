@extends('layouts.manager')
@section('page-title','Propreiter Card')
@section('content')
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title"> Propertetor Card Form </h4>
    </div>
    <form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
     @csrf
     <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
     <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
     <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
     <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="" >Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">CID No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control numeric-only required" name="cid_no" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Company Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="company_name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Trade License No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="license_no" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label  for="">Phone No.<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control numeric-only required" name="contact_no" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">validity Date<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="validity_date" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label  for="">Office Location<span class="text-danger"> *</span></label>
                                <input type="text" name="proposed_location" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <h5>File Attachment<span class="text-danger"> *</span></h5>
                    <strong>Required supporting documents:</strong>
                            <ol>
                                <li>
                                    <em>Valid Trade License </em>      
                                </li>
                                <li>
                                    <em>Valid NOC</em>
                                </li>
                                <li>
                                    <em>BIT clearance </em>      
                                </li>
                                <li>
                                    <em>CID copy </em>      
                                </li>
                            </ol>
                            @include('services/fileupload/fileupload')
                    </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success btn-sm"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger btn-sm"><li class="fas fa-times"></li> RESET</button>
        </div>
    </form>
</div>          
@endsection







