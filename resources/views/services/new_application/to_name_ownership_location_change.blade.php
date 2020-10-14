@extends('layouts.manager')
@section('page-title','Tour Operator Name/Ownership/Location Change ')
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
                    <input type="date" class="form-control" name="license_date" id="license_date" readonly="true">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" id="company_title_name" readonly="true">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" id="owner_name" readonly="true">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" id="contact_no" readonly="true">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Owner CID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" readonly="true">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="email" id="email" readonly="true">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Company location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="gewog_name" id="gewog_name" readonly="true">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="village_name" id="village_name" readonly="true">
                    <input type="hidden" class="form-control" name="establishment_village_id" id="village_id">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card"  id="ownership_change_info" style="display: none">
    <div class="card-header">
        <h4 class="card-tile">New Owner Information</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_owner_name">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No. <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_cid_no">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Address <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_address">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Contact No.<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="new_contact_no">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Email <span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" name="new_email">
                </div>
            </div>
    </div>
</div>
<div class="card"  id="name_change_info" style="display: none">
    <div class="card-header">
        <h4 class="card-tile"> New Company Name</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">New Name <span class="text-danger"> *</span> </label>
                    <input type="text" class="form-control" name="company_name_one">
                </div>
            </div>
    </div>
</div>
<div class="card" id="location_change_info" style="display:none">
    <div class="card-header">
        <h4 class="card-title">New Company Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="new_dzongkhag_id" id="new_dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('new_dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="new_gewog_id" class="form-control select2bs4" id="new_gewog_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="new_village_id" class="form-control select2bs4" id="new_village_id" style="width: 100%;">
                        <option value=""> -Select-</option>
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
        $(document).ready(function () {
                $('#new_dzongkhag_id').on('change',function(e) {
                    var dzongkhag_id = e.target.value;
                    if(dzongkhag_id){
                        $("#new_gewog_id option:gt(0)").remove();	
                        $.ajax({			   
                                url:'/json-dropdown',
                                type:"GET",
                                data: {
                                    table_name: 't_gewog_masters',
                                        id: 'id',
                                        name: 'gewog_name',
                                    parent_id: dzongkhag_id,
                            parent_name_id: 'dzongkhag_id'					 
                            },
                            success:function (data) {
                            $.each(data, function(key, value) {
                                $('select[name="new_gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                            }
                        });
                    }else{
                        $("#new_gewog_id option:gt(0)").remove();	
                        $("#new_village_id option:gt(0)").remove();
                    }		 
                });

            $('#new_gewog_id').on('change',function(e) {
                var gewog_id = e.target.value;
                if(gewog_id){
                    $("#new_village_id option:gt(0)").remove();	
                    $.ajax({			   
                            url:'/json-dropdown',
                            type:"GET",
                            data: {
                                table_name: 't_village_masters',
                                    id: 'id',
                                    name: 'village_name',
                                parent_id: gewog_id,
                        parent_name_id: 'gewog_id'					 
                        },
                        success:function (data) {
                        $.each(data, function(key, value) {
                            $('select[name="new_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        }
                    });
                }else{
                    $("#new_village_id option:gt(0)").remove();	
                }		 
            });
        })
	 	function getTourOperatorDetails(licenseNo){
			$.ajax({
				url:'/application/get-hotel-details/'+licenseNo,
				type: "GET",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				dataType: "json",
				success:function(data) {
					$('#company_title_name').val(data.tourist_standard_name);
					$('#cid_no').val(data.cid_no);
					$('#owner_name').val(data.owner_name);
					$('#license_date').val(data.license_date);
                    $('#contact_no').val(data.contact_no);
                    $('#email').val(data.email);
                    $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                    $('#gewog_name').val(data.gewog_name);
                    $('#village_name').val(data.village_name);
                    $('#village_id').val(data.village_id);
				} 
				});
			} 
			$(document).ready(function(){
				$('#application_type_id').on('change',function(e) {
					var application_type=e.target.value;
					if(application_type == "28"){
                        $("#name_change_info").show();
                        $("#ownership_change_info").hide();
                        $("#location_change_info").hide();
                        $("#name_change").show();
                        $("#ownership_change").hide();
                        $("#location_change").hide();
					}
					else if(application_type == "29"){
                        $("#name_change_info").hide();
                        $("#ownership_change_info").show();
                        $("#location_change_info").hide();
                        $("#name_change").hide();
                        $("#ownership_change").show();
                        $("#location_change").hide();

					} 
					else if(application_type == "31"){
                        $("#name_change_info").hide();
                        $("#ownership_change_info").hide();
                        $("#location_change_info").show();
                        $("#name_change").hide();
                        $("#ownership_change").hide();
                        $("#location_change").show();
					}
				});
            });
	</script>
@endsection