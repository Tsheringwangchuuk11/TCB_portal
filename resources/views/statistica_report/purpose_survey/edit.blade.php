<form id="purpose_form" action="{{ url('statistical/update-purpose-survey') }}" class="form-horizontal" method="POST">
    <input type="hidden" class="form-control" name="record_id" value="{{ $purposesurveylist->id }}">
    <input type="hidden" class="form-control" name="report_category_id" id="report_category_id" value="{{ $purposesurveylist->report_category_id }}">
    <input type="hidden" class="form-control" name="visitor_type_id" id="visitor_type_id" value="{{ $purposesurveylist->visitor_type_id }}">
    @csrf
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Purpose<span class="text-danger"> *</span></label>
                <select  name="purpose_id" class="form-control">
                    <option value=""> -Select-</option>
                    @foreach($purposes as $purpose)
                    <option value="{{ $purpose->id }}" {{ old('purpose_id', $purposesurveylist->purpose_id) == $purpose->id ? 'selected' : '' }}> {{ $purpose->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Value<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="value" value="{{  $purposesurveylist->value }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Year <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="year" value="{{  $purposesurveylist->year }}">
            </div>
        </div>
        @if ( $purposesurveylist->report_category_id==1)
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Country<span class="text-danger"> *</span></label>
                    <select  name="location_id" class="form-control">
                        <option value=""> -Select-</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('location_id', $purposesurveylist->location_id) == $country->id ? 'selected' : '' }}> {{ $country->dropdown_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if ( $purposesurveylist->report_category_id==3 ||  $purposesurveylist->report_category_id==4)
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="location_id" class="form-control">
                        <option value=""> -Select-</option>
                        @foreach($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('location_id', $purposesurveylist->location_id) == $dzongkhagList->id ? 'selected' : '' }}> {{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if ( $purposesurveylist->report_category_id==2)
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gender <span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender">
                        <option value="">- Select -</option>
                        @foreach (config()->get('settings.gender') as $k => $v)
                        <option value="{{ $k }}" {{ old('gender', $purposesurveylist->gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
    @if ( $purposesurveylist->report_category_id==3 && $purposesurveylist->visitor_type_id==316 || $purposesurveylist->report_category_id==4)
        <div class="row">   
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Gender <span class="text-danger"> *</span></label>
                    <select class="form-control" name="gender">
                        <option value="">- Select -</option>
                        @foreach (config()->get('settings.gender') as $k => $v)
                        <option value="{{ $k }}" {{ old('gender', $purposesurveylist->gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
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
        $('#purpose_form').validate({
            rules: {
                purpose_id: {
                required: true,
                },
                year: {
                required: true,
                },
                value: {
                required: true,
                },
                location_id: {
                        required: function(element) {
                            var report_category_id=$("#report_category_id").val();
                            if(report_category_id==1 || report_category_id==3 || report_category_id==4){
                                return $("#report_category_id").val() ==1 || $("#report_category_id").val() ==3 || $("#report_category_id").val() ==4;
                        }
                    },
                },
                gender: {
                        required: function(element) {
                            var report_category_id=$("#report_category_id").val();
                            var visitor_type_id=$("#visitor_type_id").val();
                            if(report_category_id==2 || report_category_id==3 && visitor_type_id==316 || report_category_id==4){
                                return $("#report_category_id").val() ==2 || $("#report_category_id").val() ==3 && $("#visitor_type_id").val() ==316 || $("#report_category_id").val() ==4;
                        }
                    },
                },
            },
            messages: {
                purpose_id: {
                required: "Please select the purpose",
                },
                year: {
                required: "Please enter year",
                },
                value: {
                required: "Please enter value",
                },
                gender: {
                required: "Please select the gender",
                }
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
