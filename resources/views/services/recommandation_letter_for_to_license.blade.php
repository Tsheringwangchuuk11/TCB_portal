@extends('layouts.manager')
@section('page-title','Recommandation Letter for Tour operator')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
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
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">License No.<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="license_no" onchange="getTourOperatorDetails(this.value)">
                    </div>
                </div>
                <div class="col-md-5  offset-md-2">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="license_date" id="license_date" readonly="true">
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" id="company_title_name" readonly="true">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Location <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="location" id="location" readonly="true">
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" id="owner_name" readonly="true">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" id="contact_no" readonly="true">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Owner CID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" id="cid_no" readonly="true">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Recommandation Letter Type<span class="text-danger">*</span> </label>
                      <select class="form-control  select2bs4" name="letter_sample" id="letter_sample">
                        <option value="">- Select -</option>
                        @foreach ($letterTypes as $letterType)
                        <option value="{{$letterType->id}}">{{$letterType->recommandation_letter_type}}</option>
                        @endforeach
                    </select>
                    </div>
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
            <ol id="sample12">
                <li>
                    <em>Application letter </em>      
                </li>
                <li>
                    <em>License copy front page (photo, name of the company & proprietor) </em>      
                </li>
                <li>
                    <em>License copy of the valid date </em>      
                </li>
            </ol>
            <ol id="sample3" style="display: none">
                <li>
                    <em> Application letter (clearly mention the designation of the employees)   </em>      
                </li>
                <li>
                    <em> License copy front page (photo, name of the company & proprietor) </em>      
                </li>
                <li>
                    <em>License copy of the valid date</em>      
                </li>
                <li>
                    <em>Copy of valid passport</em>      
                </li>
            </ol>
            <ol id="sample4" style="display: none">
                <li>
                    <em> Application letter (clearly mention the designation of the employees)    </em>      
                </li>
                <li>
                    <em> License copy front page (photo, name of the company & proprietor)   </em>      
                </li>
                <li>
                    <em>License copy of the valid date </em>      
                </li>
                <li>
                    <em>Copy of valid passport </em>      
                </li>
                <li>
                    <em>Invitation from the organizing agency</em>      
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
    $('#letter_sample').on('change',function(e) {
        var lettersample=e.target.value;
        if(lettersample=="sample3"){
            $("#sample3").show();
            $("#sample12").hide();
            $("#sample4").hide();
        } else if(lettersample=="sample4"){
            $("#sample3").hide();
            $("#sample12").hide();
            $("#sample4").show();
        }
        else{
            $("#sample3").hide();
            $("#sample12").show();
            $("#sample4").hide();
        } 
    });
});
$(document).ready(function () {
    $('.select2bs4').on('change', function () {
        $(this).valid();
    });
});
</script>
@endsection