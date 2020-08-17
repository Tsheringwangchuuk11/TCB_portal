<form id="room_type_form" action="{{ url('master/room-types') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Room Type <span class="text-danger">*</span></label>
                <input type="text" name="room_name" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-5">Save</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    $(function() {
        $('#room_type_form').validate({
            rules: {
                room_name: {
                required: true,
                },
            },
            messages: {
                room_name: {
                required: "Please enter a room type",
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

