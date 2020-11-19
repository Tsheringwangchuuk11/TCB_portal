@extends('layouts.manager')
@section('page-title','Bhutan Media Familarization')
@section('content')
<form action="{{ url('verification/fam') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">

    <input type="hidden" class="form-control" name="fam_type" value="F">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Application Number<span clas="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Name<span clas="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $applicantInfo->applicant_name }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Citizen ID <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="agent_cid_no" value="{{ $applicantInfo->cid_no }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Designation <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="designation" value="{{ $applicantInfo->designation }}">
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Email <span class="text-danger"> *<span></label>
                                <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}">
                            </div>
                        </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Website<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="website" value="{{ $applicantInfo->webpage_url }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Agency Name <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_name" class="form-control" value="{{ $applicantInfo->company_title_name }}">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Agency Address <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_address" class="form-control" value="{{ $applicantInfo->address }}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">City <span class="text-danger"> *<span></label>
                                    <input type="text" class="form-control" name="city" value="{{ $applicantInfo->city }}">
                                </div>
                            </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Country <span class="text-danger"> *</span></label>
                                <select  name="country_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                    @foreach ($countries as $country)
                                      <option value="{{ $country->id }}" {{ old('country_id', $country->id) == $applicantInfo->country_id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> From Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control" name="from_date" value="{{ $applicantInfo->from_date }}"> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">To Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker" name="to_date" value="{{ $applicantInfo->to_date }}">
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Agency Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" >
                    <table  class="table table-bordered">
                        <thead>
                            <tr>        
                                <td>Channel</td>
                                <td>Name </td>
                                <td>Circulation</td>
                                <td>Target Audience</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($channelTypesInfos as $channelTypesInfo)
                            <tr>        
                                <td>{{ $channelTypesInfo->channel_type}}</td>
                                <td>
                                <input type='hidden' name='channel_type_id[]' value="{{ $channelTypesInfo->channel_type_id }}" class='form-control'>
                                <input type='text' name='channel_name[]' value="{{ $channelTypesInfo->channel_name }}" class='form-control'>
                                </td>
                                <td><input type='text' name='circulation[]' value="{{ $channelTypesInfo->circulation }}" class='form-control'></td>
                                <td><input type='text' name='target_audience[]' value="{{ $channelTypesInfo->target_audience }}" class='form-control'></td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Bhutan Coverage & Distribution Channel</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">                            
                    <table class="table table-bordered table-sm" id="dataTable"> 
                        <tbody> 
                            <tr>        
                                <td>Mention all area/topic of Bhutan coverage</td>
                                <td>Channel Name </td>
                                <td>Channel Link </td>
                                <td>Channel Type</td>
                                <td>Intended Date of Feature </td>
                            </tr>
                            @forelse ($channelCoverages as $channelCoverage)
                            <tr>
                            <td><input  type="text"  class="form-control" name="area_coverage[]" value="{{ $channelCoverage->area_coverage }}"></td>
                                <td><input type="text" class="form-control" name="channel[]" value="{{ $channelCoverage->channel_name }}" ></td>              
                                <td><input  type="text" class="form-control" name="channel_link[]" value="{{ $channelCoverage->channel_link }}"></td> 
                                <td>
                                    <select class="form-control" name="channel_type[]">
                                        <option value=""> - Select - </option>
                                        @foreach ($channelTypes as $channelType)
                                        <option value="{{ $channelType->id }}" {{ old('channel_type', $channelType->id) == $channelCoverage->channel_type_id ? 'selected' : '' }}>{{ $channelType->channel_type }}</option>
                                        @endforeach
                                    </select>   
                                <td><input  type="text" class="form-control" name="intended_date[]" value="{{ $channelCoverage->intended_date }}" ></td>
                                
                            </tr>
                            @empty
                                <p class="text-danger text-center"> No Data Available</p>
                            @endforelse
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
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

@section('scripts')
<script>
$(document).ready(function () {
    bsCustomFileInput.init();
    var counter = 0;
    $("#addrow").on("click", function () {
        var chenal_coverage = $("#c_coverage").val();
        var chenal_name = $("#c_name").val();
        var chenal_link= $("#c_link").val();
        var chenal_type= $("#c_type").val();
        var chenal_date= $("#c_date").val();

        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text" class="form-control" name="ccoverage[]' + counter + '" value="'+ chenal_coverage +' " /></td>';
        cols += '<td><input type="text" class="form-control" name="cname[]' + counter + '" value="'+ chenal_name +' " /></td>';
        cols += '<td><input type="text" class="form-control" name="clink[]' + counter + '" value="'+ chenal_link +' "/></td>';
        cols += '<td><input type="text" class="form-control" name="ctype[]' + counter + '" value="'+ chenal_type +' "/></td>';
        cols += '<td><input type="text" class="form-control" name="cdate[]' + counter + '" id="cdate" value="'+ chenal_date +' " readonly="true"></td>';
        cols += '<td><button type="button" class="btn btn-danger btn-xs tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"></li></button></td>';
        newRow.append(cols);
        $("table.table-sm").append(newRow);
        counter++;
        $("#c_coverage").val('');
        $("#c_name").val('');
        $("#c_link").val('');
        $("#c_type").val('');
        $("#c_date").val('');
    });
    $("table.table-sm").on("click", "#delete", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
    
});
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





