

<div class="modal fade" id="uploadExcel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-title">Upload File</h4>                                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('excel/uploads') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" id="form-body">
                    <div class="form-group">
                        <label for="" >Source *</label>
                        <select name="eapi_user" class="form-control required select2">
                            <option value="">---SELECT---</option>
                            @foreach (Config::get('settings.eapi_users_gateway') as $k => $v)
                                <option value="{{ $k }}" {{ old('eapi_user') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Transaction Date *</label>
                        <input type="date" name="transaction_date" class="form-control datepicker" placeholder="Application From">
                    </div>
                    <div class="form-group">
                        <label for="">File *<small class="text-danger">[.csv, .xls]</small></label>
                        <input type="file" name="upload" class="form-control required">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-success btn-sm" id="form-submit"><i class="fas fa-check"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
