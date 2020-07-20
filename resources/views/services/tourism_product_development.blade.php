@extends('layouts.manager')
@section('page-title','Tourism Product Development')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Basic Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Events Title<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="company_title_name" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Financial year<span class="text-danger"> *</span></label>
                        <input type="date" class="form-control" name="financial_year" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Location<span class="text-danger"> *</label>
                            <input type="text" class="form-control" name="location" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Date<span class="text-danger"> *</span></label>
                            <input type="date" class="form-control" name="date" autocomplete="off">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Contact person (person who wrote or has the most knowledge about this application)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name<span class="text-danger"> *</span></label>
                        <input type="text" name="applicant_name" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">CID<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="cid_no" autocomplete="off" >
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contact No. <span class="text-danger"> *</span></label>
                        <input type="text" name="contact_no" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" name="email" autocomplete="off" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Address<span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Organizer(Person with legal authority to sign a contract with the TCB)</h4>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Organizer Name<span class="text-danger"> *</span></label>                                        
                            <input type="text" class="form-control" name="organizer_name" autocomplete="off"> 
                        </div>
                    </div>
                    
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger"> *</span></label>                                        
                        <input type="text" class="form-control" name="organizer_address" autocomplete="off"> 
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="organizer_email" autocomplete="off"> 
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Contact No.<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="organizer_phone" autocomplete="off">
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Organizer<span class="text-danger"> *</label>
                                <select  name="organizer_type" class="form-control select2bs4">
                                   <option value="">-Select-</option>
                                    @foreach (config()->get('settings.organizerType') as $k => $v)
                                    <option value="{{ $k }}" {{ old('organizerType') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Amount Requested:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="amount_requested" autocomplete="off">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Bhutan Coverage & Distribution Channel</h4>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-striped table-sm" id="dataTable" indexId="index"> 
                <thead>
                    <tr>        
                        <th>Sl.No</th>
                        <th>Particulars/Items</th>
                        <th>Costs (Nu.)</th>
                        <th></th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="text" id="items" class="form-control" name="items_name[]" autocomplete="off"></td>              
                    <td><input type="text" id="cost" class="form-control txt" name="item_costs[]" autocomplete="off"></td>              
                    <th></th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-left">
                        Total
                    </td>
                    <td>
                        <input type="hidden" id="grandTotal" class="form-control" name="grandTotal">
                        <span id="scorepoint"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm tooltip-top" title="Add More" id="addrow"><i class="fas fa-plus"> Add</i></button>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>Approval letter from Dzongkhag Administration </em>      
                </li>
                <li>
                    <em>Endorsement letter from Association of Bhutanese Tour Operators (ABTO)/Tour Operator
                    </em>
                </li>
                <li>
                    <em>Write-Up Summary(Festival/Events)
                    </em>
                </li>
                <li>
                    <em>Fund Support Eligibility
                    </em>
                </li>
                <li>
                    <em>Impact On Tourism Product And Infrastructure Development
                    </em>
                </li>
                <li>
                    <em>Event/Festival  Budget
                    </em>
                </li>
                <li>
                    <em>Budget Naratives
                    </em>
                </li>
            </ol>
            @include('services/fileupload/fileupload')
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
        $(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
        });
        $(document).ready(function () {
            bsCustomFileInput.init();
            var counter = 2;
            $("#addrow").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td> '+counter+'</td>';
                cols += '<td><input type="text" class="form-control" name="items_name[]' + counter + '"/></td>';
                cols += '<td><input type="text" class="form-control txt" name="item_costs[]' + counter + '"></td>';
                cols += '<td><button type="button" class="btn btn-danger btn-sm tooltip-top" id="delete" title="Delete"><li class="fas fa-trash"> Delete</li></button></td>';
                newRow.append(cols);
                $("table.table-sm").append(newRow);
                counter++;
            });
            $("table.table-sm").on("click", "#delete", function (event) {
                currentRow = $(this).closest("tr");
                var currentVal=currentRow.find('.txt').val();
                currentRow.remove(); 
                var total= $("#grandTotal").val(); 
                var deductvalue=parseFloat(total)-parseFloat(currentVal);
                $("#grandTotal").val(deductvalue);
                $("#scorepoint").html(deductvalue);
                counter -= 1
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
$("#grandTotal").val(sum);
 $("#scorepoint").html(sum);
}
$("table").on("keyup", ".txt", function () {
    calculateScorePoint();
});
  </script>
  @endsection





