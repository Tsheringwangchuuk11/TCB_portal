@extends('layouts.manager')
@section('page-title','Name/Ownership/Location Change Of Tour Operators ')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label>Application Type</label>
                <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                    <option value="">- Select -</option>
                    @foreach ($applicationTypes as $applicationType)
                    <option value="{{$applicationType->id}}">{{$applicationType->dropdown_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <h5 id="oldowner" style="display: none">Previous Owner Information</h5>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" onchange="getTourOperatorDetails(this.value)">
                </div>
            </div>
            <div class="col-md-5  offset-md-2">
                <div class="form-group">
                    <label for="">License Date.<span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="license_date" id="license_date">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="old_company_title_name" id="company_title_name">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Location <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="location" id="location">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" id="owner_name">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" id="contact_no">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Owner CID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no">
                </div>
            </div>
        </div>
        <div id="name_change_info" style="display: none">
            <h5>Name Change</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of the Tour Company<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="company_title_name" id="company_title_name">
                    </div>
                </div>
            </div>
        </div>
        <div id="new_location" style="display: none">
            <h5>Location Change</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">New Location<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="company_title_name" id="company_title_name">
                    </div>
                </div>
            </div>
        </div>
        <div id="newowner" style="display:none">
            <h5>New Owner Information</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="owner_name">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No. <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="cid_no">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Address <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Contact No.<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="contact_no">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Email <span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" name="email">
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
        <ol id="ownership_change" style="display:none">
            <li>
                <em>
                Valid business license              
            </li>
            <li>  
                <em>New owner – academic transcript minimum class 10</em>
            </li>
            <li>  
                <em>iii.	cid copy for new owner</em>
            </li>
        </ol>
        <ol id="name_change" style="display:none">
            <li>
                <em>License copy</em>
            </li>
            <li>
                <em>Tax clearance copy</em>
            </li>
        </ol>
        <ol id="location_change" style="display:none">
            <li>
                <em>Valid business license</em>
            </li>
            <li>
                <em>Rental agreement with owner of house</em>
            </li>
            <li>
                <em>Tax clearance certificate</em>
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
<form>
@endsection
@section('scripts')
	<script>
		function getTourOperatorDetails(licenseNo){
			$.ajax({
				url:'/application/get-tour_operator-details/'+licenseNo,
				type: "GET",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				dataType: "json",
				success:function(data) {
					$('#company_title_name').val(data.company_name);
					$('#cid_no').val(data.cid_no);
					$('#owner_name').val(data.name);
					$('#license_date').val(data.license_date);
					$('#contact_no').val(data.contact_no);
					$('#location').val(data.location);
				} 
				});
			}
			$(document).ready(function(){
				$('#application_type').on('change',function(e) {
					var application_type=e.target.value;
					if(application_type == "1"){
						$("#newowner").show();
						$("#oldowner").show();
						$("#ownership_change").show();
						$("#name_change").hide();
						$("#new_location").hide();
						$("#name_change_info").hide();
						$("#location_change").hide();
					} 
					else if(application_type == "2"){
						$("#newowner").hide();
						$("#oldowner").hide();
						$("#ownership_change").hide();
						$("#name_change").show();
						$("#name_change_info").show();
						$("#new_location").hide();
						$("#location_change").hide();

					} 
					else if(application_type == "3"){
						$("#newowner").hide();
						$("#oldowner").hide();
						$("#ownership_change").hide();
						$("#name_change").hide();
						$("#new_location").show();
						$("#name_change_info").hide();
						$("#location_change").show();

					}
				});
		    });
	</script>
@endsection