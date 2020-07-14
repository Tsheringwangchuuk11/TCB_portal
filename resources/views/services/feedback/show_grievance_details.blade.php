@extends('layouts.manager')
@section('page-title','Grievance')
@section('content')
<form action="{{ url('application/save-grievance-application') }}" class="form-horizontal" method="POST" enctype="multipart/form-data" id="formdata">
  @csrf
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
            <select class="form-control select2bs4 " name="applicant_type" id="applicant_type">
                <option value="">- Select -</option>
                @foreach (config()->get('settings.applicanttype') as $k => $v)
                <option value="{{ $k }}" {{ old('applicanttype',$applicantInfo->applicant_type) == $k ? 'selected' : '' }}>{{ $v }}</option>
                @endforeach
            </select>        
            </div>
        </div>
    </div>
    <div class="row">
        @if ($applicantInfo->applicant_type === 'P')
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
                <option value="{{ $serviceprovider->id }}" {{ old('service_provider_id', $serviceprovider->id) == $applicantInfo->service_provider_id ? 'selected' : '' }}>{{ $serviceprovider->service_provider_name }}</option>
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
        <div class="row">
            <div class="form-group col-md-6">
                <label>Title</label>
            </div>
            <div class="form-group col-md-6">
                <label>Download Files</label>
            </div>
            @forelse ($documentInfos as $documentInfo)
            <div class="form-group col-md-6">
                <span>{{ $documentInfo->document_name }}</span>
            </div>
            <div class="form-group col-md-6">
            <span><a href="{{ URL::to($documentInfo->upload_url) }}">{{ $documentInfo->document_name }}</a></span>
            </div>
            @empty
            <div class="form-group col-md-12">
                <p>No data availlable</p>
            </div>
            @endforelse                
        </div>
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
            <select class="form-control select2bs4" name="village_id">
                <option value="">- Select -</option>
                @foreach ($locations as $location)
                <option value="{{$location->id}}" {{ old('village_id', $applicantInfo->location_id) == $location->id ? 'selected' : '' }}>{{$location->location_name}}</option>
                @endforeach
            </select>
            </div> 
        </div>
        <div class="col-md-5 offset-md-2">
            <div class="form-group">
            <label for="">Date <span class="text-danger">*</span> </label>
            <input type="date" name="date" class="form-control" value="{{ $applicantInfo->date }}">
            </div>       
        </div>
        </div>
    </div>
    {{-- <div class="card-footer text-center">
        <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
        <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
    </div> --}}
    </div>
</form>
@endsection