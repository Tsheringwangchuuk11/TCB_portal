@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Assessment')
@section('content') 
<form action="{{ url('verification/restaurant-assessment') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $applicantInfo->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}" id="module_id">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
<div class="card">
	<div class="card-header">
		 <h4 class="card-title">General Information</h4>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Application No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" disabled>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">License Number <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License Date <span class="text-danger">*</span> </label>
                    <div class="input-group date" id="license_date" data-target-input="nearest">
                        <input type="text" name="license_date" class="form-control" value="{{ $applicantInfo->license_date}}" disabled>
                    </div>                
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Restaurant Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="tourist_standard_name" value="{{ $applicantInfo->company_title_name }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Citizen ID<span class="text-danger">*</span> </label>
                <input type="text" class="form-control numeric-only" name="cid_no" value="{{ $applicantInfo->cid_no }}" disabled>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Owner <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Address <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}" disabled>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Fax </label>
                    <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}" disabled>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}" disabled>
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url"  value="{{ $applicantInfo->webpage_url }}" disabled>
                </div>
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
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;" disabled>
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
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;" disabled>
                        <option value="">{{ $applicantInfo->gewog_name }} </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
                        <option value="{{ $applicantInfo->establishment_village_id }}">{{ $applicantInfo->village_name }} </option>
                    </select>
                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $area = '';
                            $total=0;
                            $scorepointtotal=0;
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
                                            <td><input type="text" size="4" name="assessor_score_point[]" value="{{ $checkListStandard->assessor_score_point}}" class="txt"></td>
                                            @php
                                            $area = $chapterArea->checklist_area;
                                            ($total +=$checkListStandard->checklist_pts);
                                            ($scorepointtotal +=$checkListStandard->assessor_score_point);
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
		 <h4 class="card-title">Assessment Points</h4>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Total:{{ $total }}</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Minimum Marks for Approval: 330 </label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
            <label for="">Score Points:<span id="scorepoint">{{ $scorepointtotal}}</span></label>
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
                <textarea type="text" class="form-control" id="remarks" name="remarks" row="3" disabled></textarea>
                <div id="remarks_error" class="text-danger"></div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Inspection Date<span class="text-danger">*</span> </label>
                <div class="input-group date" id="inspection_date" data-target-input="nearest">
                    <input type="text" name="inspection_date" class="form-control" disabled>
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
    $('#license_date').datetimepicker({
        format: 'DD/MM/YYYY',
    });
    $('#inspection_date').datetimepicker({
        format: 'DD/MM/YYYY',
    });
});
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
 //$("#scorepoint").html(sum.toFixed(2));
  $("#scorepoint").html(sum);
}
$("table").on("keyup", ".txt", function () {
    calculateScorePoint();
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