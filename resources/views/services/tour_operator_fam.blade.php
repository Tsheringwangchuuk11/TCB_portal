@extends('public_view.main')
@section('page-title','New : Tour Oprators And Travel Agents')
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        <h4 class="card-title">Tour Oprators And Travel Agents</h4>
    </div>
    <form action="{{ url('service-create/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="" style="color:#312e70">Personal Information</h6>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for="" >Name</span>
                                <input type="text" class="form-control required" name="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <span for="">Designation</span>
                                <input type="text" class="form-control required" name="designation" id="designation" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for="">Email</span>
                                <input type="text" class="form-control required" name="email" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <span for="">Website</span>
                                <input type="text" class="form-control required" name="website" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for="">Agency Name </span>
                                <input type="text" name="agency_name" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <span for="">Agency Address</span>
                                <input type="text" name="agency_address" class="form-control required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for="">City</span>
                                <input type="text" class="form-control required" name="city" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <span for="">Country</span>
                                <select  name="country" class="form-control custom-select required">
                                    <option value="">-Select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for=""> From Date</span><small class="text-danger text-right"> [ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker required" name="from_date" id="from_date" autocomplete="off" placeholder="Select Dat" readonly="true"> 
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <span for="">To Date</span><small class="text-danger text-right"> [ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker required" name="to_date" id="to_date" autocomplete="off" placeholder="Select Date" readonly="true">
                            </div>
                        </div>
                    </div>
                    <h6 class="" style="color:#312e70">Agency profile/details</h6>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <div class="form-group">
                                <span for="">Agency established <small>(year)</small></span>
                                <select  name="year" id="year" class="form-control custom-select required">
                                    <option value="">-Select-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10 offset-md-1">
                           <caption>Main markets</caption>
                           <table class="table table table-bordered order-list" id="dataTable">
                               <tbody>
                                   <tr><td>Country</td>
                                       <td>City</td>
                                       <td></td>
                                   </tr>    
                                   <tr><td><input type="text" id="country" class="form-control" name="country" autocomplete="off"></td>              
                                       <td><input  type="text" id="city" class="form-control" name="city" autocomplete="off"/></td> 
                                       <td>
                                        <button type="button" class="btn btn-success btn-xs tooltip-top" title="Add More" id="addrow"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 

                    </div>
                </div>
                <h6 class="" style="color:#312e70">Bhutan Promotion</h6>
                <div class="row">
                    <div class="col-md-10 offset-md-1">                            
                        <table  class="table table-bordered table-striped">
                            <tbody>
                                <tr>        
                                    <td>Do you currently sell Destinations in Asia</td>
                                    <td> 
                                        <input type="radio" name="check1" id="yes" value="Yes"><span>Yes</span>
                                        <input type="radio" name="check1" id="no" value="No"><span>No</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Do you currently sell Bhutan  </td>
                                    <td><input type="radio" name="check2" id="yes" value="Yes"><span>Yes</span>
                                        <input type="radio" name="check2" id="no" value="No"><span>No</span></td>
                                    </tr>
                                    <tr>
                                        <td>If Yes, since when (year)  </td>
                                        <td><select  name="year" class="form-control custom-select required">
                                            <option value="">-Select -</option>
                                        </select></td>
                                    </tr>
                                    <tr>
                                        <td>If No, when do you intend to sell Bhutan as a destination (year) </td>
                                        <td><select  name="year" class="form-control custom-select required">
                                            <option value="">-Select-</option>
                                        </select></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div clasa="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                                <span>Please mention the marketing activities you use or intend to carry out to promote Bhutan
                                </span>
                                <textarea class="form-control required" name="purpose" rows="3" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>

                    <div clasa="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                                <span>Purpose of visit<small class="text-danger text-right">[Please mention your purpose of visit]</small>
                                </span>
                                <textarea class="form-control required" name="purpose" rows="3" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>

                    <div clasa="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="form-group">
                                <span>Feedback <small class="text-danger text-right"> [Please share your feedback on marketing and promoting Bhutan if any]</small>
                                </span>
                                <textarea class="form-control required" name="purpose" rows="3" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <h6 class="p-1" style="color:#312e70">File Attachment
                    </h6>
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
                    <span class="btn btn-success btn-sm fileinput-button">
                       <i class="fas fa-plus"></i>
                       <span>Add files...</span>
                       <input id="fileupload" type="file" name="files[]" multiple="">
                   </span>
                   <div class="form-group row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">I hereby agree to the above terms and conditions, and agree that the above information is true</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
        <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
    </div>  
</form>
</div>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function () {
        var counter = 0;
        $("#addrow").on("click", function () {
            var country = $("#country").val();
            var city = $("#city").val();
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><input type="text" class="form-control" name="country[]' + counter + '" value="'+ country +' " /></td>';
            cols += '<td><input type="text" class="form-control" name="city[]' + counter + '" value="'+ city +' "/></td>';
            cols += '<td><button type="button" class="btn btn-danger btn-xs tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"></li></button></td>';
            newRow.append(cols);
            $("table.order-list").append(newRow);
            counter++;
            $("#country").val('');
            $("#city").val('');
        });
        $("table.order-list").on("click", "#delete", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
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
      });

    });
</script>
@endsection





