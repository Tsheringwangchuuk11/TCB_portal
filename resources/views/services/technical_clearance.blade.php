@extends('layouts.manager')
@section('page-title','Issuance Of Technical Clearance Of Tourist Standard Accommodation')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
@csrf
<input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
<input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">General Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="" >Purpose<span class="text-danger"> *</span></label>
                            <select class="form-control" name="purpose" id="purpose">
                                <option value="">- Select -</option>
                                @foreach (config()->get('settings.purpose') as $k => $v)
                                <option value="{{ $k }}" {{ old('purpose') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2" style="display: none" id="dispatchNumberId">
                        <div class="form-group">
                            <label for="">Dispatch Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Accommodation Type<span class="text-danger"> *</span></label>
                            <select class="form-control" name="accommodationtype" id="accommodationtype">
                                <option value="">- Select -</option>
                                @foreach (config()->get('settings.accommodationType') as $k => $v)
                                <option value="{{ $k }}" {{ old('accommodationtype') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="" >Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">CID No.<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control numeric-only" name="cid_no" value="{{ old('cid_no') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Contact No.<span class="text-danger"> *</span></label>
                            <input type="text" name="contact_no" class="form-control numeric-only" value="{{ old('contact_no') }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Email<span class="text-danger"> *</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for=""> Note <span class="text-danger"> *</span> <strong class="text-danger"> [ Proposed location for construction ]</strong></label>
                    </div>
                </div>
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
                            <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                                <option value=""> -Select-</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Village<span class="text-danger"> *</span></label>
                            <select  name="gewog_id" class="form-control select2bs4" id="gewog_id" style="width: 100%;">
                                <option value=""> -Select-</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="number" value="{{ old('number') }}" autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Tentative construction date<span class="text-danger"> *</span> </label>
                            <input type="date" name="tentative_cons" class="form-control" value="{{ old('tentative_cons') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                            <input type="date" class="form-control" name="tentative_com" value="{{ old('tentative_com') }}" autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                            <input type="date" class="form-control" name="drawing_date" value="{{ old('drawing_date') }}" autocomplete="off" >
                        </div>
                    </div>
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
        <ol id="new_application" style="display:none">
            <li>
                <em>An application addressed to the Director General of TCB requesting the issuance
                of technical clearance.</em>   
                </em>
            </li>
            <li>
                <em>
                Architectural drawings 
                </em>
            </li>
        </ol>
        <ol id="renewal" style="display:none">
            <li>
                <em>An application addressed to the Director General of TCB with clear justification
                on renewal of technical clearance.
                </em> 
            </li>
            <li>  
                <em>Surrender the previous technical clearance issued to the proponent..</em>
            </li>
        </ol>
        <ol id="change_design" style="display:none">
            <li>
                <em>An application addressed to the Director General of TCB with clear justification
                for issuance of new technical clearance.
                </em>  
            </li>
            <li> 
                <em>
                Submit the new architectural drawings
                </em>  
            </li>
            <li>
                <em>
                Surrender the previous technical clearance issued to the proponent.
                </em>   
            </li>
        </ol>
        <ol id="ownership_change" style="display:none">
            <li>
                <em>An application addressed to the Director General of TCB with clear justification
                for change in ownership.
                </em> 
            </li>
            <li>
                <em>
                Original copy of undertaking letter signed by both parties..
                </em>   
            </li>
            <li>
                <em>
                Surrender the previous technical clearance issued to the proponent.   
                </em>   
            </li>
        </ol>
        @include('services/fileupload/fileupload')
    </div>
    <!-- card body ends -->
    <div class="card-footer text-center">
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
});
$(document).ready(function(){
    $('#purpose').on('change',function(e) {
        var purpose=e.target.value;
        if(purpose == "1"){
            $("#new_application").show();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").hide();
            $("#dispatchNumberId").hide();
        } 
        else if(purpose == "2"){
            $("#new_application").hide();
            $("#renewal").show();
            $("#change_design").hide();
            $("#ownership_change").hide();
            $("#dispatchNumberId").show();
        } 
        else if(purpose == "3"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").show();
            $("#ownership_change").hide();           
            $("#dispatchNumberId").show();

        }
        else if(purpose == "4"){
            $("#new_application").hide();
            $("#renewal").hide();
            $("#change_design").hide();
            $("#ownership_change").show();
            $("#dispatchNumberId").show();
        }
    });
});
</script>
@endsection



