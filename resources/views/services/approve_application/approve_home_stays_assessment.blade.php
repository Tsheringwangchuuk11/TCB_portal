@extends('layouts.manager')
@section('page-title','Village Home Stay Assessment')
@section('content')
<form action="{{ url('verification/village-home-stay-assessment') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $applicantInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}" id="module_id">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Personal Details</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Application No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="application_no" value="{{ old('application_no', $applicantInfo->application_no) }}" readonly="true">
					</div>
				</div>
				<div class="form-group col-md-5 offset-md-2">
                    <label>Registration Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{ $applicationType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}> {{ $applicationType->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
			  </div>
			  <div class="row">
                <div class="form-group col-md-5">
                    <label>Home Stay Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="tourist_standard_name" value="{{ old('company_title_name',$applicantInfo->company_title_name) }}">
				</div>
				<div class="col-md-5 offset-md-2">
					<div class="form-group">
					  <label for="">Name<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="owner_name" value="{{ old('applicant_name', $applicantInfo->applicant_name) }}" autocomplete="off">
					</div>
				  </div>
            </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group ">
					  <label for="">CID No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="cid_no"  value="{{ old('cid_no',$applicantInfo->cid_no) }}">
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Contact No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control" name="contact_no" value="{{ old('contact_no',$applicantInfo->contact_no) }}">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Email<span class="text-danger"> *</span></label>
					  <input type="email" class="form-control" name="email" value="{{ old('email',$applicantInfo->email) }}">
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
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
						  <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
						  <option value="">{{$applicantInfo->gewog_name}}</option>
						  </select>
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Chiwog<span class="text-danger"> *</span></label>
					<select  name="chiwog_id" class="form-control select2bs4 " id="chiwog_id" style="width: 100%;">
						<option value="{{$applicantInfo->chiwog_id}}">{{$applicantInfo->chiwog_name}}</option>
					</select>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Village <span class="text-danger"> *</span></label>
					  <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
						<option value="{{$applicantInfo->establishment_village_id}}"> {{$applicantInfo->village_name}}</option>
					</select>
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Thram No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control" name="thram_no" value="{{ old('thram_no',$applicantInfo->thram_no) }}">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">House No.<span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="house_no" value="{{ old('house_no',$applicantInfo->house_no) }}">
					</div>
				  </div>
			  </div>

		</div>
	</div>
	<div class="card">
		<div class="card-header">
			 <h4 class="card-title">Locations</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Distance from the nearest town/urban centre (hrs or kms)<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="town_distance" value="{{ $applicantInfo->town_distance }}">
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="road_distance" value="{{ $applicantInfo->road_distance }}">
				  </div>
				</div>
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
					<input type="text" class="form-control" name="condition" value="{{ $applicantInfo->condition }}">
				  </div>
				</div>
			  </div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			 <h4 class="card-title">Details Of The Family Members Residing In The Same House</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-3">
					<label>Name <span class="text-danger">*</span></label>
				</div>
				<div class="form-group col-md-3">
					<label>Relationship with the applicant <span class="text-danger">*</span></label>
				</div>
				<div class="form-group col-md-3">
					<label for="">Age <span class="text-danger">*</span> </label>
				</div>
				<div class="form-group col-md-3">
					<label>Gender <span class="text-danger">*</span></label>
				</div>
            </div>
            @foreach ($membersDetls as $membersDetl)
            <div class="row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="member_name[]" value="{{ $membersDetl->member_name }}">
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control" name="relation_type_id[]">
                        <option value="">- Select -</option>
                        @foreach ($relationTypes as $relationType)
                        <option value="{{ $relationType->id }}" {{ old('relation_type_id', $relationType->id) == $membersDetl->relation_type_id ? 'selected' : '' }}>{{ $relationType->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <input type="date" class="form-control" name="member_dob[]" autocomplete="off" value="{{ $membersDetl->member_dob }}">
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control" name="member_gender[]">
                        <option value="">- Select -</option>
                        @foreach (config()->get('settings.gender') as $k => $v)
                        <option value="{{ $k }}" {{ old('gender', $membersDetl->member_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
		</div>
	</div>
    @if ($checklistDtls->count() > 0)
	<div class="card">
		<div class="card-header">
		   <h4 class="card-title">Self Assessment Check List</h4>
		</div>
	 <div class="card-body">
    @foreach ($checklistDtls as $chapter)
    <div class="card collapsed-card">
    <div class="card-header" data-card-widget="collapse">
        <span>{{$chapter->checklist_ch_name}}</span>
        <div class="card-tools">
            <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table order-list table-bordered" id="">
                <thead>
                    <tr>
                        <td>Area</td>
                        <td>Standard</td>
                        <td>Rating</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $area = '';
                    @endphp
                    @foreach ($chapter->chapterAreas as $chapterArea)
                        @foreach ($chapterArea->checkListStandards as $checkListStandard)
                                <tr>
                                    @if ($area != $chapterArea->checklist_area)
                                    <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}">{{ $chapterArea->checklist_area }}</td>
                                    @endif
                                    <td> <input type="hidden" name="checklist_id[]" value="{{$checkListStandard->checklist_id}}">{{ $checkListStandard->checklist_standard }}</td>
                                    <td>{{ $checkListStandard->standard_code }}</td>
                                    @php
                                    $area = $chapterArea->checklist_area
                                    @endphp
                                </tr>
                        @endforeach
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
	@endforeach
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
                <div class="form-group col-md-5">
					<label for="">Remarks <span class="text-danger">*</span> </label>
					<textarea type="text" class="form-control" id="remarks" name="remarks" row="3"></textarea>
                    <div id="remarks_error" class="text-danger"></div>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Inspection Date<span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="inspection_date">
                </div>
            </div>
		</div>
		<div class="card-footer text-center">
			@if(is_null(auth()->user()->location_id))
				<button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
			@else
				<button name="status" value="VERIFIED" class="btn btn-success"><li class="fas fa-check"></li> VERIFY</button>
			@endif
			<button name="status" value="RESUBMIT"  class="btn btn-warning" onclick="return requiredRemarks(this.value)"><li class="fas fa-ban"></li> RESUBMIT</button>
			<button name="status"value="REJECTED" class="btn btn-danger" onclick="return requiredRemarks()"> <li class="fas fa-times"></li> REJECT</button>
		</div>
    </div>
</form>
@endsection
@section('scripts')
	<script>
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

