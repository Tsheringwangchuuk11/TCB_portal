<form id="transportation_mode_form" action="{{ url('statistical/transportation') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-3">
            <label>Mode Of Transportation<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-3">
            <label for="">Location<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Value<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Year<span class="text-danger">*</span> </label>
        </div>
    </div>
    <div class="row" id="rowId">
        <div class="form-group col-md-3">
            <select class="form-control" name="transport_mode_id[]">
                <option value=""> - Select  - </option>
                @foreach ($modeoftransports as $modeoftransport)
                <option value="{{ $modeoftransport->id }}">{{ $modeoftransport->dropdown_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <select class="form-control" name="location_id[]">
                <option value=""> - Select  - </option>
                @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                @endforeach
            </select>        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="value[]">
        </div>
        <div class="form-group col-md-2">
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
        $(document).keypress(function(event){ 
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });
        $.validator.addMethod("transport_mode_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=transport_mode_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select the transportation mode</div>')
                    }
                });
            return flag;
            }, "");

            $.validator.addMethod("location_id_validate", function (value, element) {
                 var flag = true;
                 $("[name^=location_id]").each(function (i, j) {
                    $(this).parent('div').find('div.valid').remove();
                    $(this).parent('div').find('div.valid').remove();
                    if ($.trim($(this).val()) == '') {
                        flag = false;
                        $(this).parent().append('<div class="text-danger valid">Select the location</div>')
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

        $('#transportation_mode_form').validate({
            ignore: '',
            onkeyup: false,
            onclick: false,
           // onfocusout: false,
            rules: {
                 "transport_mode_id[]": {
                    transport_mode_id_validate:true
                },
                "location_id[]": {
                    location_id_validate:true
                },
                "value[]": {
                    value_validate:true
                },
                "year[]": {
                    year_validate:true
                }
            },
        });  
</script>

