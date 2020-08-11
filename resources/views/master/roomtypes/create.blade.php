<form id="room_type_form" action="{{ url('master/room-types') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Room Type <span class="text-danger">*</span></label>
                <input type="text" id= "room_name" name="room_name" class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-5">Create-Room-Type</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>