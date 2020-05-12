@extends('layouts.manager')
@section('page-title','Tour Operators/Travel Agents')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name<span clas="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="applicant_name" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">CID <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="cid_no" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Designation <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="designation" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger"> *<span></label>
                            <input type="text" class="form-control required" name="email" autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Website<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control required" name="webpage_url" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Agency Name <span class="text-danger"> *</span></label>
                            <input type="text" name="company_title_name" class="form-control required" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Agency Address <span class="text-danger"> *</span></label>
                            <input type="text" name="address" class="form-control required" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">City <span class="text-danger"> *<span></label>
                                <input type="text" class="form-control required" name="city" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Country <span class="text-danger"> *</span></label>
                                <select  name="country_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                    @foreach ($countries as $country)
                                      <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for=""> From Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control required" name="from_date" id="from_date" autocomplete="off" placeholder="Select Date" readonly="true"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">To Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker required" name="to_date" id="to_date" autocomplete="off" placeholder="Select Date" readonly="true">
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Agency profile/details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Agency established</label><small class="text-danger text-right">[Year]</small>
                        <input type="date" class="form-control datepicker required" name="financial_year" autocomplete="off">
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Country<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">City<span class="text-danger">*</span> </label>
                    </div>
                </div>
                <div class="row" id="rowId">
                    <div class="form-group col-md-5">
                        <select class="form-control required" name="country[]">
                            <option value=""> - Select - </option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-md-2 ">
                        <input type="text" class="form-control required" name="city_name[]" autocomplete="off" id="room_no">
                        <span class="text-danger">{{ $errors->first('room_no') }}</span>
                    </div>
                </div>
                <div id="adddiv"></div>
                <span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i></span><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Bhutan Promotion</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Do you currently sell Destinations in Asia<span class="text-danger"> *</span></label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="radio" name="sell_destination" id="yes" value="1"><span>Yes</span>
                        <input type="radio" name="sell_destination" id="no" value="0"><span>No</span>
                    </div>
                </div>
                <div class="col-md-3 offset-md-2">
                    <div class="form-group">
                        <label for="">Do you currently sell Bhutan <span class="text-danger"> *</span></label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="radio" name="sell_bhutan" id="yes" value="1"><span>Yes</span>
                        <input type="radio" name="sell_bhutan" id="no" value="0"><span>No</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">If Yes,</label> <small class="text-danger text-right"> [Since when (year)]</small>
                        <input type="date" name="destination_year" class="form-control">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">If No,</label> <small class="text-danger text-right">[when do you intend to sell Bhutan as a destination (year) ]</small>
                        <input type="date" name="bhutan_year" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Other Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Purpose of visit </label><small class="text-danger text-right">[Please mention your purpose of visit]</small>
                        <textarea class="form-control" name="visit_purpose" rows="2" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="form-group">
                        <label>Feedback</label> <small class="text-danger text-right"> [Please share your feedback on marketing and promoting Bhutan if any]</small>
                        <textarea class="form-control" name="remarks" rows="2" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="form-group col-md-10">
                        <label>Marketing Activities</label><small class="text-danger text-right">[Please mention the marketing activities you use]</small>
                    </div>
            </div>
            <div class="row" id="addrowId1">
                <div class="col-md-10">
                    <div class="form-group">
                    <textarea class="form-control" name="activities[]" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>
            <div id="addrowmore"></div>
            <span class="btn btn-success btn-sm float-right" id="addmore"> <i class="fas fa-plus fa-sm">Add</i></span><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> Required supporting documents:</h6>
            <ol>
                <li>
                    <em>Address the application to the Director of the Tourism Council of Bhutan. Briefly mention how will this FAM trip benefit your agency and Bhutan. (In English). </em>      
                </li>
                <li>
                    <em>Proof of company (In English)</em> 
                </li>
                <li>
                    <em>Recommendation letter from the head of the company (In English) <br>
                        a.	Include designation/role of your staff visiting Bhutan 
                    </em>      
                </li>
                <li>
                    <em>Attached copy of passport </em>      
                </li>
                <li>
                    <em>Your Bhutanese tour operator partner will also have to put a forwarding letter to the Director, TCB by including details of their support</em>      
                </li>
                <li>
                    <em>All members of the approved FAM tour must meet relevant officials from the Tourism Council of Bhutan, preferably towards the end of your Bhutan visit</em>      
                </li>
            </ol>
                    @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success btn-sm"><li class="fas fa-check"></li> APPLY</button>
            <button type="reset" class="btn btn-danger btn-sm"><li class="fas fa-times"></li> RESET</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){ 
      id=1;
      $("#add").click(function(){
        $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
        $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove" onClick="removeForm('+id+')"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
        +'<div id="line'+id+'"></div>';
        $('#adddiv').append($addRow);
        id++;
      });
    });
  
    function removeForm(id){  
      if (confirm('Are you sure you want to delete this form?')){
        $('#rowId'+id).remove();
        $('#remove'+id).remove();
        $('#line'+id).remove();
      }
    }

    $(document).ready(function(){ 
      id1=1;
      $("#addmore").click(function(){
        $("#addrowId1").clone().attr('id', 'addrowId1'+id1).after("#id").appendTo("#addrowmore").find("input[type='text']").val("");
        $addRow ='<span id="remove1'+id1+'" class="btn-group" style=" margin-top:-50px; float:right">' 
        +'<span id="remove1" onClick="removeForm1('+id1+')"' 
        +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
        +'<div id="line1'+id1+'"></div>';
        $('#addrowmore').append($addRow);
        id++;
      });
    });
  
    function removeForm1(id1){  
      if (confirm('Are you sure you want to delete this form?')){
        $('#addrowId1'+id1).remove();
        $('#remove1'+id1).remove();
        $('#line1'+id1).remove();
      }
    }
$(function() {
    $('#from_date').daterangepicker({
    singleDatePicker: true,
//showDropdowns: true,
autoUpdateInput: false,

});
    $('#from_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    $('#to_date').daterangepicker({
    singleDatePicker: true,
//showDropdowns: true,
autoUpdateInput: false,
});
    $('#to_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });
    $('#c_date').daterangepicker({
    singleDatePicker: true,
//showDropdowns: true,
autoUpdateInput: false,
});
    $('#c_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    $('#cdate').daterangepicker({
    singleDatePicker: true,
//showDropdowns: true,
autoUpdateInput: false,
});
    $('#cdate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });
});

</script>
@endsection





