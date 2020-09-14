@extends('layouts.manager')
@section('page-title','Recommendation Letter for Tourism Industry Partners')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">General Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Recommandation Letter for<span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="application_type_id" id="application_type_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($applicationTypes as $applicationType)
                            <option value="{{$applicationType->id}}">{{$applicationType->dropdown_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="companyvalidationinfo">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Name of the Company<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="company_title_name" id="company_title_name">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">License No.<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="license_no" onchange="getTourOperatorDetails(this.value)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Validity Date.<span class="text-danger">*</span> </label>
                            <input type="date" class="form-control" name="license_date" id="license_date">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Name of the proprietor<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="license_date" id="license_date">
                        </div>
                    </div>
                </div>
            </div>
            <div id="visainfo" style="display:none">
                <div id="rowId">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Event Type<span class="text-danger">*</span> </label>
                                <select class="form-control" name="letter_sample[]" id="event_id">
                                    <option value="">- Select -</option>
                                    @foreach ($eventFairDetails as $eventFairDetail)
                                    <option value="{{$eventFairDetail->id}}">{{$eventFairDetail->event_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">CID<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="cid_no" id="cid_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Name of the applicant<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="owner_name" id="owner_name">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Mobile No. <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="contact_no" id="contact_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Designation/Position<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="cid_no" id="cid_no">
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <label for="">Passport No.<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="cid_no" id="cid_no">
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
            <ol id="sample1">
                <li>
                    <em>License Copy (both sides)</em>      
                </li>
                <li>
                    <em>Passport Copy</em>      
                </li>
            </ol>
            <ol id="sample2" style="display: none">
                <li>
                    <em>License Copy (both sides)</em>      
                </li>
                <li>
                    <em>Passport Copy</em>      
                </li>
                <li>
                    <em>Invitation letter from the event organizer with sign & seal</em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
<form>
@endsection
@section('scripts')
<script>
    function getTourOperatorDetails(licenseNo){
        $.ajax({
              url:'/application/get-tour_operator-details/'+licenseNo,
               type: "GET",
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
               dataType: "json",
               success:function(data) {
                $('#company_title_name').val(data.company_name);
                $('#cid_no').val(data.cid_no);
                $('#owner_name').val(data.name);
                $('#license_date').val(data.license_date);
                $('#contact_no').val(data.contact_no);
                $('#location').val(data.location);
            } 
        });
     }

    $(document).ready(function(){
        $('#application_type_id').on('change',function(e) {
            var lettersample=e.target.value;
            if(lettersample == "44"){
                $("#sample2").show();
                $("#sample1").hide();
                $("#visainfo").show();

                
            } 
            else{
                $("#sample2").hide();
                $("#sample1").show();
                $("#visainfo").hide();
            } 
        });
    });

    $(document).ready(function () {
        $('.select2bs4').on('change', function () {
            $(this).valid();
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
      if (confirm('Are you sure you want to delete this form?')){
        $('#rowId'+id).remove();
        $('#remove'+id).remove();
        $('#line'+id).remove();
      }
    }
</script>
@endsection