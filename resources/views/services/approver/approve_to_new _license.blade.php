@extends('layouts.manager')
@section('page-title','Tour Operator License Clearance')
@section('content')
<form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Application Number<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                      </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="" >Name <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="applicant_name" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">CID No <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control numeric-only" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">DOB <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="dob" id="date_of_birth" value="{{ $applicantInfo->dob }}">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender" autocomplete="off">
                      <option value="">- Select -</option>
                      @foreach (config()->get('settings.gender') as $k => $v)
                      <option value="{{ $k }}" {{ old('gender', $applicantInfo->gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
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
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                    </select> 
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Village<span class="text-danger"> *</span></label>
                      <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                      </select> 
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Flat No.<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="applicant_flat_no" value="{{ $applicantInfo->applicant_flat_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Building No.<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="applicant_building_no" value="{{ $applicantInfo->applicant_building_no }}">
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Location<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="applicant_location" value="{{ $applicantInfo->applicant_location }}">
                  </div>
                </div>
              </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Partner’s General Information (In case of partnership)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_name" value="{{ $partnerInfo->partner_name }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">CID No.<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_cid_no" value="{{ $partnerInfo->partner_cid_no }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">DOB<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_dob" id="pdate_of_birth" value="{{ $partnerInfo->partner_dob }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gender<span class="text-danger"> *</span></label>
                    <select  class="form-control" name="partner_gender">
                      <option value="">-Select-</option>
                      @foreach (config()->get('settings.gender') as $k => $v)
                      <option value="{{ $k }}" {{ old('gender', $partnerInfo->partner_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                    </select>
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
                          <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                    </select> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Village <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_village_id" autocomplete="off" placeholder="Parmanent Address" >
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Flat No. <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="partner_flat_no" value="{{ $partnerInfo->partner_flat_no }}">
    
                  </div>
                </div>
              </div>
    
              <div class="row">
               <div class="col-md-5">
                <div class="form-group">
                  <label for="">Building No.<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="partner_building_no" value="{{ $partnerInfo->partner_building_no }}">
                </div>
              </div>
              <div class="col-md-5 offset-md-2">
                <div class="form-group">
                  <label for="">Location<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="partner_location" value="{{ $partnerInfo->partner_location }}">
                </div>
              </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Name, Address and Contact Information of the Establishment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option one]</small>
                    <input type="text" class="form-control" name="company_title_name"  value="{{ $applicantInfo->company_title_name }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option Two]</small>
                    <input type="text" class="form-control" name="company_name_one" value="{{ $applicantInfo->company_name_one }}">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name Of Company<span class="text-danger"> *</span></label><small class="text-danger text-right">[ Option Three]</small>
                    <input type="text" class="form-control" name="company_name_two"  value="{{ $applicantInfo->company_name_two }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Location<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="location" value="{{ $applicantInfo->location }}">
                  </div>
                </div>
              </div>
      
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Building No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="building_no" value="{{ $applicantInfo->building_no }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Flat No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="flat_no" value="{{ $applicantInfo->flat_no }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Postal Address<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Contact No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
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

@section('scripts')
<script>
  $(function() {

    $('.select2').select2();

    $('#pdate_of_birth').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });
    $('#pdate_of_birth').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    $('#date_of_birth').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });
    $('#date_of_birth').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });
  });

</script>
@endsection

