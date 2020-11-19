@extends('layouts.manager')
@section('page-title','Tourist Standard Restuarant Assessment')
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
                    <label for="">Application No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">License Number <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">License Date <span class="text-danger">*</span> </label>
                    <div class="input-group date" id="license_date" data-target-input="nearest">
                        <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ $applicantInfo->license_date}}">
                        <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                 
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Restaurant Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Citizen ID<span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Owner <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Address <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Contact No <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Fax </label>
                    <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}">
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="webpage_url"  value="{{ $applicantInfo->webpage_url }}">
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
<div class="card">
        <div class="card-header">
             <h4 class="card-title">Staff Details</h4>
        </div>
        <div class="card-body">
            <table id="staffDetail" class="table table-condensed table-striped">
                <thead>
                    <th width="1%"  class="text-center">#</th>
                    <th width="15%">CID</th>
                    <th width="20%">Name</th>
                    <th width="15%">Gender</th>
                    <th>Designation</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th width="10%">Salary</th>
                    <th>Hospitility relating</th>
                </thead>
                <tbody>
                    @foreach ($staffInfos as $staffInfo)
                    @if ($loop->iteration==1)
                      <tr>
                        <td width="1%" class="text-center">
                            <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                        </td>
                        <td width="15%">
                            <input type="text" name="staff_cid_no[]" value="{{$staffInfo->staff_cid_no}}" class="form-control" />
                            <input type="hidden" size="1" name="staff_record_id[]" value="{{ $staffInfo->id }}">
                        </td>
                        <td width="20%">
                            <input type="text" name="staff_name[]" value="{{$staffInfo->staff_name}}" class="form-control" />
                        </td>
                        <td width="15%">
                            <select class="form-control input-sm" name="staff_gender[]" >
                                <option value=""> </option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('staff_gender', $k) == $staffInfo->staff_gender ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="staff_designation[]" value="{{$staffInfo->staff_designation}}" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="qualification[]" value="{{$staffInfo->qualification}}" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="experience[]" value="{{$staffInfo->experience}}" class="form-control input-sm">
                        </td>
                        <td width="10%">
                            <input type="text" name="salary[]" value="{{$staffInfo->salary}}" class="form-control input-sm" />
                        </td>
                        <td>
                            <select class="form-control input-sm" name="hospitility_relating[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                                <option value="{{ $k }}" {{ old('hospitility_relating', $k) == $staffInfo->hospitility_relating ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>  
                    @else
                   <tr id="row{{$loop->iteration}}">
                    <td width="1%" class="text-center">
                        <span class="btn btn-danger btn-xs" onclick="removeStaff('{{$loop->iteration}}','{{ $staffInfo->id }}')" ><i class="fas fa-times"></i></span>
                    </td>
                    <td width="15%">
                        <input type="text" name="staff_cid_no[]" value="{{$staffInfo->staff_cid_no}}" class="form-control" />
                        <input type="hidden" size="1" name="staff_record_id[]" value="{{ $staffInfo->id }}">
                    </td>
                    <td width="20%">
                        <input type="text" name="staff_name[]" value="{{$staffInfo->staff_name}}" class="form-control" />
                    </td>
                    <td width="15%">
                        <select class="form-control input-sm" name="staff_gender[]" >
                            <option value=""> </option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('staff_gender', $k) == $staffInfo->staff_gender ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="staff_designation[]" value="{{$staffInfo->staff_designation}}" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" name="qualification[]" value="{{$staffInfo->qualification}}" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" name="experience[]" value="{{$staffInfo->experience}}" class="form-control input-sm">
                    </td>
                    <td width="10%">
                        <input type="text" name="salary[]" value="{{$staffInfo->salary}}" class="form-control input-sm" />
                    </td>
                    <td>
                        <select class="form-control input-sm" name="hospitility_relating[]">
                            <option value=""> </option>
                            @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                            <option value="{{ $k }}" {{ old('hospitility_relating', $k) == $staffInfo->hospitility_relating ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                    @endif
                    @endforeach
                    @if ($staffInfos->isEmpty())
                    <tr>
                        <td width="1%" class="text-center">
                            <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                        </td>
                        <td width="15%">
                            <input type="hidden" size="1" name="staff_record_id[]">
                            <input type="text" name="staff_cid_no[]" class="form-control" />
                        </td>
                        <td width="20%">
                            <input type="text" name="staff_name[]" class="form-control" />
                        </td>
                        <td width="15%">
                            <select class="form-control input-sm" name="staff_gender[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="staff_designation[]" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="qualification[]" class="form-control input-sm">
                        </td>
                        <td>
                            <input type="text" name="experience[]" class="form-control input-sm">
                        </td>
                        <td width="10%">
                            <input type="text" name="salary[]" class="form-control input-sm" />
                        </td>
                        <td>
                            <select class="form-control input-sm" name="hospitility_relating[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                                <option value="{{ $k }}" {{ old('hospitility_relating') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endif
                    <tr class="notremovefornew">
                        <td class="text-right" colspan="9">
                            <a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@include('services.resubmit_application.resubmit_restaurant_check_list')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>Please attach additional sheets where necessary like pictures of the office</em>   
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
</form>
@endsection
@section('scripts')
<script>
     $(document).ready(function(){
        $('#license_date').datetimepicker({
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

$('input[type="checkbox"]').on('change', function(){
    if($(this).is(":checked")){ // checkbox checked
    currentRow = $(this).closest("tr");
    var currentVal=currentRow.find('.chk').val('1');
    }
    if($(this).is(":unchecked")){ // checkbox unchecked
    currentRow = $(this).closest("tr");
    var currentVal=currentRow.find('.chk').val('0');
    }
});

</script>
@endsection