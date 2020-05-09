@extends('layouts.manager')
@section('page-title','Technical Clearance Registration')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title">General Information</h4>
  </div>
  <form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="" >Application Number<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control numeric-only required" name="applicant_name" value="{{ $applicantInfo->applicant_name }}">
              </div>
            </div>
          </div>
          <div class="row">
			<div class="col-md-5">
				<div class="form-group">
				  <label for="">CID No.<span class="text-danger"> *</span></label>
				  <input type="text" class="form-control numeric-only required" name="cid_no" value="{{ $applicantInfo->cid_no }}">
				</div>
			  </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Proposed location for construction.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="location" value="{{ $applicantInfo->location }}">
              </div>
            </div>
          </div>
          <div class="row">
			<div class="col-md-5">
				<div class="form-group">
				  <label for="">Dzongkhag<span class="text-danger"> *</span></label>
				  <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
					<option value=""> -Select-</option>
					@foreach ($dzongkhagLists as $dzongkhagList)
					  <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
					@endforeach
				  </select>
				</div>                                       
			  </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gewog<span class="text-danger"> *</span></label>
                <select  name="gewog_id" class="form-control select2bs4 required" id="gewog_id" value="{{ $applicantInfo->gewog_name }}" style="width: 100%;">
                </select> 
              </div>
            </div>
          </div>
          <div class="row">
			<div class="col-md-5">
				<div class="form-group">
				  <label for="">Contact No.<span class="text-danger"> *</span></label>
				  <input type="text" name="contact_no" class="form-control numeric-only" value="{{ $applicantInfo->contact_no }}">
				</div>
			  </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="number" value="{{ $applicantInfo->number }}">
			</div>
            </div>
          </div>
          <div class="row">
			<div class="col-md-5">
                <div class="form-group">
                  <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                  <input type="text" name="tentative_cons" class="form-control" value="{{ $applicantInfo->tentative_cons }}">
                </div>
              </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="tentative_com" value="{{ $applicantInfo->tentative_com }}">
              </div>
            </div>
          </div>
          <div class="row">
			<div class="col-md-5">
				<div class="form-group">
				  <label for="">Drawing submission date<span class="text-danger"> *</span></label>
				  <input type="date" class="form-control" name="drawing_date" value="{{ $applicantInfo->drawing_date }}">
				</div>
			  </div>         
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email<span class="text-danger"> *</span></label>
                <input type="email" name="email" class="form-control email" value="{{ $applicantInfo->email }}" >
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
        <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> CANCEL</button>
      </div>
    </form>
  </div>
@endsection





