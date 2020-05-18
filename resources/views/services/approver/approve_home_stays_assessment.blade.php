@extends('layouts.manager')
@section('page-title','Village Home Stay Assessment')
@section('content')
<form action="{{ url('verification/village-home-stay-assessment') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
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
					  <input type="text" class="form-control numeric-only" name="cid_no"  value="{{ old('cid_no',$applicantInfo->cid_no) }}" autocomplete="off">
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Contact No.<span class="text-danger"> *</span> </label>
					<input type="text" class="form-control numeric-only required" name="contact_no" value="{{ old('contact_no',$applicantInfo->contact_no) }}" autocomplete="off">
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Email</label>
					  <input type="email" class="form-control email" name="email" value="{{ old('email',$applicantInfo->email) }}" autocomplete="off">
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
							  <option value=""> -Select-</option>
	  
						  </select>                
					</div>
				  </div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Chiwog<span class="text-danger"> *</span></label>
					<select  name="chiwog_id" class="form-control select2bs4" id="chiwog_id" style="width: 100%;">
						<option value=""> -Select-</option>
					</select>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-5">
					<div class="form-group">
					  <label for="">Village <span class="text-danger"> *</span></label>
					  <input type="text" class="form-control" name="village_id">
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
					<input type="text" class="form-control required" name="town_distance" value="{{ $applicantInfo->house_no }}">
				  </div>
				</div>
				<div class="col-md-5 offset-md-2">
				  <div class="form-group">
					<label for="">Distance from the main road (hrs or kms)<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="road_distance" value="{{ $applicantInfo->road_distance }}">
				  </div>
				</div>
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">Condition of the pathway to house from the road point<span class="text-danger"> *</span></label>
					<input type="text" class="form-control required" name="condition" value="{{ $applicantInfo->condition }}">
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
                    <select class="form-control" name="relation_type_id[]" id="hotel_div_id">
                        <option value="">- Select -</option>
                        @foreach ($relationTypes as $relationType)
                        <option value="{{ $relationType->id }}" {{ old('relation_type_id', $relationType->id) == $membersDetl->relation_type_id ? 'selected' : '' }}>{{ $relationType->relation_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="member_age[]" autocomplete="off" value="{{ $membersDetl->member_age }}">
                </div>
                <div class="form-group col-md-2">
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
    <h5>Checklist</h5>
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
    @endif
	<div class="card">
		<div class="card-header">
			 <h4 class="card-title">File Attachment</h4>
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
                <div class="form-group col-md-5">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Inspection Date<span class="text-danger">*</span> </label>
                    <input type="date" class="form-control" name="inspection_date">
                </div>
            </div>
		</div>
		<div class="card-footer text-center" >
            <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"><li class="fas fa-times"></li> REJECT</button>
	    </div>
    </div>
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
</form>
@endsection
