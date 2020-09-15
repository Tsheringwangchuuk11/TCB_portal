@extends('layouts.manager')
@section('page-title','Registration of Tourist Standard Hotels')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
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
                    <select class="form-control" name="application_type_id" id="application_type_id" style="width: 100%;" readonly="true">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{ $applicationType->id }}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}> {{ $applicationType->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Star Category Type</label>
                    <select class="form-control" name="star_category_id" id="star_category_id" style="width: 100%;" readonly="true">
                        <option value="">- Select -</option>
                        @foreach ($starCategoryLists as $starCategoryList)
                        <option value="{{ $starCategoryList->id }}" {{ old('star_category_id', $applicantInfo->star_category_id) == $starCategoryList->id ? 'selected' : '' }}> {{ $starCategoryList->star_category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">License Number</label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">License Date</label>
                    <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Hotel Name </label>
                    <input type="text" class="form-control" name="tourist_standard_name"  value="{{ $applicantInfo->company_title_name }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">CID No.</label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}" autocomplete="off">
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
        <h4 class="card-title">Room Details</h4>
    </div>
    <div class="card-body">
    @php
        $total=0;
    @endphp
        <div class="row">
            <div class="form-group col-md-5">
                <label>Room Type <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Number of Room<span class="text-danger">*</span> </label>
            </div>
        </div>
        <div class="add_more_row" id="add_more_row">
            @foreach($roomInfos as $roomInfo)
            <div class="row roomtypes" id="record{{ $loop->index }}">
                <input type="hidden" class="form-control record_id" name="record_id[]" value="{{$roomInfo->id}}">
                    <div class="form-group col-md-5">
                        <select class="form-control" name="room_type_id[]" id="room_type_id1">
                            <option value=""> - Select Room - </option>
                            @foreach ($roomTypeLists as $roomTypeList)
                            <option value="{{ $roomTypeList->id }}" {{ old('room_type_id', $roomTypeList->id) == $roomInfo->room_type_id ? 'selected' : '' }}>{{ $roomTypeList->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-md-2">
                    <input type="text" class="form-control calroomtotal" name="room_no[]" value="{{$roomInfo->room_no}}" id="room_nos{{ $loop->index }}" onkeyup="TotalRoomCal()">
                    </div>
            </div>
            @if($loop->iteration>=2) 
            <span id="remove{{ $loop->index}}" onClick="removeRoom({{ $roomInfo->id }},{{ $loop->index}})" class="btn btn-danger btn-sm" style=" margin-top:-50px; float:right">
            <i class="fas fa-trash-alt fa-sm"></i> Delete</span>
            @endif
        @php
        ($total +=$roomInfo->room_no);
       @endphp    
       @endforeach
        <div id="adddiv"></div>
        <span class="btn btn-success btn-sm float-right" onclick="addMoreRoom(this)"> <i class="fas fa-plus fa-sm">Add</i></span><br>
        </div>
       
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Total number of rooms:&nbsp;<span id="room_total">{{ $total }}</span></label>
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
                    <tr>
                        <td width="1%" class="text-center">
                            <a href="#" class="delete-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                        </td>
                        <td width="15%">
                            <input type="text" name="staff_cid_no[]" value="{{$staffInfo->staff_cid_no}}" class="form-control resetKeyForNew" />
                        </td>
                        <td width="20%">
                            <input type="text" name="staff_name[]" value="{{$staffInfo->staff_name}}" class="form-control resetKeyForNew" />
                        </td>
                        <td width="15%">
                            <select class="form-control input-sm resetKeyForNew" name="staff_gender[]" >
                                <option value=""> </option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('staff_gender', $k) == $staffInfo->staff_gender ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="staff_designation[]" value="{{$staffInfo->staff_designation}}" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td>
                            <input type="text" name="qualification[]" value="{{$staffInfo->qualification}}" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td>
                            <input type="text" name="experience[]" value="{{$staffInfo->experience}}" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td width="10%">
                            <input type="text" name="salary[]" value="{{$staffInfo->salary}}" class="form-control input-sm resetKeyForNew" />
                        </td>
                        <td>
                            <select class="form-control input-sm resetKeyForNew" name="hospitility_relating[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                                <option value="{{ $k }}" {{ old('hospitility_relating', $k) == $staffInfo->hospitility_relating ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td width="1%" class="text-center">
                            <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                        </td>
                        <td width="15%">
                            <input type="text" name="staff_cid_no[]" class="form-control resetKeyForNew" />
                        </td>
                        <td width="20%">
                            <input type="text" name="staff_name[]" class="form-control resetKeyForNew" />
                        </td>
                        <td width="15%">
                            <select class="form-control input-sm resetKeyForNew" name="staff_gender[]">
                                <option value=""> </option>
                                @foreach (config()->get('settings.gender') as $k => $v)
                                <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="staff_designation[]" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td>
                            <input type="text" name="qualification[]" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td>
                            <input type="text" name="experience[]" class="form-control input-sm resetKeyForNew">
                        </td>
                        <td width="10%">
                            <input type="text" name="salary[]" class="form-control input-sm resetKeyForNew" />
                        </td>
                        <td>
                            <select class="form-control input-sm resetKeyForNew" name="hospitility_relating[]">
                                <option value=""> </option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="notremovefornew">
                        <td class="text-right" colspan="9">
                            <a href="#" class="add-table-row btn bg-purple btn-xs"><i class="fa fa-plus"></i> Add New Row</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('services.resubmit_application.resubmit_hotel_check_list')
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
                    <a href="{{ url($documentInfo->upload_url) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-link"></i> View</a>                
                </div>
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse                
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script>
        id=1;
        function addMoreRoom(this_id){
            var pId = $(this_id).parents("div.add_more_row").attr('id');
            room = $('#'+pId).find('div.roomtypes').attr('id');
            $("#"+room).clone().attr('id', room+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
            $addRow ='<span id="remove'+id+'" onClick="removeForm('+id+',room)" class="btn btn-danger btn-sm" style=" margin-top:-50px; float:right">' 
            +'<i class="fas fa-trash-alt fa-sm"></i> Delete</span>';
            $('#adddiv').append($addRow);
            $('#'+room+id).find('input.record_id').val(""); 
            id++;
        }
        function removeForm(id,room){ 
            var no_of_rooms=$('#'+room+id).find("input.calroomtotal").val();
            var total= $("#room_total").text(); 
            if (confirm('Are you sure you want to delete this form?')){
                $('#'+room).find($("#remove"+id)).remove();
                if (!isNaN(no_of_rooms)) {
                    var no_of_rooms=0;
                    var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                    $("#room_total").html(deductvalue);
                }else{
                    var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                    $("#room_total").html(deductvalue);
                }
            }
        }

        function TotalRoomCal() {
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".calroomtotal").each(function () {
                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#room_total").html(sum);
         }

         function removeRoom(roomId,rowId){
            var no_of_rooms=$('#room_nos'+rowId).val();
            var total= $("#room_total").text(); 
            if (confirm('Are you sure you want to delete this form?')){
                $.ajax({
                    url:'/application/delete-data-record',
                    type:"GET",
                    data: {
                        recordId: roomId,
                        table_name: 't_room_applications',
                    },
                success: function (data) {
                    if(data =='1'){
                        $('#record'+rowId).remove();
                        var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                       $("#room_total").html(deductvalue);
                    }else{
                        alert("Some thing went wrong");
                    }
                }
            });
           }
         }
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
</script>
@endsection
