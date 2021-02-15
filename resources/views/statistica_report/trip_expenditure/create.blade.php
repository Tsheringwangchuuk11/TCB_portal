<form id="trip_expenditure_form" action="{{ url('statistical/trip-expenditure') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-2">
            <label>Purpose<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Expenditure Items<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Trip Types<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">value<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-1">
            <label for="">Year<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Report Category<span class="text-danger">*</span> </label>
        </div>
    </div>
    <div class="row" id="rowId">
        <div class="form-group col-md-2">
            <select class="form-control" name="purpose_id[]">
                <option value=""> - Select  - </option>
                @foreach ($purposes as $purpose)
                <option value="{{ $purpose->id }}">{{ $purpose->dropdown_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="exp_item_id[]">
                <option value=""> - Select  - </option>
                @foreach ($exp_items as $exp_item)
                <option value="{{ $exp_item->id }}">{{ $exp_item->dropdown_name }}</option>
                @endforeach
            </select>        
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="trip_type_id[]">
                <option value=""> - Select  - </option>
                @foreach ($trip_types as $trip_type)
                <option value="{{ $trip_type->id }}">{{ $trip_type->dropdown_name }}</option>
                @endforeach
            </select>        
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="value[]">
        </div>
        <div class="form-group col-md-1">
            <input type="text" name="year[]" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="report_category_id[]">
                <option value=""> - Select  - </option>
                @foreach ($report_categories as $report_category)
                <option value="{{ $report_category->report_category_id }}">{{ $report_category->report_category }}</option>
                @endforeach
            </select>        
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

        $(document).keypress(function(event){ 
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });
        $.validator.addMethod("purpose_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=purpose_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select the purpose</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("exp_item_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=exp_item_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select exp. item</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("trip_type_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=trip_type_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select trip type</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("value_validate", function (value, element) {
                 var flag = true;
                 $("[name^=value]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter value</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("year_validate", function (value, element) {
                 var flag = true;
                 $("[name^=year]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Enter year</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("report_category_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=report_category_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select the report category </div>')
                    }
                });
            return flag;
            }, "");

        $('#trip_expenditure_form').validate({
            ignore: '',
            onkeyup: false,
            onclick: false,
           // onfocusout: false,
            rules: {
                 "purpose_id[]": {
                    purpose_id_validate:true
                },
                "exp_item_id[]": {
                    exp_item_id_validate:true
                },
                "trip_type_id[]": {
                    trip_type_id_validate:true
                },
                "value[]": {
                    value_validate:true
                },
                "year[]": {
                    year_validate:true
                },
                "report_category_id[]": {
                    report_category_id_validate:true
                }
            },
        });  
</script>

