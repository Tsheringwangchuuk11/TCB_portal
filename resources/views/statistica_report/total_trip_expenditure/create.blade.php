<form id="total_trip_exp_form" action="{{ url('statistical/store-total-trip-exp') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="report_category_id"  value="{{ $report_category_id }}" class="form-control">
    <div class="row">
        <div class="form-group col-md-2">
            <label>Avg Expenditure Trip<span class="text-danger">*</span></label>
        </div>

        @if ( $report_category_id==3)
            <div class="form-group col-md-2">
                <label for="">Avg Expenditure Night<span class="text-danger">*</span> </label>
            </div>
        @endif

        <div class="form-group col-md-2">
            <label>Total Expenditure<span class="text-danger">*</span></label>
        </div>

        @if ( $report_category_id==1 || $report_category_id==3)
            <div class="form-group col-md-1">
                <label for="">Mean<span class="text-danger">*</span> </label>
            </div>
         @endif

         @if ($report_category_id==3)
            <div class="form-group col-md-1">
                <label for="">Median<span class="text-danger">*</span> </label>
            </div>
          @endif

        @if ( $report_category_id==1)
            <div class="form-group col-md-2">
                <label for="">Country<span class="text-danger">*</span> </label>
            </div>
        @endif
        @if ($report_category_id==3 ||  $report_category_id==4)
            <div class="form-group col-md-2">
                <label for="">Dzongkhag<span class="text-danger">*</span> </label>
            </div>
        @endif

        <div class="form-group col-md-1">
            <label for="">Year<span class="text-danger">*</span> </label>
        </div>
    </div>
    <div class="row" id="rowId">
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="avg_expenditure_trip[]">
        </div>
        @if ( $report_category_id==3)
            <div class="form-group col-md-2">
                <input type="text" class="form-control" name="avg_expenditure_trip[]">
            </div>
        @endif
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="tot_expenditure[]">
        </div>
        @if ($report_category_id==1 || $report_category_id==3)
            <div class="form-group col-md-1">
                <input type="text" class="form-control" name="mean[]">
            </div>
        @endif

        @if ($report_category_id==3)
            <div class="form-group col-md-1">
                <input type="text" class="form-control" name="median[]">
            </div>
        @endif

         @if ( $report_category_id==1)
            <div class="form-group col-md-2">
                <select class="form-control" name="location_id[]">
                    <option value=""> - Select  - </option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                            @endforeach
                </select>
            </div>
        @endif
         @if ($report_category_id==3 ||  $report_category_id==4)
            <div class="form-group col-md-2">
                <select class="form-control" name="location_id[]">
                    <option value=""> - Select  - </option>
                    @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group col-md-1">
            <input type="text" name="year[]" class="form-control">
        </div>
    </div>
    <div id="adddiv"></div>
    <span class="btn bg-purple btn-sm float-right" id="add"><i class="fas fa-plus fa-xs"> Add New Row</i></span><br><br>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-2  float-left">Save</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
     $(document).ready(function(){ 
        id=1;
        $("#add").click(function(){
            $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text'],select").val("");
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
</script>

