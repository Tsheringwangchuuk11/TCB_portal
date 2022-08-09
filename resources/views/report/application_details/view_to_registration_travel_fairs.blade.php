@extends('layouts.manager')
@section('page-title','Event Registration for Travel Fairs')
@section('content')
<form action="{{ url('verification/travel_fairs') }}" method="POST" id="form_Id" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="service_id" value="{{ $applicantInfos->module_id }}">
   <input type="hidden" name="module_id" value="{{ $applicantInfos->module_id }}">
   <div class="card">
        <div class="card-header">
            <h4 class="card-title">Event Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Event Name<span class="text-danger"> *</span></label>
                        <input type="hidden" class="form-control" name="event_id" value="{{ $applicantInfos->id }}" id="eventId">
                        <input type="text" class="form-control" name="event_name" value="{{ $applicantInfos->event_name }}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                     <label for="">To country.<span class="text-danger"> *</span></label>
                     <select  name="country" class="form-control select2bs4" style="width: 100%;" disabled>
                        <option value=""> -Select-</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $country->id) == $applicantInfos->country_id ? 'selected' : '' }}>{{ $country->dropdown_name }}</option>
                        @endforeach
                     </select>
                  </div>
                </div>
            </div>
            @if ($applicantInfos->country_id ==7)
               <div class="row">
                  <div class="col-md-5">
                        <div class="form-group">
                           <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                           <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;" disabled>
                              <option value=""> -Select-</option>
                              @foreach ($dzongkhagLists as $dzongkhagList)
                              <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $applicantInfos->dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                              @endforeach
                           </select>
                        </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                           <label for="">Gewog<span class="text-danger"> *</span></label>
                           <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;" disabled>
                              <option value="">{{ $applicantInfos->gewog_name }} </option>
                           </select>
                        </div>
                  </div>
               </div>
            @endif
            <div class="row">
               @if ($applicantInfos->country_id ==80)
               <div class="col-md-5">
                  <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
                          <option value="{{ $applicantInfos->village_id }}">{{ $applicantInfos->village_name }} </option>
                      </select>
                  </div>
              </div>
            @else
              <div class="col-md-5">
               <div class="form-group">
                  <label for="">location<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="locationName"  value="{{ $applicantInfos->event_location }}" disabled>
               </div>
            </div>
            @endif
            <div class="col-md-5 offset-md-2">
               <div class="form-group">
                  <label for="">Event Start Date<span class="text-danger"> *</span></label>
                  <div class="input-group date" id="fromdate" data-target-input="nearest">
                     <input type="text" name="fromdate" class="form-control"  value="{{ $applicantInfos->start_date }}" disabled>
                 </div>
               </div>
            </div>
            </div>
            <div class="row">
               <div class="col-md-5">
                  <div class="form-group">
                     <label for="">Event End Date<span class="text-danger"> *</span></label>
                     <div class="input-group date" id="fromdate" data-target-input="nearest">
                        <input type="text" name="todate" class="form-control datetimepicker-input" data-target="#todate"  value="{{ $applicantInfos->end_date }}" disabled>
                    </div>
                  </div>
               </div>
               <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                     <label for="">Last Date Of Registration<span class="text-danger"> *</span></label>
                     <div class="input-group date" id="lastdate" data-target-input="nearest">
                        <input type="text" name="todate" class="form-control datetimepicker-input" data-target="#lastdate"  value="{{ $applicantInfos->last_date }}" disabled>
                        <div class="input-group-append" data-target="#lastdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
               </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Website<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="web_site" value="{{$applicantInfos->web_site}}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                      <label for="">Contact Person<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="contact_person" value="{{$applicantInfos->contact_person}}" disabled>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="contact_person_email" value="{{$applicantInfos->email}}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                      <label for="">Contact No<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="mobile_no" value="{{$applicantInfos->mobile_no}}" disabled>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Event Details<span class="text-danger"> *</span></label>
                    <textarea class="form-control" name="event_dtls" disabled>{{$applicantInfos->event_dtls}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="card">
      <div class="card-header">
         <h4 class="card-title">Applicant Details</h4>
      </div>
      <div class="col-md-9"></div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="" >Application Number<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{$applicantInfos->application_no }}" disabled>
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Company Type<span class="text-danger"> *</span></label>
                        <select  name="company_type" class="form-control select2bs4" style="width: 100%;" disabled>
                           <option value=""> -Select-</option>
                           @foreach ($companyTypes as $companyType)
                           <option value="{{ $companyType->id }}" {{ old('company_type', $companyType->id) == $applicantInfos->application_type_id ? 'selected' : '' }}>{{ $companyType->dropdown_name }}</option>
                           @endforeach
                        </select>
                     </div>
                   </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $applicantInfos->applicant_name }}" disabled>
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Citizen ID<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfos->cid_no }}" disabled>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" name="contact_no" class="form-control" value="{{ $applicantInfos->contact_no }}" disabled>
                     </div>
                  </div>
                  <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="email" name="email" class="form-control email" value="{{ $applicantInfos->email }}" disabled>
                     </div>
                  </div>
               </div>
               <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <label for="">Passport Number<span class="text-danger"> *</span></label>
                           <input type="text" name="passport_no" class="form-control" value="{{ $applicantInfos->number }}" disabled>
                        </div>
                     </div>
                     <div class="col-md-5 offset-md-2">
                     <div class="form-group">
                        <label for="">Company Name<span class="text-danger"> *</span></label>
                        <input type="text" name="company_name" class="form-control" value="{{ $applicantInfos->company_title_name }}" disabled>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Company Website<span class="text-danger"> *</span></label>
                        <input type="text" name="webpage_url" class="form-control" value="{{ $applicantInfos->webpage_url }}" disabled>
                     </div>
                  </div>
                  <div class="form-group col-md-5 offset-md-2">
                        <label for="">Remarks <span class="text-danger">*</span> </label>
                        <textarea type="text" class="form-control" id="remarks" name="remarks" row="3" disabled></textarea>
                        <div id="remarks_error" class="text-danger"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
@endsection
@section('scripts')
    <script>
      $(document).ready(function(){
         $('#fromdate').datetimepicker({
            format: 'DD/MM/YYYY',
         });
         $('#todate').datetimepicker({
            format: 'DD/MM/YYYY',
         });
         $('#lastdate').datetimepicker({
            format: 'DD/MM/YYYY',
         });
      });
      function requiredRemarks(status) {
        $("#remarks_error").html('');
        if($("#remarks").val() ==""){
            $("#remarks_error").html('Please provide reason for rejection!');
            return false;
           }
        }
    </script>
@endsection