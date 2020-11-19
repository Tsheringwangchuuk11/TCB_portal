@extends('layouts.manager')
@section('page-title','Grievance')
@section('content')
<form action="{{ url('feedback/approved-grievance-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Complainant information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Application No</label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Applicant Type<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 " name="applicant_type_id" id="applicant_type_id">
                            <option value="">- Select -</option>
                            @foreach ($applicantTypes as $applicantType)
                            <option value="{{ $applicantType->id }}" {{ old('service_provider_id', $applicantType->id) == $applicantInfo->applicant_type ? 'selected' : '' }}>{{ $applicantType->dropdown_name }}</option>
                            @endforeach
                        </select>
                        -
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($applicantInfo->applicant_type ==4)
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of complainant <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="complainant_name" value="{{ $applicantInfo->complainant_name }}">
                    </div>
                </div>
                @else
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Name of the Representative:
                        <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="complainant_name" value="{{ $applicantInfo->complainant_name }}">
                    </div>
                </div>
                @endif
                <div class="col-md-5  offset-md-2">
                    <div class="form-group">
                        <label for="">Authentic address for correspondence <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="complainant_address" value="{{ $applicantInfo->complainant_address }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Telephone<span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="complainant_telephone_no" value="{{ $applicantInfo->complainant_telephone_no }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="complainant_mobile_no" value="{{ $applicantInfo->complainant_mobile_no }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="complainant_email" value="{{ $applicantInfo->complainant_email }}">
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
                        <input type="text" class="form-control" name="respondent_name" value="{{ $applicantInfo->respondent_name }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label>Category of service provider <span class="text-danger">*</span> </label>
                        <select class="form-control select2bs4" name="service_provider_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($serviceproviders as $serviceprovider)
                            <option value="{{ $serviceprovider->id }}" {{ old('service_provider_id', $serviceprovider->id) == $applicantInfo->service_provider_id ? 'selected' : '' }}>{{ $serviceprovider->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Telephone<span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="respondent_telephone_no" value="{{ $applicantInfo->respondent_telephone_no }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Mobile Number <span class="text-danger">*</span> </label>
                        <input type="number" class="form-control" name="respondent_mobile_no" value="{{ $applicantInfo->respondent_mobile_no }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Address <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="respondent_address" value="{{ $applicantInfo->respondent_address }}">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Email <span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" name="respondent_email" value="{{ $applicantInfo->respondent_email }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Summary of the Claim<span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="claim_summary"  row="4">{{ $applicantInfo->respondent_email }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Document Attachment</h4>
        </div>
        <div class="card-body">
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
                    <textarea type="text" class="form-control" name="remedy_sought" row="4">{{ $applicantInfo->respondent_email }}</textarea>
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
                            @foreach ($dzongkhagLists as $dzongkhagList)
                            <option value="{{$dzongkhagList->id}}" {{ old('location_id', $applicantInfo->location_id) == $dzongkhagList->id ? 'selected' : '' }}>{{$dzongkhagList->dzongkhag_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Date <span class="text-danger">*</span> </label>
                        <input type="date" name="date" class="form-control" value="{{ $applicantInfo->created_at }}">
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($roles[0]==7)
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Receiver Email</label>
                        <select class="form-control select2bs4" name="userId" id="userId">
                            <option value="">- Select -</option>
                            @foreach ($emailLists as $emailList)
                            <option value="{{ $emailList->id}}">{{$emailList->email}}</option>
                            @endforeach
                        </select>
                        <div id="userid_error" class="text-danger"></div>
                    </div>
                </div>
                @else
                <div class="form-group col-md-5">
					<label for="">Remarks From  Secretariat Services<span class="text-danger">*</span> </label>
					<textarea type="text" class="form-control" name="ss_remarks" row="3">{{ $applicantInfo->remarks }}</textarea>
                </div>
                @endif
                <div class="form-group col-md-5 offset-md-2">
					<label for="">Remarks <span class="text-danger">*</span> </label>
					<textarea type="text" class="form-control" id="remarks" name="remarks" row="3"></textarea>
                    <div id="remarks_error" class="text-danger"></div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button name="status" value="APPROVED" class="btn btn-success">
                <li class="fas fa-check"></li>
                APPROVE
            </button>
            @if ($roles[0]==7)
                <button name="status"value="FORWARD" class="btn btn-info" onclick="return requiredRecieverEmail()">
                    <li class="fas fa-times"></li>
                    FORWARD
                </button>
            @endif
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script>
        function requiredRecieverEmail() {
            $("#userid_error").html('');
            if($("#userId").val() ==""){
            $("#userid_error").html('Please select the receiver email');
            return false;
            }
            $("#remarks_error").html('');
            if($("#remarks").val() ==""){
                    $("#remarks_error").html('Please provide reason for forward!');
                return false;
            }
        }
    </script>
@endsection