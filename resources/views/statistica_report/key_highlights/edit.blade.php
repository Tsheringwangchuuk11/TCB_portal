<form id="key_highlights_form" action="{{ url('statistical/key-highlights/update') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="key_highlight_id" value="{{$keyhighlights->key_highlight_id}}">
    @csrf
    @method ('PUT')
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Key Highlights Types<span class="text-danger"> *</span></label>
                <select  name="highlight_type_id" class="form-control" readonly>
                    <option value=""> -Select-</option>
                    @foreach($dropdowns as $dropdown)
                    <option value="{{ $dropdown->id }}" {{ old('highlight_type_id', $keyhighlights->highlight_type_id) == $dropdown->id ? 'selected' : '' }}> {{ $dropdown->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Total Number<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="total_no" value="{{  $keyhighlights->total_no }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
            <label for="">Percent<span class="text-danger"></span></label>
            <input type="text" class="form-control" name="percent" value="{{  $keyhighlights->percent }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $keyhighlights->year }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Publish Status<span class="text-danger"> *</span></label>
                <select  name="is_publish" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach (config()->get('settings.is_publish') as $k => $v)
                    <option value="{{ $k }}"  {{ old('is_publish', $k) == $keyhighlights->is_publish ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
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
        $('#key_highlights_form').validate({
            rules: {
                total_no: {
                required: true,
                },
                year: {
                required: true,
                },
                is_publish: {
                required: true,
                },
            },
            messages: {
                total_no: {
                required: "Please enter total number",
                },
                year: {
                required: "Please enter year",
                },
                is_publish: {
                required: "Please select the publish status",
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
