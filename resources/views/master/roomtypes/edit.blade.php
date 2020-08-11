<form id="room_type_form" action="{{ url('master/room-types/'.$data->id) }}" class="form-horizontal" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Room Type <span class="text-danger">*</span></label>
                <input type="text" name="room_name" value="{{$data->room_name}}" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Active Status<span class="text-danger">*</span></label>
                <input type="radio" name="is_active" value="Y" {{ $data->is_active == 'Y' ? 'checked':'' }}> Yes          
                <input type="radio" name="is_active" value="N" {{ $data->is_active == "N" ? 'checked':'' }}> No
            </div>
        </div>
    </div>
    <div class="modal-footer" style="margin-bottom:-14px;">
        <button type="submit" class="btn btn-success btn-flat margin-r-5" value="create">Update</button>
        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
    </div>
</form>