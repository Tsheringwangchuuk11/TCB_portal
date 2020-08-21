<form id="relationship_type_form" action="{{ url('master/drop-down-master/'.$data->id) }}" class="form-horizontal" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Dropdown Name <span class="text-danger">*</span></label>
                <input type="text" name="dropdown_name" value="{{$data->dropdown_name}}" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
               <label for="">Active Status <span class="text-danger">*</span></label>
              <div class="form-check">
                <input type="radio" name="is_active" lass="form-check-input" value="Y" {{ $data->is_active == 'Y' ? 'checked':'' }}>          
                <label class="form-check-label">Yes </label>
                <input type="radio" name="is_active" lass="form-check-input" value="N" {{ $data->is_active == "N" ? 'checked':'' }}> 
                <label class="form-check-label">No</label>
              </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-5">Update</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    $(function() {
        $('#relationship_type_form').validate({
            rules: {
                dropdown_name: {
                required: true,
                },
                is_active:{
                required: true,
                },
            },
            messages: {
                dropdown_name: {
                     required: "Please enter a dropdown name",
                },
                is_active: {
                required: "Please  check the status",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>