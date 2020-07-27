@extends('frontend/layouts/template')
@section('page-title','Grievance')
@section('content')
<div class="col-8 offset-md-2 d-flex justify-content-center pt-3">
    <h3 class="text-default">Grievance</h3>
</div>
<div class="container">
<form action="{{url('save-grievance-application')}}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Complainant information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Applicant Type<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 " name="applicant_type" id="applicant_type" autocomplete="off">
                            <option value="">- Select -</option>
                            @foreach (config()->get('settings.applicanttype') as $k => $v)
                            <option value="{{ $k }}" {{ old('applicanttype') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2" id="complainant">
                    <div class="form-group">
                        <label for="">Name of complainant <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="complainant_name" id="complainant_name" value="{{ old('complainant_name') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2" style="display:None " id="representative">
                    <div class="form-group">
                        <label for="">Name of the Representative:
                        <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="representative_name" id="representative_name" value="{{ old('complainant_name') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Authentic address for correspondence <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="complainant_address" value="{{ old('complainant_address') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Telephone<span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="complainant_telephone_no" value="{{ old('complainant_telephone_no') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="complainant_mobile_no" value="{{ old('complainant_mobile_no') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="complainant_email" value="{{ old('complainant_email') }}" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Respondent</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of Respondent <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_name" value="{{ old('respondent_name') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label>Category of service provider <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="service_provider_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($serviceproviders as $serviceprovider)
                            <option value="{{ $serviceprovider->id }}">{{ $serviceprovider->service_provider_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Telephone<span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="respondent_telephone_no" value="{{ old('respondent_telephone_no') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="respondent_mobile_no" value="{{ old('respondent_mobile_no') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_address" value="{{ old('respondent_address') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="respondent_email" value="{{ old('respondent_email') }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Summary of the Claim<span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="claim_summary"  row="4" value="{{ old('claim_summary') }}" autocomplete="off"></textarea>
                </div>
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
                <li id="showlist" style="display: none">
                    <em>please provide a copy of the document authorizing the representation (“power of attorney”) together with the following details</em>      
                </li>
                <li>
                    <em>Please indicate what supporting documents you propose to submit in support of your Application and, where appropriate: (Please attach additional sheet where necessary to fully describe your evidence)</em>      
                </li>
                <li>
                    <em>This Claim is accompanied by:<br>
                    (a)	a copy of the contract document including email correspondences, itinerary, copy of remittance, between the Claimant and the Respondent
                    </em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Remedy sought</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="">Remedy sought<span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remedy_sought"  value="{{ old('remedy_sought') }}" row="4" autocomplete="off"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Statement of Adherence</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Location <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="location_id">
                            <option value="">- Select -</option>
                            @foreach ($locations as $location)
                            <option value="{{$location->id}}" {{ old('location_id')}}>{{$location->location_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Date <span class="text-danger">*</span> </label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>The above information is true and accurate to the best of my/our knowledge and belief.
                        The complaint submitted are genuine and not in bad faith and
                        all important information material for resolving of this complaint are shared or will be shared with the Tourism Council of Bhutan.
                    </p>
                </div>
                <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">we hereby declare that</label>
                    </div>
                  </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
</form>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('#applicant_type').on('change',function(e) {
        var applicantype=e.target.value;
        if(applicantype=="L" || applicantype=="T"){
            $("#representative").show();
            $("#showlist").show();
            $("#complainant").hide();
        }else{
            $("#complainant").show();
            $("#representative").hide();
            $("#showlist").hide();
        } 
    });

    //  fileupload
var count=0, deleteId;
$(function () {
   'use strict';
   $('#fileuploaded').fileupload({
      beforeSend:function(){
         $('#success').empty();
         $('.progress-bar').text('0%');
         $('.progress-bar').css('width', '0%');
      },
      uploadProgress:function(event, position, total, percentComplete){
         $('.progress-bar').text(percentComplete + '0%');
         $('.progress-bar').css('width', percentComplete + '0%');
     },
     add: function (e, data) {
         var uploadErrors = [];
         var acceptFileTypes = /(\.|\/)(gif|jpe?g|png|pdf|tiff)$/i;
         if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['name'])) {
            uploadErrors.push(data.originalFiles[0]['name'] + ' is not alloawed. Invalid file type.');
         }
         if(data.originalFiles[0]['size'] > 2000000) {				   
            uploadErrors.push(data.originalFiles[0]['name'] +' is too big, ' + parseInt(data.originalFiles[0]['size'] / 1024 / 1024) + 'M.. File size should not be greater than 2M.');
         }
         if(uploadErrors.length > 0) {
            $('#msgId').html(uploadErrors);
            $('#alertErrorId').show().delay(6000).queue(function (n) {
                  $(this).hide();
                  n();
            });
         } else {
            data.submit();
         }
      },
      url: 'documentattach',
      type: 'POST',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      autoUpload: true,
      dataType : 'json',
      success: function (data) {
          console.log(data);
         if (data.status == 'true') {
            $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
            $('.progress-bar').text('Uploaded');
            $('.progress-bar').css('width', '100%');
            jQuery.each(data.data, function (index, row) {
               $('#files').append('<div class="image_wrap">'
                  + '<input type="hidden" name="documentId[]" value="' + row.id + '"/><strong>' + row.document_name + '</strong>'
                  + ' <span onClick="deletefile(this.id,\'' + row.id + '\',\'' + row.upload_url + '\')" id="deleteId' + count + '" class="delete-line btn btn-danger btn-sm" data-file_id="' + row.id + '">'
                  + '<i class="fas fa-trash-alt"></i> Delete</span></div>');
               count++;
            });
         } else {
            $('#msgId').html(data.message);
            $('#alertErrorId').show().delay(6000).queue(function (n) {
                  $(this).hide();
                  n();
            });
         }
      },

    /*   progressall: function (e, data) {
         var progress = parseInt(data.loaded / data.total * 100, 10);
         $('#progress .progress-bar').css(
            'width',
            progress + '%'
         );
         setTimeout(function(){$(".progress").hide()}, 3000);
       }  */
   });
});
});

function deletefile(id,fileId,url){         
   if (confirm('Are you sure you want to delete this file?')){
      var id = id;
      var fileId = fileId;
      var url = url;
      $.ajax({
            url  : 'deletefile',
            type : "POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {id : fileId, url : url },                      
            success: function(data) {
            if (data == "success")
                  { $('#'+id).parent('div').remove(); }
               else
                  { alert('Something went wrong when deleteing the file, please try again'); }                    
            }
      });
   }
} 
$('#formdata').validate({
      ignore: [],
      rules: {
        complainant_email: {
            required: true,
            email: true,
         },
        
         applicant_type: {
            required: true,
         },
         respondent_name: {
            required: true,
         },
         complainant_name: {
            required: false,
         },
         complainant_address: {
            required: true,
         },
         representative_name: {
            required: false,
         },
         complainant_telephone_no: {
            required: true,
         },
         complainant_mobile_no: {
            required: true,
         },
         service_provider_id: {
            required: true,
         },
         claim_summary: {
            required: true,
         },
         remedy_sought: {
            required: true,
         },
         location_id: {
            required: true,
         },
         date: {
            required: true,
         },
         respondent_email: {
            required: true,
            email:true
         },
         terms: {
            required:true,
         },
         respondent_address: {
            required:true,
         },
         respondent_mobile_no: {
            required:true,
         },
         respondent_telephone_no: {
            required:true,
         },
      },
    messages: {
    terms: "Please accept our terms"
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
</script>
@endsection