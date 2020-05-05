@extends('layouts.manager')
@section('page-title','Tourism Product Development')
@section('content')
<div class="card">
    <div class="card-header bg-success">
       <h4 class="card-title">Infrastructure And Product Development Fund</h4>
   </div>
   <form class="form" role="form" action="{{ url('service-create/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="">Basic Information</h5>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Events Title<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="event_titles" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Financial year<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control required" name="finacial_year" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Location<span class="text-danger"> *</label>
                                <input type="text" class="form-control" name="location_id" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Date<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <h5 class="">Contact person (person who wrote or has the most knowledge about this application)
                    </h5>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Address<span class="text-danger"> *</span></label>
                                <input type="text" name="address" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No. <span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control numeric-only" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" class="form-control" name="email" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <h5>Organizer(Person with legal authority to sign a contract with the TCB)
                    </h5>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Address <span class="text-danger"> *</span></label>                                        
                                <input type="text" class="form-control required" name="oaddress" autocomplete="off"> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="organizer_contact_no" id="to_date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control required" name="organizer_email" autocomplete="off"> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Organizer<span class="text-danger"> *</label>
                                    <select  name="organizer" class="form-control">
                                        <option value=""></option>
                                        <option value="">Non-Profit</option>
                                        <option value="">Public Agency</option>
                                        <option value="">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Amount Requested:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control required" name="amount_requested" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Write-Up Summary(Festival/Events)<span class="text-danger"> *</span></label><br><small>(Please provide a one-paragraph summary of your request and what it will accomplish. If your request is part of a larger project, you may briefly describe the over-all project. However, please focus your answer on specific elements for which you are requesting funding).</small>
                                    <textarea type="text" row="3" class="form-control required" name="writeup" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Fund Support Eligibility<span class="text-danger"> *</span></label>
                                    <textarea type="text" row="3" class="form-control required" name="writeup" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Impact On Tourism Product And Infrastructure Development<span class="text-danger"> *</span></label>
                                    <textarea type="text" row="3" class="form-control required" name="writeup" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Event/Festival  Budget<span class="text-danger"> *</span></label>
                                    <textarea type="text" row="3" class="form-control required" name="writeup" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <h5>Bhutan Coverage & Distribution Channel</h5>
                        <div class="row">
                            <div class="col-md-12">                            
                                <table class="table table-bordered table-sm" id="dataTable" indexId="index"> 
                                    <tbody>
                                        <tr>        
                                            <th>Sl.No</th>
                                            <th>Particulars/Items</th>
                                            <th>Costs (Nu.)</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" id="items" class="form-control" name="items[]" autocomplete="off"></td>              
                                            <td><input type="text" id="cost" class="form-control" name="cost[]" autocomplete="off" onchange="updateTotal();"></td>              
                                            <td>
                                                <button type="button" class="btn btn-success btn-xs tooltip-top" title="Add More" id="addrow"><i class="fas fa-plus"> Add</i></button>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Budget Naratives <span class="text-danger"> *</span></label>
                                    <textarea type="text" row="3" class="form-control required" name="writeup" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                        <h5>File Attachment<span class="text-danger"> *</span></h5>
                        <h6> <strong>Required supporting documents:</strong></h6>
                        <ol>
                            <li>
                                <em>Approval letter from Dzongkhag Administration </em>      
                            </li>
                            <li>
                                <em>Endorsement letter from Association of Bhutanese Tour Operators (ABTO)/Tour Operator
                                </em>
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
                <button type="submit"class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
                <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
            </div>
        </form>
    </div>
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
            var counter = 2;
            $("#addrow").on("click", function () {
                var items = $("#items").val();
                var cost= $("#cost").val();
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td> '+counter+'</td>';
                cols += '<td><input type="text" class="form-control" name="items[]' + counter + '" value="'+ items +' "/></td>';
                cols += '<td><input type="text" class="form-control" name="cost[]' + counter + '" id="cost" value="'+ cost +' " readonly="true"></td>';
                cols += '<td><button type="button" class="btn btn-danger btn-xs tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"> Delete</li></button></td>';
                newRow.append(cols);
                $("table.table-sm").append(newRow);
                counter++;
                $("#items").val('');
                $("#cost").val('');
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





