@extends('layouts.enduser')
@section('page-title','Recommandation Letter for Tour operator')
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
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Recommandation Letter Type<span class="text-danger">*</span> </label>
                      <select class="form-control  select2bs4" name="application_type_id" id="application_type_id">
                        <option value="">- Select -</option>
                        @foreach ($applicationTypes as $applicationType)
                        <option value="{{$applicationType->id}}" {{ old('application_type_id', $applicantInfo->application_type_id) == $applicationType->id ? 'selected' : '' }}>{{$applicationType->dropdown_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Name of the Company<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="company_name" value="{{ $applicantInfo->company_title_name }}">
                </div>
              </div>
              <div class="col-md-5 offset-md-2">
                <div class="form-group">
                  <label for="">License No.<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">vilidity Date.<span class="text-danger">*</span> </label>
                      <div class="input-group date" id="validity_date" data-target-input="nearest">
                        <input type="text" name="validity_date" class="form-control datetimepicker-input" data-target="#validity_date" value="{{ $applicantInfo->validity_date}}">
                        <div class="input-group-append" data-target="#validity_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                     
                </div>
                </div> 
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="name" value="{{ $applicantInfo->owner_name }}">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Owner Citizen ID<span class="text-danger">*</span> </label>
                  <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                </div>
              </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Email<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <div class="card" id="visainfo" style="display:none">
    <div class="card-header">
        <h4 class="card-title">Applicant Details</h4>
    </div>
    <div class="card-body">
        <div class="parent_div" id="parent_div">
            @forelse ($partnerInfo as $partnerInfo)
                <div class="row partner" id="record{{ $loop->index }}">
                    <input type="hidden" class="form-control partner_record_id" name="partner_record_id[]" value="{{$partnerInfo->id}}">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Event Type<span class="text-danger">*</span> </label>
                                <select class="form-control" name="event_id[]" id="event_id">
                                    <option value="">- Select -</option>
                                    @foreach ($eventFairDetails as $eventFairDetail)
                                    <option value="{{ $eventFairDetail->id }}" {{ old('room_type_id', $eventFairDetail->id) == $partnerInfo->event_id ? 'selected' : '' }}>{{$eventFairDetail->event_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Citizen ID<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="partner_cid_no[]" id="partner_cid_no" value="{{$partnerInfo->partner_cid_no}}">
                            </div>
                        </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Name of the applicant<span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="partner_name[]" id="partner_name" value="{{$partnerInfo->partner_name}}">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-2">
                                <div class="form-group">
                                    <label for="">Mobile No. <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="partner_contact_no[]" id="partner_contact_no" value="{{$partnerInfo->partner_contact_no}}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Designation/Position<span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="partner_designation[]" id="partner_designation" value="{{$partnerInfo->partner_designation}}">
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-2">
                                <div class="form-group">
                                    <label for="">Passport No.<span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="partner_passport_no[]" id="partner_passport_no" value="{{$partnerInfo->partner_passport_no}}">
                                </div>
                            </div>
                </div>
                @if($loop->index >=1)
                <span id="remove{{ $loop->index }}" class="btn-group" style=" margin-top:-50px; float:right">
                    <span id="remove" onclick="removePartner('{{ $partnerInfo->id }}','{{ $loop->index }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span>
                </span>
                <div id="line{{ $loop->index }}"></div>
                @endif
            @empty
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Event Type<span class="text-danger">*</span> </label>
                            <select class="form-control" name="event_id[]" id="event_id">
                                <option value="">- Select -</option>
                                @foreach ($eventFairDetails as $eventFairDetail)
                                <option value="{{$eventFairDetail->id}}">{{$eventFairDetail->event_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Citizen ID<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="partner_cid_no[]" id="partner_cid_no">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Name of the applicant<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="partner_name[]" id="partner_name">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Mobile No. <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="partner_contact_no[]" id="partner_contact_no">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Designation/Position<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="partner_designation[]" id="partner_designation">
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group">
                            <label for="">Passport No.<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="partner_passport_no[]" id="partner_passport_no">
                        </div>
                    </div>
                </div>
            @endforelse
            <div id="adddiv"></div>
            <span class="btn bg-purple btn-sm float-right" onclick="addMore(this)"> <i class="fas fa-plus fa-sm"> Add New Row</i></span><br>
         </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol id="sample1">
                <li>
                    <em>License Copy (both sides)</em>      
                </li>
                <li>
                    <em>Passport Copy</em>      
                </li>
            </ol>
            <ol id="sample2" style="display: none">
                <li>
                    <em>License Copy (both sides)</em>      
                </li>
                <li>
                    <em>Passport Copy</em>      
                </li>
                <li>
                    <em>Invitation letter from the event organizer with sign & seal</em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
        </div>
    </div>
<form>
@endsection
@section('scripts')
    <script>
      $(document).ready(function(){
            var lettersample=$("#application_type_id").val();
            if(lettersample == "33"){
                $("#sample2").show();
                $("#sample1").hide();
                $("#visainfo").show();
            } 
            else{
                $("#sample2").hide();
                $("#sample1").show();
                $("#visainfo").hide();
            } 
        $('#validity_date').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    });
    id=1;
    function addMore(this_id){
        var parentdivId = $(this_id).parents("div.parent_div").attr('id');
        curRow = $('#'+parentdivId).find('div.partner').attr('id');
        $("#"+curRow).clone().attr('id', curRow+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
        $addRow ='<span id="remove'+curRow+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove" onClick="removeForm('+id+',curRow)"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
        +'<div id="line'+curRow+id+'"></div>';
        $('#adddiv').append($addRow);
        $('#'+curRow+id).find('input.partner_record_id').val(""); 
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

    function removePartner(roomId,rowId){
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
    </script>
@endsection
