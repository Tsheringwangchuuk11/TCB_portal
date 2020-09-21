@extends('layouts.manager')
@section('page-title','Assessment And Registration of Tented Accommodation')
@section('content')
<form action="{{ url('application/save-resubmit-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="service_name" value="{{ $applicantInfo->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $applicantInfo->module_name }}" id="module_name">
<div class="card">
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
                    <label for="">License Number</label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">License Date</label>
                    <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Hotel Name </label>
                    <input type="text" class="form-control" name="company_title_name"  value="{{ $applicantInfo->company_title_name }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">CID No.</label>
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
                    <input type="text" class="form-control" name="number" value="{{ $applicantInfo->number }}" autocomplete="off">
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
        <div class="parent_div" id="parent_div">
            @forelse ($roomInfos as $roomInfo)
                <div class="row roomtypes" id="record{{ $loop->index }}">
                    <input type="hidden" class="form-control room_record_id" name="room_record_id[]" value="{{$roomInfo->id}}">
                        <div class="form-group col-md-5">
                            <select class="form-control" name="room_type_id[]">
                                <option value=""> - Select Room - </option>
                                @foreach ($roomTypeLists as $roomTypeList)
                                <option value="{{ $roomTypeList->id }}" {{ old('room_type_id', $roomTypeList->id) == $roomInfo->room_type_id ? 'selected' : '' }}>{{ $roomTypeList->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 offset-md-2">
                        <input type="text" class="form-control calroomtotal" name="room_no[]" value="{{$roomInfo->room_no}}" onkeyup="TotalRoomCal()">
                        </div>
                </div>
                @if($loop->index >=1)
                <span id="remove{{ $loop->index }}" class="btn-group" style=" margin-top:-50px; float:right">
                    <span id="remove" onclick="removeRoom('{{ $roomInfo->id }}','{{ $loop->index }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span>
                </span>
                <div id="line{{ $loop->index }}"></div>
                @endif
                @php
                    ($total +=$roomInfo->room_no);
                @endphp       
            @empty
                <div class="row roomtypes" id="record">
                    <input type="hidden" class="form-control room_record_id" name="room_record_id[]">                    
                    <div class="form-group col-md-5">
                            <select class="form-control" name="room_type_id[]" id="room_type_id">
                                <option value=""> - Select Room - </option>
                                @foreach ($roomTypeLists as $roomTypeList)
                                <option value="{{ $roomTypeList->id }}">{{ $roomTypeList->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 offset-md-2">
                            <input type="text" class="form-control calroomtotal" name="room_no[]" id="room_no" onkeyup="TotalRoomCal()">
                        </div>
                </div>
            @endforelse
            <div id="adddiv"></div>
            <span class="btn bg-purple btn-sm float-right" onclick="addMoreRoom(this)"> <i class="fas fa-plus fa-sm"> Add New Row</i></span><br>
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
    @include('services.resubmit_application.resubmit_tented_accomm_checklist')
    <div class="card">
    <div class="card-header">
        <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>Please attach additional sheets where necessary like pictures of buildings</em>      
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group ml-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="terms" id="exampleCheck2">
                    I hereby:
                    <ol>
                        <li>
                            Confirm the accuracy of the provided data; 
                        </li>
                        <li>
                            Agree to submit upon request of the Classification Committee  additional information for classification approval/modification purposes; 
                        </li>
                        <li>
                            Apply for the assignment of <b>Tented Accommodation</b>  and verify the conformity of the accommodation establishment  to the  guideline; 
                        </li>
                        <li>
                            Agree with the terms and conditions laid down in the statutes of the TCB- classification committee and the classification procedure.
                        </li>
                    </ol>
                </div>
            </div>
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
                var parentdivId = $(this_id).parents("div.parent_div").attr('id');
                curRow = $('#'+parentdivId).find('div.roomtypes').attr('id');
                $("#"+curRow).clone().attr('id', curRow+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
                $addRow ='<span id="remove'+curRow+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
                +'<span id="remove" onClick="removeForm('+id+',curRow)"' 
                +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
                +'<div id="line'+curRow+id+'"></div>';
                $('#adddiv').append($addRow);
                $('#'+curRow+id).find('input.room_record_id').val(""); 
                id++;
            }
            function removeForm(id,curRow){ 
                var no_of_rooms=$('#'+curRow+id).find("input.calroomtotal").val();
                var total= $("#room_total").text(); 
                if (confirm('Are you sure you want to delete this form?')){
                    $('#'+curRow+id).remove();
                    $('#remove'+curRow+id).remove();
                    $('#line'+curRow+id).remove();
                    if (!isNaN(no_of_rooms)) {
                        no_of_rooms=0;
                        var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                    }else{
                        var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                    }
                    $("#room_total").html(deductvalue);
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
                var no_of_rooms=$('#record'+rowId).find("input.calroomtotal").val();
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
                            $('#remove'+rowId).remove();
                            $('#line'+rowId).remove();
                            var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                            $("#room_total").html(deductvalue);
                        }else{
                            alert("Some thing went wrong");
                        }
                    }
                });
              }
            }

            function removeStaff(rowId,staffId){
                if (confirm('Are you sure you want to delete this form?')){
                    $.ajax({
                        url:'/application/delete-data-record',
                        type:"GET",
                        data: {
                            recordId: staffId,
                            table_name: 't_staff_applications',
                        },
                    success: function (data) {
                        if(data =='1'){
                            $("#row"+rowId).remove();
                        }else{
                            alert("Some thing went wrong");
                        }
                    }
                });
            }

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
