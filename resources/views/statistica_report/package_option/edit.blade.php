<form id="package_option_form" action="{{ url('statistical/package-option/update') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{$package_option->id}}">
    @csrf
    @method ('PUT')
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Location<span class="text-danger"> *</span></label>
                <select  name="location_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('location_id', $package_option->location_id) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Package Option<span class="text-danger"> *</span></label>
                <select  name="package_option" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach (config()->get('settings.is_publish') as $k => $v)
                    <option value="{{ $k }}"  {{ old('package_option', $k) == $package_option->package_option ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
            <label for="">Value<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="value" value="{{  $package_option->value }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $package_option->year }}">
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
