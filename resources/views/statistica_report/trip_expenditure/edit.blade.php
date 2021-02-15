<form id="trip_expenditure_form" action="{{ url('statistical/trip-expenditure/update') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{$tripexpenditure->id}}">
    @csrf
    @method ('PUT')
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Purpose<span class="text-danger"> *</span></label>
                <select  name="purpose_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($purposes as $purpose)
                    <option value="{{ $purpose->id }}" {{ old('purpose_id', $tripexpenditure->purpose_id) == $purpose->id ? 'selected' : '' }}> {{ $purpose->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Expenditure Items<span class="text-danger"> *</span></label>
                <select  name="exp_item_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($exp_items as $exp_item)
                    <option value="{{ $exp_item->id }}" {{ old('exp_item_id', $tripexpenditure->exp_item_id) == $exp_item->id ? 'selected' : '' }}> {{ $exp_item->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Trip Types<span class="text-danger"> *</span></label>
                <select  name="trip_type_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($trip_types as $trip_type)
                    <option value="{{ $trip_type->id }}" {{ old('trip_type_id', $tripexpenditure->trip_type_id) == $trip_type->id ? 'selected' : '' }}> {{ $trip_type->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
            <label for="">Value<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="value" value="{{  $tripexpenditure->value }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $tripexpenditure->year }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Report Category<span class="text-danger"> *</span></label>
                <select  name="report_category_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($report_categories as $report_category)
                    <option value="{{ $report_category->report_category_id }}" {{ old('report_category_id', $tripexpenditure->report_category_id) == $report_category->report_category_id ? 'selected' : '' }}> {{ $report_category->report_category }}</option>
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
        $('#trip_expenditure_form').validate({
            rules: {
                purpose_id: {
                required: true,
                },
                year: {
                required: true,
                },
                exp_item_id: {
                required: true,
                },
                value: {
                required: true,
                },
                trip_type_id: {
                required: true,
                },
                report_category_id: {
                required: true,
                },
            },
            messages: {
                purpose_id: {
                required: "Select the purpose",
                },
                year: {
                required: "Please enter year",
                },
                exp_item_id: {
                required: "Select expenditure item",
                },
                value: {
                required: "Select visitor type",
                },
                trip_type_id: {
                required: "Select trip type",
                },
                report_category_id: {
                required: "Select report category",
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
