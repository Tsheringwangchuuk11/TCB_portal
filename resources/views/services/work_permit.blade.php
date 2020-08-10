@extends('layouts.manager')
@section('page-title','Issuance Of Recommendation Letter For Work Permit')
@section('content')
<form class="bootstrap-form" action="{{ url('application/save-application') }}" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Company Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Recommendationn Letter Type<span class="text-danger"> *</span></label>
                                <select class="form-control" name="recommendation_type" id="recommendation_type">
                                    <option value="">- Select -</option>
                                    @foreach (config()->get('settings.recommendationLetterType') as $k => $v)
                                    <option value="{{ $k }}" {{ old('recommendation_type') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2" style="display: none" id="licenseId">
                            <div class="form-group">
                                <label for="" >License No<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Comapany Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Comapany Location<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: none" id="workerId">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="" >Total workers<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Nationality<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="nationality" value="{{ old('applicant_name') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="personalDtl" style="display:none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Personal Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" >Name<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" >Passport No.<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" >Validity Date<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" >Nationality<span class="text-danger"> *</span></label>
                        </div>
                    </div>
                </div>
                <div id="rowId">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="passport_no" value="{{ old('passport_no') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="validity_date" class="form-control" value="{{ old('validity_date') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}" autocomplete="off">
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

        $(document).ready(function(){
            $('#recommendation_type').on('change',function(e) {
                var recommendation_type=e.target.value;
                if(recommendation_type == "3" || recommendation_type == "5"){
                    $("#personalDtl").hide();
                    $("#licenseId").hide();
                    $("#workerId").show();
                } 
                else{
                    $("#personalDtl").show();
                    $("#licenseId").show();
                    $("#workerId").show();

                } 
            });
        });
    </script>
@endsection



