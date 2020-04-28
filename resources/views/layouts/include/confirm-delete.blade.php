<div class="modal fade" id="delete-form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Delete </h4>
            </div>
            {{ Form::open() }}
            @method('DELETE')
            <div class="modal-body">
                Are you sure you want to delete<span id="type-name" style="font-weight:bold"></span>?
            </div>
            <div class="modal-footer text-right">
                <a href="{{ url()->current() }}" class="btn btn-sm btn-danger">CANCEL</a>
                <button type="submit" class="btn btn-sm btn-danger">Confirm Delete</button>
            </div>
            {{ Form::close() }}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>