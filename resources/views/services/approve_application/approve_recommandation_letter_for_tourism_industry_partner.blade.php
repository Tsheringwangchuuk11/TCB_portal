@extends('layouts.manager')
@section('page-title','Recommandation Letter for Tour operator')
@section('content')
<form action="{{ url('verification/rec_letter_tourism_industry-partner') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Application No.<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Recommandation Letter Type<span class="text-danger">*</span> </label>
                      <select class="form-control  select2bs4" name="application_type_id" id="letter_sample">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{$applicationType->id}}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}>{{$applicationType->dropdown_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Name of the Company<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="company_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
              </div>
              <div class="col-md-5 offset-md-2">
                <div class="form-group">
                  <label for="">License No.<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">vilidity Date.<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}">
                    </div>
                </div> 
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="name" value="{{ $applicantInfo->owner_name }}">
                  </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Owner CID<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                </div>
              </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Email<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                    </div>
                  </div>
            </div>
        </div>
    </div>
    @if ($partnerInfo->count()> 0)
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Applicant Details</h4>
        </div>
        <div class="card-body">
            <table id="datatableId" class="table table-bordered table-hover">
                <thead>
                    <th class="text-center">#</th>
                    <th>CID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Phone No.</th>
                    <th>Passport No.</th>
                    <th>Event Name</th>
                    <th>Country</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                </thead>
                <tbody>
                    @foreach ($partnerInfo as $partnerInfo)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                               {{ $partnerInfo->partner_cid_no }}
                            </td>
                            <td>
                              {{ $partnerInfo->partner_name }}
                            </td>
                            <td>
                              {{ $partnerInfo->partner_designation}}
                            </td>
                            <td>
                              {{ $partnerInfo->partner_contact_no}}
                            </td>
                            <td>
                              {{ $partnerInfo->partner_passport_no}}
                            </td>
                            <td>
                              {{ $partnerInfo->event_name}}
                            </td>
                            <td>
                              {{ $partnerInfo->dropdown_name}}
                            </td>
                            <td>
                              @if ($partnerInfo->country_id==7)
                             {{ $partnerInfo->dzongkhag_name}},
                             {{ $partnerInfo->gewog_name}},
                             {{ $partnerInfo->village_name}}
                              @else
                              {{ $partnerInfo->event_location}}
                              @endif
                            </td>
                              <td>{{ date_format(date_create($partnerInfo->start_date), "F jS Y") }} to {{ date_format(date_create($partnerInfo->end_date), "F jS Y") }}</td>
                         </tr>
                    @endforeach
                </tbody>
             </table>
        </div>
    </div>
        
    @endif
    <div class="card">
      <div class="card-header">
           <h4 class="card-title">File Attachment</h4>
      </div>
      <div class="card-body">
          @include('services/fileupload/fileupload')
          <div class="row">
              <div class="form-group col-md-8">
                  <label for="">Remarks <span class="text-danger">*</span> </label>
                  <textarea type="text" class="form-control" id="remarks" name="remarks" row="3"></textarea>
                  <div id="remarks_error" class="text-danger"></div>
              </div>
          </div>
      </div>
      <div class="card-footer text-center">
          <div class="card-footer text-center">
              <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
              <button name="status" value="RESUBMIT"  class="btn btn-warning" onclick="return requiredRemarks(this.value)"><li class="fas fa-ban"></li> RESUBMIT</button>
              <button name="status"value="REJECTED" class="btn btn-danger" onclick="return requiredRemarks()"> <li class="fas fa-times"></li> REJECT</button>
          </div>
      </div>
    </div>
<form>
@endsection
@section('scripts')
    <script>
       $(document).ready(function(){
        $('#datatableId').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
            });
    })
        function requiredRemarks(status) {
        $("#remarks_error").html('');
        if($("#remarks").val() ==""){
            if(status=="RESUBMIT"){
                $("#remarks_error").html('Please provide reason for resubmit!');
            }else{
                $("#remarks_error").html('Please provide reason for rejection!');
            }
            return false;
          }
        }
    </script>
@endsection
