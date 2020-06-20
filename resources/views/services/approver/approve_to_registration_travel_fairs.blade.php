@extends('layouts.manager')
@section('page-title','Event Registration for Travel Fairs')
@section('content')
<form action="{{ url('verification/travel_fairs') }}" method="POST" id="form_Id" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="service_id" value="{{ $applicantInfo->module_id }}">
   <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Event Details</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="" >Event Name<span class="text-danger"> *</span></label>
                        <input type="hidden" class="form-control" name="event_id" value="{{ $applicantInfo->event_id }}">
                        <input type="text" class="form-control" name="event_name" value="{{ $applicantInfo->event_name }}">
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">To country.<span class="text-danger"> *</span></label>
                        <select  name="country" class="form-control select2bs4" style="width: 100%;">
                           <option value=""> -Select-</option>
                           @foreach ($countries as $country)
                           <option value="{{ $country->id }}" {{ old('country_id', $country->id) == $applicantInfo->country_id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">location<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="locationName"  value="{{ $applicantInfo->location }}">
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Event Start Date<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="fromdate"  value="{{ $applicantInfo->start_date }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Event End Date<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="todate"  value="{{ $applicantInfo->end_date }}">
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Last Date Of Registration<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="lastdate"  value="{{ $applicantInfo->last_date }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="">Event Details<span class="text-danger"> *</span></label>
                        <textarea class="form-control" name="event_dtls">{{ $applicantInfo->event_dtls }}</textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card">
      <div class="card-header">
         <h4 class="card-title">Tour Operators Details</h4>
      </div>
      <div class="col-md-9"></div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="" >Application Number<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{$applicantInfo->application_no }}" readonly="true">
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">CID No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" name="contact_no" class="form-control numeric-only" value="{{ $applicantInfo->contact_no }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="email" name="email" class="form-control email" value="{{ $applicantInfo->email }}" >
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Company Name<span class="text-danger"> *</span></label>
                        <input type="text" name="company_name" class="form-control" value="{{ $applicantInfo->company_title_name }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Date Of Registration<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="date_of_registration" value="{{ $applicantInfo->date }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="">Remarks <span class="text-danger">*</span> </label>
                     <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer text-center">
         <button name="status" value="APPROVED" class="btn btn-success">
            <li class="fas fa-check"></li>
            APPROVE
         </button>
         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
            <li class="fas fa-times"></li>
            REJECT
         </button>
      </div>
   </div>
</form>
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
@endsection