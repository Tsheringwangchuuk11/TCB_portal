@extends('layouts.enduser')
@section('page-title','Issuance Of Recommendation Letter For Work Permit')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="form_data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Recommendationn Letter Type<span class="text-danger"> *</span></label>
                        <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($workpermitTypes as $workpermitType)
                            <option value="{{$workpermitType->id}}">{{$workpermitType->dropdown_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2" id="dispatchNo" style="display:none">
                    <div class="form-group">
                        <label for="" >Dispatch No<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="dispatch_no" id="dispatch_no" onchange="getWorkPermitDetails(this.value)">
                    </div>
                    <div class="alert alert-danger alert-dismissible" id="alertTraineeMgsId" style="display: none">
                        <i class="fa fa-info-circle fa-lg"></i><strong><span id="showTraineeMsg"></span> Your dispatch number is incorrect</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                <div class="form-group">
                    <label for="" >License No<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="license_no" value="{{ old('license_no') }}" autocomplete="off" id="license_no">
                </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="" >Comapany Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="company_title_name" value="{{ old('company_title_name') }}" id="company_title_name" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >Citizen ID<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no') }}" id="cid_no" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="" >Email<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" autocomplete="off">
                    </div>
                </div>
            </div>
            <div style="display: none" id="workerId">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" >Total workers<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" id="number" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="" >Nationality<span class="text-danger"> *</span></label>
                            <select  name="country_id" id="country_id" class="form-control select2bs4" style="width: 100%;">
                                <option value=""> -Select-</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                    <div class="form-group">
                        <label for="" >From Date<span class="text-danger"> *</span></label>
                        <div class="input-group date" id="from_date" data-target-input="nearest">
                            <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ old('from_date') }}">
                            <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="" >To Date<span class="text-danger"> *</span></label>
                            <div class="input-group date" id="to_date" data-target-input="nearest">
                                <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ old('to_date') }}">
                                <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Location</h4>
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
    <div id="personalDtl" style="display:none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Foreign worker Personal Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="alert alert-danger alert-dismissible" id="alertPassportMgsId" style="display: none">
                        <i class="fa fa-info-circle fa-lg"></i><strong><span id="showPassportMsg"></span> Your passport number is incorrect</strong>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" >Passport No.<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" >Name<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" >From Date<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" >To Date<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" >Nationality<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                </div>
                <div id="rowId" class="parent_div">
                    <div class="row foreignworkerdtl">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control passport_no" name="passport_no[]" onchange="getForeignWorkerDtls(this)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control name" name="name[]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <input type="date" name="start_date[]" class="form-control start_date">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="date" name="end_date[]" class="form-control end_date">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select  name="nationality[]" class="form-control nationality" style="width: 100%;">
                                    <option value=""> -Select-</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->dropdown_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="adddiv"></div>
                <span class="btn btn-success btn-sm float-right" id="add"> <i class="fas fa-plus fa-sm">Add</i></span><br>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>
                        valid License copy
                    </em>
                </li>
                <li>
                    <em>
                        Tax Clearance
                    </em>
                </li>
                <li>
                    <em>
                        CV/Skills certificate                    
                    </em>
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <!-- card body ends -->
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-ban"></i> RESET</button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script>
        id=1;
        $(document).ready(function () {
            $('.select2bs4').on('change', function () {
                $(this).valid();
            });
            $('#from_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });
            $('#to_date').datetimepicker({
                format: 'MM/DD/YYYY',
            });

            $("#add").click(function(){
				$("#rowId").clone().attr('id', 'rowId'+id).after("#id").appendTo("#adddiv").find("input[type='text'],select,input[type='date']").val("");
                $addRow ='<span id="remove'+id+'" class="btn-group" style=" margin-top:-50px; float:right">' 
                +'<span id="remove" onClick="removeForm('+id+')"' 
                +'class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-sm"></i> Delete</span></span>'
                +'<div id="line'+id+'"></div>';
                $('#adddiv').append($addRow);
                id++;
            });

            $('#application_type_id').on('change',function(e) {
                var application_type_id=e.target.value;
                if(application_type_id == "38"){
                    $("#personalDtl").hide();
                    $("#workerId").show();
                    $("#dispatchNo").hide();
                }
                else if(application_type_id == "40"){
                    $("#personalDtl").hide();
                    $("#workerId").show();
                    $("#dispatchNo").show();
                } 
                else if(application_type_id == "41"){
                    $("#personalDtl").show();
                    $("#workerId").hide();
                    $("#dispatchNo").show();
                } 
                else{
                    $("#personalDtl").show();
                    $("#workerId").hide();
                    $("#dispatchNo").hide();

                } 
            });
            $('#form_data').validate({
                rules: {
                    license_no: {
                       required: true,
                    },
                    application_type_id: {
                        required: true,
                    },
                    company_title_name: {
                       required: true,
                    },
                    cid_no: {
                       required: true,
                    },
                    email: {
                       required: true,
                    },
                    dispatch_no: {
                        required: function(element) {
                            var a=$("#application_type_id").val();
                            if(a==40){
                                return $("#application_type_id").val() ==40;
                             }else{
                            return $("#application_type_id").val() ==41;
                             }
                        }
                    },

                    number: {
                        required: function(element) {
                             return $("#application_type_id").val() ==38 || $("#application_type_id").val() ==40;
                        },
                    },
                    country_id: {
                        required: function(element) {
                            return $("#application_type_id").val() ==38 || $("#application_type_id").val() ==40;
                        },
                    },
                    from_date: {
                        required: function(element) {
                            return $("#application_type_id").val() ==38 || $("#application_type_id").val() ==40;
                        },
                    },
                    to_date: {
                        required: function(element) {
                            return $("#application_type_id").val() ==38 || $("#application_type_id").val() ==40;
                        },
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
                    "passport_no[]": {
                        required: function(element) {
                             return $("#application_type_id").val() ==39 || $("#application_type_id").val() ==41;
                        },
                    },
                    "name[]": {
                        required: function(element) {
                            return $("#application_type_id").val() ==39 || $("#application_type_id").val() ==41;
                        },
                    },
                    "start_date[]": {
                        required: function(element) {
                            return $("#application_type_id").val() ==39 || $("#application_type_id").val() ==41;
                        },
                    },
                    "end_date[]": {
                        required: function(element) {
                            return $("#application_type_id").val() ==39 || $("#application_type_id").val() ==41;
                        },
                    },
                    "nationality[]": {
                        required: function(element) {
                            return $("#application_type_id").val() ==39 || $("#application_type_id").val() ==41;
                        },
                    },
                   },
                messages: {
                    license_no: {
                         required: "Please enter the license number",
                    },
                    application_type_id: {
                          required: "Please select the application type",
                    },
                    company_title_name: {
                    required: "Please enter the company name",
                    },
                    contact_no: {
                        required: "Please provide a total number of workers",
                        digits: "This field accept only digits",
                    },
                    country_id: {
                        required: "Please select the nationality",
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
                    remarks: {
                        required: "Please enter remarks",
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

        function removeForm(id){  
            if (confirm('Are you sure you want to delete this form?')){
                $('#rowId'+id).remove();
                $('#remove'+id).remove();
                $('#line'+id).remove();
            }
        }
        function getWorkPermitDetails(dispatch_no){
            var application_type_id=$("#application_type_id").val();
            $.ajax({
                        url:'/application/get-work-permit-dtls',
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                dispatch_no: dispatch_no,
                            },
                        success:function(data) {
                            console.log(data);
                            if(data.status=='false'){
                                $('#alertTraineeMgsId').show().delay(3000).queue(function (n) {
                                $(this).hide();
                                n();
                                    });
                                $('#dispatch_no').val('');
                                $('#cid_no').val('');
                                $('#license_no').val('');
                                $('#email').val('');
                                $('#company_title_name').val('');
                                    if(application_type_id==40){
                                    $('#number').val('');
                                    $('#from_date').val('');
                                    $('#to_date').val('');
                                    $('#country_id  option:gt(0)').remove();
                                    }
                                $('#dzongkhag_id option:gt(0)').remove();
                                $('#gewog_id option:gt(0)').remove();
                                $('#village_id option:gt(0)').remove();
                             }else{
                            $('#cid_no').val(data.cid_no);
                            $('#license_no').val(data.license_no);
                            $('#email').val(data.email);
                            $('#company_title_name').val(data.company_name);
                            if(application_type_id==40){
                                $('#number').val(data.total_worker);
                                $('#country_id').val(data.country_id).trigger("change");
                            }
                            $('#dzongkhag_id').val(data.dzongkhag_id).trigger("change");
                            getGewogDropDown(data.dzongkhag_id,data.gewog_id,data.village_id);
                        }
                    }
                });
        }

        function getForeignWorkerDtls(this_id){
            slert();
            var application_type_id=$("#application_type_id").val();
            var passport_no=$(this_id).val();
            var parentdivId = $(this_id).parents("div.parent_div").attr('id');
            curRow = $('#'+parentdivId).find('div.foreignworkerdtl');
             if(application_type_id==41){
            $.ajax({
                        url:'/application/get-foreign-worker-dtls',
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                passport_no: passport_no,
                            },
                        success:function(data) {
                            console.log(data);
                            if(data.status=='false'){
                                $('#alertPassportMgsId').show().delay(3000).queue(function (n) {
                                $(this).hide();
                                n();
                                });
                            curRow.find('.passport_no').val('');
                            curRow.find('.name').val('');
                            curRow.find('.start_date').val('');
                            curRow.find('.end_date').val('');
                            curRow.find('.nationality option:gt(0)').remove();
                             }else{
                            curRow.find('.name').val(data.name);
                            curRow.find('.start_date').val(data.start_date);
                            curRow.find('.nationality').val(data.nationality).trigger("change");

                        }
                    }
                });
            } 
        }

        function getGewogDropDown(dzongkhag_id,gewog_id,village_id){
            if(dzongkhag_id){
            $("#gewog_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_gewog_masters',
                           id: 'id',
                           name: 'gewog_name',
                     parent_id: dzongkhag_id,
               parent_name_id: 'dzongkhag_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                   $('select[name="gewog_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
               $('#gewog_id').val(gewog_id).trigger("change");
               getvillageDroDown(gewog_id,village_id);                  
             }
         });

        }else{
         $("#gewog_id option:gt(0)").remove();	
         $("#village_id option:gt(0)").remove();
        }
        }

        function getvillageDroDown(gewog_id,villageId){
        if(gewog_id){
         $("#village_id option:gt(0)").remove();	
         $.ajax({			   
                  url:'/json-dropdown',
                  type:"GET",
                  data: {
                     table_name: 't_village_masters',
                           id: 'id',
                           name: 'village_name',
                     parent_id: gewog_id,
               parent_name_id: 'gewog_id'					 
            },
            success:function (data) {
            $.each(data, function(key, value) {
                  $('select[name="establishment_village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
               });
               $('#village_id').val(villageId).trigger("change");
            }
         });
        }else{
         $("#village_id option:gt(0)").remove();	
      }
    }
    </script>
@endsection



