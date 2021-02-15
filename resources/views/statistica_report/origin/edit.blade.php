<form id="origin_form" action="{{ url('statistical/origin/update') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{$origindata->id}}">
    @csrf
    @method ('PUT')
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Main Destination<span class="text-danger"> *</span></label>
                <select  name="origin_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}" {{ old('origin_id', $origindata->origin_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">VisitorTypes<span class="text-danger"> *</span></label>
                <select  name="visitor_type_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($visitorsTypes as $visitorsType)
                    <option value="{{ $visitorsType->id }}" {{ old('visitor_type_id', $origindata->visitor_type_id) == $visitorsType->id ? 'selected' : '' }}> {{ $visitorsType->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Dzongkhag of Origin<span class="text-danger"> *</span></label>
                <select  name="location_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}" {{ old('location_id', $origindata->location_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
            <label for="">Value<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="value" value="{{  $origindata->value }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $origindata->year }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Report Category<span class="text-danger"> *</span></label>
                <select  name="report_category_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($report_categories as $report_category)
                    <option value="{{ $report_category->report_category_id }}" {{ old('report_category_id', $origindata->report_category_id) == $report_category->report_category_id ? 'selected' : '' }}> {{ $report_category->report_category }}</option>
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
        $('#origin_form').validate({
            rules: {
                origin_id: {
                required: true,
                },
                year: {
                required: true,
                },
                visitor_type_id: {
                required: true,
                },
                value: {
                required: true,
                },
                location_id: {
                required: true,
                },
                report_category_id: {
                required: true,
                },
            },
            messages: {
                origin_id: {
                required: "Select the origin",
                },
                year: {
                required: "Please enter year",
                },
                visitor_type_id: {
                required: "Select visitor type",
                },
                value: {
                required: "Select visitor type",
                },
                location_id: {
                required: "Select location",
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
