@extends('layouts.manager')
@section('page-title','Assessment And Registration of Tented Accommodation')
@section('content')
<form action="{{ url('verification/tented-accommdation-assessment') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    @php
        $scorepointtotal=0;
        $ratingpointtotal=0;
    @endphp
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Application No.</label>
                    <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
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
                    <label for="">License Number</label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">License Date</label>
                    <div class="input-group date" id="license_date" data-target-input="nearest">
                        <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
                        <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Hotel Name </label>
                    <input type="text" class="form-control" name="tourist_standard_name"  value="{{ $applicantInfo->company_title_name }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Citizen ID</label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Contact No </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}" autocomplete="off">
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Manager Name<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="manager_name" value="{{ $applicantInfo->manager_name }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for=""> Manager Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="manager_mobile_no" value="{{ $applicantInfo->manager_mobile_no }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Fax </label>
                    <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Email</label>
                    <input type="email" class="form-control email" name="email" value="{{ $applicantInfo->email }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Internet Homepage</label>
                    <input type="text" class="form-control" name="webpage_url" value="{{ $applicantInfo->webpage_url }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Beds</label>
                    <input type="text" class="form-control numeric-only" name="bed_no" value="{{ $applicantInfo->number }}" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">Hotel Location</h4>
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
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Room Details</h4>
        </div>
        <div class="card-body">
            @php
                $total=0;
            @endphp
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Room Type</label>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Room</label>
                </div>
            </div>
            @forelse ($roomInfos as $roomInfo)
            <div class="row">
                <div class="form-group col-md-5">
                    <select class="form-control" name="room_type_id[]" id="room_type_id">
                        <option value=""> - Select Room - </option>
                        @foreach ($roomTypeLists as $roomTypeList)
                        <option value="{{ $roomTypeList->id }}" {{ old('room_type_id', $roomTypeList->id) == $roomInfo->room_type_id ? 'selected' : '' }}>{{ $roomTypeList->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <input type="text" class="form-control" name="room_no[]" value="{{$roomInfo->room_no}}" autocomplete="off">
                </div>
            </div>
            @php
            ($total +=$roomInfo->room_no);
           @endphp    
            @empty
            <div class="form-group col-md-12">
                <p>No data availlable</p>
            </div>
            @endforelse
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Total number of rooms:&nbsp;{{ $total }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Staff Details</h4>
        </div>
        <div class="card-body">
            <table id="staffDetail" class="table table-bordered table-hover">
                <thead>
                    <th class="text-center">#</th>
                    <th>CID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Salary</th>
                    <th>Hospitility relating</th>
                </thead>
                <tbody>
                    @foreach ($staffInfos as $staffInfo)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <input type="hidden" name="staff_cid_no[]" value="{{$staffInfo->staff_cid_no}}"> {{ $staffInfo->staff_cid_no }}
                            </td>
                            <td>
                                <input type="hidden" name="staff_name[]"  value="{{$staffInfo->staff_name}}"> {{ $staffInfo->staff_name }}
                            </td>
                            <td>
                                <input type="hidden" name="staff_gender[]"  value="{{$staffInfo->staff_gender}}"> 
                                @if ($staffInfo->staff_gender==='F')
                                    Female
                                @else
                                    Male
                                @endif
                            </td>
                            <td>
                                <input type="hidden" name="designation[]" value="{{$staffInfo->staff_designation}}"> {{ $staffInfo->staff_designation }}
                            </td>
                            <td>
                                <input type="hidden" name="qualification[]" value="{{$staffInfo->qualification}}"> {{ $staffInfo->qualification }}
                            </td>
                            <td>
                                <input type="hidden" name="experience[]" value="{{$staffInfo->experience}}"> {{ $staffInfo->experience }}
                            </td>
                            <td>
                                <input type="hidden" name="salary[]" value="{{$staffInfo->salary}}"> {{ $staffInfo->salary }}
                            </td>
                            <td>
                                <input type="hidden" name="hospitility_relating[]" value="{{$staffInfo->hospitility_relating}}"> 
                                @if ($staffInfo->hospitility_relating==="Y" )
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                         </tr>
                    @endforeach
                </tbody>
             </table>
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
                                    <td>Score points</td>
                                    <td>Assessor’s score point</td>
                                    <td>5* Tented rating</td>
                                    <td>Assessor’s 5* Tented rating</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $area = '';
                                @endphp
                                @foreach ($chapter->chapterAreas as $chapterArea)
                                    @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                            @php
                                                $standardlengh=$checkListStandard->count();
                                            @endphp
                                            <tr>
                                                @if ($area != $chapterArea->checklist_area)
                                                <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}"> {{ $chapterArea->checklist_area }} </td>
                                                @endif
                                                <td><input type="hidden" name="checklist_id[]" value="{{ $checkListStandard->checklist_id }}">{{ $checkListStandard->checklist_standard }}</td>
                                                <td>{{ $checkListStandard->checklist_pts }}</td>
                                                <td> @if ($checkListStandard->assessor_score_point===0)
                                                    <input type="hidden" size="4" name="checklist_pts[]" value="{{ $checkListStandard->assessor_score_point }}" class="txt">
                                                @else
                                                    <input type="text" size="4" name="checklist_pts[]" value="{{ $checkListStandard->assessor_score_point }}" class="txt">
                                                @endif
                                                   </td>
                                                <td>{{ $checkListStandard->standard_code }}</td>
                                                <td>
                                                    @if ($checkListStandard->assessor_rating===0)
                                                    <input type="hidden" size="4" name="ratingpoint[]" value="{{ $checkListStandard->assessor_rating }}" class="bstxt"> 
                                                    @else
                                                    <input type="text" size="4" name="ratingpoint[]" value="{{ $checkListStandard->assessor_rating }}" class="bstxt">  
                                                    @endif
                                                </td>
                                                @php
                                                $area = $chapterArea->checklist_area;
                                                ($scorepointtotal +=$checkListStandard->assessor_score_point);
                                                ($ratingpointtotal +=$checkListStandard->assessor_rating);
                                                @endphp 
                                            </tr>
                                    @endforeach  
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                        <button type="button" class="btn btn-tool float-right" data-card-widget="collapse">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
     </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Score Points and Basic Standards(B + B*) Details</h4>
        </div>
        <div class="card-body">
			<div class="row">
				<div class="form-group col-md-5">
					<label for="">
                        Number of Score Points	(250-370)				
                        <span id="scorepoint">: &nbsp;{{ $scorepointtotal }}</span>			
					</label>
                </div>
				<div class="form-group col-md-5 offset-md-2">
					<label for=""> 
                        Number of Bs (Basic standards 132/136)
                        <span id="bspoints">:&nbsp;{{ $ratingpointtotal }}</span>
					</label>
				</div>
			</div>
        </div>
	</div>
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
                    <div class="input-group date" id="inspection_date" data-target-input="nearest">
                        <input type="text" name="inspection_date" class="form-control datetimepicker-input" data-target="#inspection_date">
                        <div class="input-group-append" data-target="#inspection_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                
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
</form>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('#license_date').datetimepicker({
        format: 'DD/MM/YYYY',
    });
    $('#inspection_date').datetimepicker({
        format: 'DD/MM/YYYY',
    });
});
function validatedate(){
    var num = $("#validaty_date").val();
    var f = new Date(num);
  	 f.setFullYear (f.getFullYear() + 3 )
     var x=  f.toLocaleDateString('en-US',{day:"2-digit",month:"2-digit",year:"numeric"})
     $('#validaty_date').val(x);
}
function calculateScorePoint() {
    var sum = 0;
    //iterate through each textboxes and add the values
    $(".txt").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
 $("#scorepoint").html(sum);
}
$("table").on("keyup", ".txt", function () {
    calculateScorePoint();
});

function calculateBsPoint() {
    var sum = 0;
    //iterate through each textboxes and add the values
    $(".bstxt").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
 $("#bspoints").html(sum);
}
$("table").on("keyup", ".bstxt", function () {
    calculateBsPoint();
});
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
