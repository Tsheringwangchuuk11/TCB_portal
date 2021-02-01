<form id="key_highlights_form" action="{{ url('statistical/key-highlights') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-3">
            <label>Key Highlights Types<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Total Number<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Percent<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Year<span class="text-danger">*</span> </label>
        </div>
        <div class="form-group col-md-2">
            <label for="">Publish Status<span class="text-danger">*</span> </label>
        </div>
    </div>
    <div class="row" id="rowId">
        <div class="form-group col-md-3">
            <select class="form-control validate_highlight_type" name="highlight_type_id[]">
                <option value=""> - Select  - </option>
                @foreach ($dropdowns as $dropdown)
                <option value="{{ $dropdown->id }}">{{ $dropdown->dropdown_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="total_no[]">
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="percent[]">
        </div>
        <div class="form-group col-md-2">
            <input type="text" name="year[]" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="is_publish[]">
                <option value=""> </option>
                @foreach (config()->get('settings.is_publish') as $k => $v)
                <option value="{{ $k }}" {{ old('is_publish') == $k ? 'selected' : '' }}>{{ $v }}</option>
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

    $('.validate_highlight_type').each(function() {
        $(this).rules("add", 
            {
                required: true,
                messages: {
                    required: "Name is required",
                }
        });
    });
    $(function() {
        $("#key_highlights_form").validate();
    });
</script>

