<form id="course_form" action="{{ url('course/store-course-dtls') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row"> 
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Course Title</label>
                <select  name="course_type_id" class="form-control select2bs4" style="width: 100%;" id="course_type_id">
                    <option value=""> -Select-</option>
                    @foreach($courseTypes as $courseType)
                    <option value="{{ $courseType->id }}">{{ $courseType->dropdown_name }}</option>
                    @endforeach
                  </select>
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Course Start Date</label>
                <input type="date" id= "course_start_date" name="course_start_date" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Course End Date</label>
                <input type="date" id= "course_end_date" name="course_end_date" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Application Start Date</label>
                <input type="date" id= "app_start_date" name="app_start_date" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Application End Date</label>
                <input type="date" id= "app_end_date" name="app_end_date" class="form-control">
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
              <label for="">Dzongkhag<span class="text-danger"> *</span></label>
              <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4" style="width: 100%;">
                  <option value=""> -Select-</option>
                  @foreach ($dzongkhagLists as $dzongkhagList)
                    <option value="{{ $dzongkhagList->id }}">{{ $dzongkhagList->dzongkhag_name }}</option>
                  @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Contact Person<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="contact_person"  value="{{ old('contact_person') }}" id="contact_person" autocomplete="off" >
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Contact No<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="mobile_no"  value="{{ old('mobile_no') }}" id="mobile_no" autocomplete="off" >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Email<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="email"  value="{{ old('email') }}" id="email" autocomplete="off" >
            </div>
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
                <label for="">Intake Capacity<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="total_slot"  value="{{ old('total_slot') }}" id="total_slot" autocomplete="off" >
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
        $('#course_form').validate({
            rules: {
                course_type_id: {
                required: true,
                },
                course_start_date: {
                required: true,
                },
                course_end_date: {
                required: true,
                },
                app_start_date: {
                required: true,
                },
                app_end_date: {
                required: true,
                },
                dzongkhag_id: {
                required: true,
                },
                contact_person: {
                required: true,
                },
                email: {
                required: true,
                email: true,
                },
                mobile_no: {
                required: true,
                digits: true,
                },
                total_slot:{
                required: true,
                digits: true,
                },
            },
            
            messages: {
                course_type_id: {
                required: "Please select course types",
                },
                course_start_date: {
                required: "Please select course start date",
                },
                course_end_date: {
                required: "Please select course end date",
                },
                app_start_date: {
                required: "Please select the application start date",
                },
                app_end_date: {
                required: "Please select the application end date",
                },
                contact_person: {
                required: "Please enter contact person",
                },
                email: {
                required: "Please enter email",
                },
                mobile_no: {
                required: "Please enter phone number",
                },
                dzongkhag_id: {
                required: "Choose the dzongkhag",
                },
                gewog_id: {
                required: "Choose the gewog",
                },
                total_slot:{
                    required: "Enter the total slot",
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

