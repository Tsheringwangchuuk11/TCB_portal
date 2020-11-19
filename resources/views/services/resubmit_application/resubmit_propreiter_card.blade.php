@extends('layouts.manager')
@section('page-title','Propreiter Card')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
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
                                <label for="">Citizen ID<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
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
                                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
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
                                <div class="input-group date" id="validity_date" data-target-input="nearest">
                                    <input type="text" name="validity_date" class="form-control datetimepicker-input" data-target="#validity_date" value="{{ $applicantInfo->validity_date}}">
                                    <div class="input-group-append" data-target="#validity_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> 
                            </div>
                        </div>
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
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
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
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>Valid Business License </em>      
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
    <!-- card body ends -->
    <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>
</div>
</form>          
@endsection
@section('scripts')
  <script>
    $(document).ready(function(){
        $('#validity_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    });
  </script>  
@endsection







