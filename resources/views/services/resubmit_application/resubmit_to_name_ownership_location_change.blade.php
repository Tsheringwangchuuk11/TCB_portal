@extends('layouts.manager')
@section('page-title','Tour Operator Name/Ownership/Location Change')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
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
                <div class="form-group col-md-5 offset-md-2">
                  <label>Application Type <span class="text-danger">*</span></label>
                  <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                      <option value="">- Select -</option>
                      @foreach ($applicationTypes as $applicationType)
                      <option value="{{ $applicationType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}> {{ $applicationType->dropdown_name }}</option>
                      @endforeach
                  </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                  <div class="form-group">
                    <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                  </div>
              </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}">
                    </div>
                </div> 
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="company_title_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
              </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
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
                      <label for="">Contact No. <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                    </div>
                  </div>
            </div>

            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Email <span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
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
@if ($applicantInfo->application_type_id==28)
    <div class="card">
        <div class="card-header">
            <h4 class="card-tile"> New Hotel Name</h4>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">New Name <span class="text-danger"> *</span> </label>
                        <input type="text" class="form-control" name="company_name_one" value="{{ $applicantInfo->company_name_one }}">
                    </div>
                </div>
        </div>
    </div>
@endif
@if ($applicantInfo->application_type_id==29)
    <div class="card">
        <div class="card-header">
            <h4 class="card-tile">New Owner Information</h4>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Owner Name <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_owner_name" value="{{ $applicantInfo->new_owner_name }}">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">CID No. <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_cid_no" value="{{ $applicantInfo->new_cid_no }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Address <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_address" value="{{ $applicantInfo->new_address }}">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="new_contact_no" value="{{ $applicantInfo->new_contact_no }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email <span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="new_email" value="{{ $applicantInfo->new_email }}">
                    </div>
                </div>
        </div>
    </div>
@endif

@if ($applicantInfo->application_type_id==31)
<div class="card">
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
                      <option value="{{ $dzongkhagList->id }}" {{ old('new_dzongkhag_id', $applicantInfo->new_dzongkhag_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-5 offset-md-2">
              <div class="form-group">
                  <label for="">Gewog<span class="text-danger"> *</span></label>
                  <select  name="new_gewog_id" class="form-control select2bs4 " id="new_gewog_id" style="width: 100%;">
                      <option value="">{{ $applicantInfo->new_gewog_name }} </option>
                  </select>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-5">
              <div class="form-group">
                  <label for="">Village<span class="text-danger"> *</span></label>
                  <select  name="new_village_id" class="form-control select2bs4" id="new_village_id" style="width: 100%;">
                      <option value="{{ $applicantInfo->new_village_id }}">{{ $applicantInfo->new_village_name }} </option>
                  </select>
              </div>
          </div>
      </div>
  </div>
</div>
@endif
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
      $(document).ready(function(){
					var application_type=$("#application_type_id").val();
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
            });
    </script>
@endsection

