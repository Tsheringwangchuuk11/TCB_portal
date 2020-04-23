@extends('layouts.manager')
@section('page-title','New : Tour Operator License Clearance')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Tour Operator License Clearance</h4>
  </div>
  <form role="form" action="{{ url('service-create/store') }}" method="POST" id="new_license" enctype="multipart/form-data">
    @csrf
    @foreach ($idInfos as $idInfo)
    <input type="hidden" name="service_id" value="{{ $idInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfo->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfo->module_name }}" id="module_name">
    @endforeach 
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h5>Personal Information</h5>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="" >Name <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="name" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">CID No <span class="text-danger"> *</span></label>
                <input type="text" class="form-control numeric-only" name="cid_no" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">DOB <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" autocomplete="off" placeholder="Select Date" readonly="true">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gender<span class="text-danger"> *</span></label>
                <select class="form-control" name="staff_gender[]" id="staff_gender">
                  <option value="">- Select -</option>
                  @foreach (config()->get('settings.gender') as $k => $v)
                  <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
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
                <select  name="location_id" class="form-control select2bs4" id="location_id" style="width: 100%;">
                </select> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Village<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="village" autocomplete="off" placeholder="Parmanent Address">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Flat No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="flat_no" autocomplete="off" placeholder="Residential Address">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Building No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="building_no" autocomplete="off" placeholder="Residential Address">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Location<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="location" autocomplete="off" placeholder="Residential Address">
              </div>
            </div>
          </div>
          <h5>Partner’s General Information</h5>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="partner_name" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">CID No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="partner_cid_no" id="cid" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">DOB<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="partner_date_of_birth" id="pdate_of_birth" autocomplete="off" placeholder="Select date" readonly="true" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Gender<span class="text-danger"> *</span></label>
                <select  name="pgender" class="form-control" name="partner_gender">
                  <option value="">-Select-</option>
                  @foreach (config()->get('settings.gender') as $k => $v)
                  <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
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
                <select  name="location_id" class="form-control select2bs4" id="location_id" style="width: 100%;">
                </select> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Village <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="partner_village" autocomplete="off" placeholder="Parmanent Address" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Flat No. <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="partner_flat_no" autocomplete="off" placeholder="Residential Address">

              </div>
            </div>
          </div>

          <div class="row">
           <div class="col-md-5">
            <div class="form-group">
              <label for="">Building No.<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="partner_building_no" autocomplete="off" placeholder="Residential Address">
            </div>
          </div>
          <div class="col-md-5 offset-md-2">
            <div class="form-group">
              <label for="">Location<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="partner_location" autocomplete="off" placeholder="Residential Address">
            </div>
          </div>
        </div>
        <h5>Company Information</h5>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Name Of Company<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_name"  autocomplete="off">
            </div>
          </div>
          <div class="col-md-5 offset-md-2">
            <div class="form-group">
              <label for="">Location<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_location" autocomplete="off">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Building No<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_building_no" rows="3" autocomplete="off">
            </div>
          </div>
          <div class="col-md-5 offset-md-2">
            <div class="form-group">
              <label for="">Flat No<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_flat_no" rows="3" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Postal Address<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_postal_address" rows="3" autocomplete="off">
            </div>
          </div>
          <div class="col-md-5 offset-md-2">
            <div class="form-group">
              <label for="">Contact No<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" name="company_contact_no" rows="3" autocomplete="off">
            </div>
          </div>
        </div>

        <h5>File Attachment<span class="text-danger"> *</span></h5>
        <strong> Required supporting documents:</strong>
        <ol>
          <li>
            <em>Copy of Citizenship Identity Card</em>      
          </li>

          <li>
            <em>Security Clearance Certificate</em>      
          </li>

          <li>
            <em>CV/academic transcript of the applicant or the person who intends to manage the business</em>      
          </li>

          <li>
            <em>Copy of Lease Agreement/Undertaking letter from the Landlord for office space or ownership certificate in case of own building</em>      
          </li>

          <li>
            <em>Declaration signed by the applicant that he/she is not a Civil Servant, employee of a Government Controlled Organization or Corporate Body as set out in Annexure A of TRR 2017 </em>      
          </li>
        </ol>
        @include('services/fileupload/fileupload')
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
    <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
  </div>
</form>
</div>
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

