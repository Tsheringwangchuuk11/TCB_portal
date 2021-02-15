<form id="transport_mode_form" action="{{ url('statistical/transportation/update') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{$modeoftransportdata->id}}">
    @csrf
    @method ('PUT')
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Mode of Transportation<span class="text-danger"> *</span></label>
                <select  name="transport_mode_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($modeoftransports as $modeoftransport)
                    <option value="{{ $modeoftransport->id }}" {{ old('transport_mode_id', $modeoftransportdata->transport_mode_id) == $modeoftransport->id ? 'selected' : '' }}> {{ $modeoftransport->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Locationr<span class="text-danger"> *</span></label>
                <select  name="location_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('location_id', $modeoftransportdata->location_id) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
            <label for="">Value<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="value" value="{{  $modeoftransportdata->value }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $modeoftransportdata->year }}">
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
        $('#transport_mode_form').validate({
            rules: {
                location_id: {
                required: true,
                },
                year: {
                required: true,
                },
                value: {
                required: true,
                },
                transport_mode_id: {
                required: true,
                },
            },
            messages: {
                location_id: {
                required: "Please select the location ID",
                },
                year: {
                required: "Please enter year",
                },
                value: {
                required: "Please enter value",
                },
                transport_mode_id: {
                required: "Please select the transportation mode",
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
    $(document).keypress(function(event){ 
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }
        });
</script>
