@extends('layouts.manager')
@section('page-title','Bhutan Media Familarization')
@section('content')
<div class="card">
    <div class="card-header bg-success">
        <h4 class="card-title">Bhutan Media Familarization Registration </h4>
    </div>
<form class="form" role="form" action="{{ url('service-create/store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <h5>Personal Information</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name<span clas="txet-danger"> *</span></label>
                        <input type="text" class="form-control required" name="name" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Designation <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="designation" id="designation" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger"> *<span></label>
                            <input type="text" class="form-control required" name="email" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Website<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control required" name="website" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Agency Name <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_name" class="form-control required" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Agency Address <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_address" class="form-control required" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">City <span class="text-danger"> *<span></label>
                                <input type="text" class="form-control required" name="city" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Country <span class="text-danger"> *</span></label>
                                <select  name="country" class="form-control custom-select required">
                                    <option value="">-Select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> From Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control required" name="from_date" id="from_date" autocomplete="off" placeholder="Select Date" readonly="true"> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">To Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker required" name="to_date" id="to_date" autocomplete="off" placeholder="Select Date" readonly="true">
                            </div>
                        </div>
                    </div>
                    <h5>Agency Profile</h5>
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
                                    <tr>        
                                        <td>Online</td>
                                        <td><input type='text' name='online_name' class='form-control'></td>
                                        <td><input type='text' name='online_circulation' class='form-control'></td>
                                        <td><input type='text' name='online_target_audience' class='form-control'></td>
                                    </tr>
                                    <tr>        
                                        <td>TV</td>
                                        <td><input type='text' name='tv_name' class='form-control'></td>
                                        <td><input type='text' name='tv_circulation' class='form-control'></td>
                                        <td><input type='text' name='tv_target_audience' class='form-control'></td>
                                    </tr>
                                    <tr>        
                                        <td>Print</td>
                                        <td><input type='text' name='Print_name' class='form-control'></td>
                                        <td><input type='text' name='Print_circulation' class='form-control'></td>
                                        <td><input type='text' name='Print_target_audience' class='form-control'></td>
                                    </tr>
                                    <tr>        
                                        <td>Others</td>
                                        <td><input type='text' name='others_name' class='form-control'></td>
                                        <td><input type='text' name='others_circulation' class='form-control'></td>
                                        <td><input type='text' name='others_target_audience' class='form-control'></td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <h5>Bhutan Coverage & Distribution Channel</h5>
                    <div class="row">
                        <div class="col-md-12">                            
                            <table class="table table-bordered table-sm" id="dataTable"> 
                                <tbody>                                   <thead>
                                    <tr>        
                                        <td>Mention all area/topic of Bhutan coverage</td>
                                        <td>Channel Name </td>
                                        <td>Channel Link </td>
                                        <td>Channel Type</td>
                                        <td>Intended Date of Feature </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input  type="text" id="c_coverage" class="form-control" name="c_coverage" autocomplete="off"/></td>
                                        <td><input type="text" id="c_name" class="form-control" name="c_name" autocomplete="off"></td>              
                                        <td><input  type="text" id="c_link" class="form-control" name="c_link" autocomplete="off"/></td> 
                                        <td><input  type="text" id="c_type" class="form-control" name="c_type" autocomplete="off"/></td>              
                                        <td><input  type="text" id="c_date" class="form-control" name="c_date" autocomplete="off" readonly="true"/></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs tooltip-top" title="Add More" id="addrow"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h5>File Attachment</h5>
                    <strong> Required supporting documents:</strong>
                    <ol>
                        <li>
                            <em>Address your application to the Director, Tourism Council of Bhutan (In English)</em>      
                        </li>
                        <li>
                            <em>Recommendation letter from the head of the agency (In English)
                            </em><br>  
                            a.Include designation/role of your staff visiting Bhutan 
                        </li>
                        <li>
                            <em>Route your application through a registered Bhutanese tour operator </em>      
                        </li>
                        <li>
                            <em>All members of the approved media FAM tour must meet relevant officials from the Tourism Council of Bhutan, preferably towards the end of your Bhutan trip</em>      
                        </li>
                        <li>
                            <em>After your Bhutan visit you must submit copy/copies of your coverage to the Tourism Council of Bhutan. You can email Bhutan coverage to <a href="info@tourism.gov.bt">info@tourism.gov.bt</a><em>      
                            </li>
                            <li>
                                <em>You hereby agree to give permission to the Tourism Council of Bhutan to use the coverage(s) (print, online and TV) on Bhutan to promote Bhutan. TCB and its partners will only use for promotion of Bhutan only.<em>      
                                </li>
                            </ol>
                            <span class="btn btn-success btn-sm fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>Add Files...</span>
                                <input id="fileupload" type="file" name="files[]" multiple="">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit"class="btn btn-success btn-sm"><li class="fas fa-check"></li> APPLY</button>
                    <button type="reset" class="btn btn-danger btn-sm"><li class="fas fa-times"></li> RESET</button>
                </div>
         </form>
    </div>
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





