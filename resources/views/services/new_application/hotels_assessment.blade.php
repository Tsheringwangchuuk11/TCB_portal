@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tourist Standard Hotels')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
<input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label>Registration Type <span class="text-danger">*</span></label>
                <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                    <option value="">- Select -</option>
                    @foreach ($applicationTypes as $applicationType)
                    <option value="{{$applicationType->id}}">{{$applicationType->dropdown_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label>Star Category Type <span class="text-danger">*</span></label>
                <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                    <option value="">- Select -</option>
                    @foreach ($starCategoryLists as $starCategoryList)
                    <option value="{{$starCategoryList->id}}">{{$starCategoryList->star_category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <div class="alert alert-danger alert-dismissible" id="alertTraineeMgsId" style="display: none">
                    <i class="fa fa-info-circle fa-lg"></i><strong><span id="showTraineeMsg"></span> Your dispatch number is incorrect</strong>
                </div>
                <label for="">Dispatch Number<span class="text-danger"> *</span><small class="text-danger">[Dispatch number mention in technical clearance letter]</small></label>
                <input type="text" class="form-control" name="dispatch_no" value="{{ old('dispatch_no') }}" id="dispatch_no">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">License Number <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="license_no" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">License Date <span class="text-danger">*</span> </label>
                <div class="input-group date" id="license_date" data-target-input="nearest">
                    <input type="text" name="license_date" class="form-control datetimepicker-input" data-target="#license_date" value="{{ old('license_date') }}">
                    <div class="input-group-append" data-target="#license_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Hotel Name <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="company_title_name" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Citizen ID<span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="cid_no" autocomplete="off" onchange="api_webservices(this.value)" id="cid_no">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Owner Name<span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="owner_name" autocomplete="off" id="applicant_name">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Address <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="address" autocomplete="off">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Contact No <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="contact_no" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Manager Name<span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="manager_name" autocomplete="off">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for=""> Manager Contact No <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="manager_mobile_no" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Email <span class="text-danger">*</span> </label>
                <input type="email" class="form-control email" name="email" autocomplete="off">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Internet Homepage <span class="text-danger">*</span> </label>
                <input type="text" class="form-control" name="webpage_url" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Fax No</label>
                <input type="text" class="form-control" name="fax" autocomplete="off">
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Number of Beds <span class="text-danger">*</span> </label>
                <input type="text" class="form-control numeric-only" name="number" autocomplete="off">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Hotel Location</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                    <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                        <option value=""> -Select-</option>
                        @foreach ($dzongkhagLists as $dzongkhagList)
                        <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="form-group">
                    <label for="">Gewog<span class="text-danger"> *</span></label>
                    <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="">Village<span class="text-danger"> *</span></label>
                    <select  name="establishment_village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                        <option value=""> -Select-</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Room Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-5">
                <label>Room Type <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-5 offset-md-2">
                <label for="">Number of Room<span class="text-danger">*</span> </label>
            </div>
        </div>
        <div class="row" id="rowId">
            <div class="form-group col-md-5">
                <select class="form-control room_type_id" name="room_type_id[]" id="room_type_id">
                    <option value=""> - Select Room - </option>
                    @foreach ($roomTypeLists as $roomTypeList)
                    <option value="{{ $roomTypeList->id }}">{{ $roomTypeList->dropdown_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 offset-md-2">
                <input type="text" class="form-control calroomtotal" name="room_no[]" id="room_no" onkeyup="TotalRoomCal()">
            </div>
        </div>
        <div id="adddiv"></div>
        <span class="btn bg-purple btn-sm float-right" id="add"><i class="fas fa-plus fa-sm"> Add New Row</i></span><br>
        <div class="row">
            <div class="form-group col-md-5">
                <label for="">Total number of rooms:&nbsp;<span id="room_total"></span></label>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Staff Details</h4>
    </div>
    <div class="row" style="overflow-x:auto;">
        <table id="staffDetail" class="table table-condensed table-striped">
            <thead>
                <th width="1%"  class="text-center">#</th>
                <th width="15%">CID<span class="text-danger">*</span></th>
                <th width="20%">Name<span class="text-danger">*</span></th>
                <th width="15%">Gender<span class="text-danger">*</span></th>
                <th>Designation<span class="text-danger">*</span></th>
                <th>Qualification<span class="text-danger">*</span></th>
                <th>Experience<span class="text-danger">*</span></th>
                <th width="10%">Salary<span class="text-danger">*</span></th>
                <th>Hospitility relating<span class="text-danger">*</span></th>
            </thead>
            <tbody>
                <tr>
                    <td width="1%" class="text-center">
                        <a href="#" class="delete-table-row btn btn-danger btn-xs"><i class="fas fa-times"></i></a>
                    </td>
                    <td width="15%">
                        <input type="text" name="staff_cid_no[]" class="form-control numericOnly" />
                    </td>
                    <td width="20%">
                        <input type="text" name="staff_name[]" class="form-control" />
                    </td>
                    <td width="15%">
                        <select class="form-control input-sm" name="staff_gender[]">
                            <option value=""> </option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('gender') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="staff_designation[]" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" name="qualification[]" class="form-control input-sm">
                    </td>
                    <td>
                        <input type="text" name="experience[]" class="form-control input-sm">
                    </td>
                    <td width="10%">
                        <input type="text" name="salary[]" class="form-control input-sm" />
                    </td>
                    <td>
                        <select class="form-control input-sm" name="hospitility_relating[]">
                            <option value=""> </option>
                            @foreach (config()->get('settings.hospitility_relating') as $k => $v)
                            <option value="{{ $k }}" {{ old('hospitility_relating') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="notremovefornew">
                    <td class="text-right" colspan="9">
                        <a href="#" class="add-table-row btn bg-purple btn-sm"><i class="fa fa-plus"></i> Add New Row</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="showdivid"></div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">File Attachment</h4>
    </div>
    <div class="card-body">
        <h6> <strong>Required supporting documents:</strong></h6>
        <ol>
            <li>
                <em>Please attach additional sheets where necessary like pictures of buildings</em>      
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group ml-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="terms" id="exampleCheck2">
                    I hereby:
                    <ol>
                        <li>
                            Confirm the accuracy of the provided data; 
                        </li>
                        <li>
                            Agree to submit upon request of the Classification Committee  additional information for classification approval/modification purposes; 
                        </li>
                        <li>
                            Apply for the assignment of <b><span id="star_level"></span></b>  and verify the conformity of the accommodation establishment  to the  guideline; 
                        </li>
                        <li>
                            Agree with the terms and conditions laid down in the statutes of the TCB- classification committee and the classification procedure.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <button name="status" value="DRAFT" class="btn btn-info"><i class="fa fa-save"></i> SAVE TO DRAFT</button>
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div>
</div>
</form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
            $('#license_date').datetimepicker({
                format: 'DD/MM/YYYY',
            });
        });
        
        $(document).ready(function(){ 
        id=1;
        $("#add").click(function(){
            $("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text']").val("");
            $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
            +'<span id="remove" onClick="removeForm('+id+')"' 
            +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
            +'<div id="line'+id+'"></div>';
            $('#adddiv').append($addRow);
            id++;
            });
        });
    
        function removeForm(id){ 
            var no_of_rooms=$('#rowId'+id).find("input.calroomtotal").val();
            var total= $("#room_total").text(); 
            if (confirm('Are you sure you want to delete this form?')){
                $('#rowId'+id).remove();
                $('#remove'+id).remove();
                $('#line'+id).remove();
                var deductvalue=parseFloat(total)-parseFloat(no_of_rooms);
                $("#room_total").html(deductvalue);
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#star_category_id').on('change',function(ev){
                var star_category_id=$("#star_category_id").val();
                var star_category_name = $("#star_category_id  option:selected").text();
                $("#star_level").html(star_category_name);
                var url="{{ url('application/get-hotel-checklist') }}";
                var options = {target:'#showdivid',
                url:url,
                type:'POST',
                data: $("#form_data").serialize()};
                $("#form_data").ajaxSubmit(options);
            });
        });
        
        $(function () {
            $(document).on('change', '#dispatch_no', function(){
                var dispatch_no=$("#dispatch_no").val();
                $.ajax({
                        url:'/application/check-dispatch-number',
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                dispatch_no: dispatch_no,
                            },
                        success:function(data) {
                            console.log(data);
                            if(data !=false){
                            
                        }else{
                            $('#alertTraineeMgsId').show().delay(3000).queue(function (n) {
                                $(this).hide();
                                n();
                            });
                            $("#dispatch_no").val('');
                        }
                    }
                });
            });
        });

        $.validator.addMethod('checkScorepoint', function (value) {
            var star_category_id=$("#star_category_id").val();
                if(star_category_id==1){
                    return (value >= 160 && value <= 199 );
                }
                if(star_category_id==2){
                    return (value >= 200 && value <= 279 );
                }
                if(star_category_id==3){
                    return (value >= 280);
                }
            }, 'Your score point should be within above range');
        
        $.validator.addMethod('checkBspoints', function (value) {
            var star_category_id=$("#star_category_id").val();
            if(star_category_id==1){
                    return (value >= 117 && value <= 120 );
                }
                if(star_category_id==2){
                    return (value >= 145 && value <= 149 );
                }
                if(star_category_id==3){
                    return (value >= 162 && value <= 166 );
                }
        }, 'Your score point should be within above range');

           $.validator.prototype.errorsFor = function (b) {
                var name = this.idOrName(b);
                var elementParent = b.parentElement;
                return this.errors().filter(function() {
                    return $(this).attr('for') == name && $(this).parent().is(elementParent);
                });
            } 
 
        $('#form_data').validate({
                rules: {
                    application_type_id: {
                       required: true,
                    },
                    star_category_id: {
                       required: true,
                    },
                    dispatch_no: {
                       required: true,
                    },
                    cid_no: {
                        required: true,
                        maxlength: 11,
                        minlength: 11,
                        digits: true,                    
                     },
                     license_date: {
                        required: true,
                    },
                    company_title_name: {
                        required: true,
                    },
                    license_no: {
                        required: true,
                    },
                    owner_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    contact_no: {
                        required: true,
                        digits: true,                    
                    },
                    email: {
                        required: true,
                        email: true,                    
                    },
                    number: {
                        required: true,
                        digits: true,                    
                    },
                    manager_name: {
                        required: true,
                    },
                    manager_mobile_no: {
                        required: true,
                        digits: true,                          
                        },
                    webpage_url: {
                        required: true,
                        url: true,
                        normalizer: function( value ) {
                        var url = value;
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                        // then prefix with http://
                        url = "http://" + url;
                        }
                        // Return the new url
                        return url;
                        }
                    },
                    dzongkhag_id: {
                        required: true,
                    },
                    gewog_id: {
                        required: true,
                    },
                    establishment_village_id: {
                        required: true,
                    },
                    scorepoint: {
                        checkScorepoint: true,
                    },
                    bspoints: {
                        checkBspoints: true,
                    }, 
                    terms:{
                        required: true,
                    },
                    "room_type_id[]":{
                        required: true,
                    } ,
                    "room_no[]":{
                        required: true,
                    } ,
                    "staff_cid_no[]":{
                        required: true,
                    },
                    "staff_name[]":{
                        required: true,
                    },
                    "staff_gender[]":{
                        required: true,
                    },
                    "staff_designation[]":{
                        required: true,
                    },
                    "qualification[]":{
                        required: true,
                    },
                    "experience[]":{
                        required: true,
                    },
                    "salary[]":{
                        required: true,
                    },
                    "hospitility_relating[]":{
                        required: true,
                    },
                },
                messages: {
                    application_type_id: {
                         required: "Please select the application type",
                    },
                    dispatch_no: {
                          required: "Please enter dispatch number",
                    },
                    star_category_id: {
                    required: "Choose accommodation type",
                    },
                    cid_no: {
                        required: "Please provide a cid number",
                        maxlength: "Your cid must be 11 characters long",
                        minlength: "Your cid must be at least 11 characters long",
                        digits: "This field accept only digits",
                    },
                    owner_name: {
                        required: "Enter the name",
                    },
                    contact_no: {
                        required: "Please provide a contact number",
                        digits: "This field accept only digits",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    number: {
                        required: "Please provide number of bed",
                        digits: "This field accept only digits",
                    },
                    manager_name: {
                        required: "Enter manager name",
                    },
                    manager_mobile_no: {
                        required: "Please provide a contact number",
                        digits: "This field accept only digits",  
                                      },
                    webpage_url: {
                        required: "Please enter webpage_url",
                    },
                    company_title_name: {
                        required: "Please enter company name",
                    },
                    license_date: {
                        required: "Please enter license date",
                    },
                    license_no: {
                        required: "Please enter license number",
                    },
                    dzongkhag_id: {
                        required: "Please select dzongkhag",
                    },
                    gewog_id: {
                        required: "Please select gewog",
                    },
                    establishment_village_id: {
                        required: "Please select village",
                    },
                    terms: {
						required:"Please accept our terms",
                    },
                    "room_type_id[]": {
						required:"Choose room type",
                    },
                    "room_no[]": {
						required:"Enter number of rooms",
                    },
                    "staff_cid_no[]": {
						required:"Enter number of rooms",
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
         function TotalRoomCal() {
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".calroomtotal").each(function () {
                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#room_total").html(sum);
         }
    </script>   
@endsection