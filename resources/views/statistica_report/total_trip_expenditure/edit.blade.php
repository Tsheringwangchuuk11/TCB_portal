<form id="key_highlights_form" action="{{ url('statistical/update-total-trip-exp') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{ $totaltripexplist->totexp_id }}">
    @csrf
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Avg Expenditure Trip<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="avg_expenditure_trip" value="{{  $totaltripexplist->avg_expenditure_trip }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Total Expenditure<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="tot_expenditure" value="{{  $totaltripexplist->tot_expenditure }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $totaltripexplist->year }}">
            </div>
        </div>
        @if ( $totaltripexplist->report_category_id==1)
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Country<span class="text-danger"> *</span></label>
                    <select  name="location_id" class="form-control">
                        <option value=""> -Select-</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('location_id', $totaltripexplist->location_id) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if ( $totaltripexplist->report_category_id==3 ||  $totaltripexplist->report_category_id==4)
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="location_id" class="form-control">
                        <option value=""> -Select-</option>
                        @foreach($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('location_id', $totaltripexplist->location_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
    @if ( $totaltripexplist->report_category_id==3)
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Mean <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="mean" value="{{  $totaltripexplist->mean }}">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Median <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="median" value="{{  $totaltripexplist->median }}">
            </div>
        </div>
    </div>
    @endif

    @if ( $totaltripexplist->report_category_id==1)
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Mean <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="mean" value="{{  $totaltripexplist->mean }}">
            </div>
        </div>
    </div>
    @endif
    @if ( $totaltripexplist->report_category_id==3)
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Avg Expenditure Night <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="avg_expenditure_night" value="{{  $totaltripexplist->avg_expenditure_night }}">
            </div>
        </div>
    </div>
    @endif
  
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
