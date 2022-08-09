@extends('layouts.manager')
@section('page-title','Tour Operators/Travel Agents')
@section('content')
<form action="{{ url('verification/tour-operator-fam') }}" method="POST" files="true" id="form_data" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
    <input type="hidden" class="form-control" name="fam_type" value="T">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Application Number<span clas="text-danger"> *</span></label>
                        <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Name<span clas="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="name" value="{{ $applicantInfo->applicant_name }}" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">CID <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="agent_cid_no" value="{{ $applicantInfo->cid_no }}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Designation <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control required" name="designation" value="{{ $applicantInfo->designation }}" disabled>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Email <span class="text-danger"> *<span></label>
                                <input type="text" class="form-control" name="email" value="{{ $applicantInfo->email }}" disabled>
                            </div>
                        </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Website<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="web_site" value="{{ $applicantInfo->webpage_url }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Agency Name <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_name" class="form-control" value="{{ $applicantInfo->company_title_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="form-group">
                            <label for="">Agency Address <span class="text-danger"> *</span></label>
                            <input type="text" name="agency_address" class="form-control" value="{{ $applicantInfo->company_title_name }}" disabled>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">City <span class="text-danger"> *<span></label>
                                    <input type="text" class="form-control required" name="city_id" value="{{ $applicantInfo->city }}" disabled>
                                </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Country <span class="text-danger"> *</span></label>
                                <select  name="country" class="form-control select2bs4" style="width: 100%;" disabled>
                                    <option value=""> -Select-</option>
                                    @foreach ($countries as $country)
                                      <option value="{{ $country->id }}" {{ old('country_id', $country->id) == $applicantInfo->country_id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for=""> From Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control" name="from_date" value="{{ $applicantInfo->from_date }}" disabled> 
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">To Date <span class="text-danger"> *</span></label><small class="text-danger text-right">[ Intended date of travel ]</small>
                                <input type="text" class="form-control datepicker required" name="to_date" value="{{ $applicantInfo->to_date }}" disabled>
                            </div>
                        </div>
                 </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Agency profile/details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Agency established</label><small class="text-danger text-right">[Year]</small>
                        <input type="text" class="form-control" name="established_year" value="{{ $applicantInfo->financial_year }}" disabled>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Country<span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">City<span class="text-danger">*</span> </label>
                    </div>
                </div>
                @foreach ($marketingdtls as $marketingdtl)
                <div class="row">
                <div class="form-group col-md-5">
                    <select class="form-control" name="country_id[]">
                        <option value=""> - Select - </option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $country->id) == $marketingdtl->country_id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 offset-md-2 ">
                    <input type="text" class="form-control" name="city[]" value="{{ $marketingdtl->city }}">
                </div>
            </div>
                @endforeach
                </div>
        </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Bhutan Promotion</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Do you currently sell Destinations in Asia<span class="text-danger"> *</span></label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="radio" name="sell_destination" value="1" {{ $applicantInfo->sell_destination == 1 ? 'checked':'' }}><span>Yes</span>
                        <input type="radio" name="sell_destination" value="0" {{ $applicantInfo->sell_destination == 0 ? 'checked':'' }}><span>No</span>
                    </div>
                </div>
                <div class="col-md-3 offset-md-2">
                    <div class="form-group">
                        <label for="">Do you currently sell Bhutan <span class="text-danger"> *</span></label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="radio" name="sell_bhutan" value="1" {{ $applicantInfo->sell_bhutan == 1 ? 'checked':'' }}><span>Yes</span>
                        <input type="radio" name="sell_bhutan" value="0" {{ $applicantInfo->sell_bhutan == 0 ? 'checked':'' }}><span>No</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">If Yes,</label> <small class="text-danger text-right"> [Since when (year)]</small>
                        <input type="year" name="destination_year" class="form-control" value="{{ $applicantInfo->destination_year }}" disabled>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">If No,</label> <small class="text-danger text-right">[when do you intend to sell Bhutan as a destination (year) ]</small>
                        <input type="year" name="bhutan_year" class="form-control" value="{{ $applicantInfo->bhutan_year }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Other Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Purpose of visit </label><small class="text-danger text-right">[Please mention your purpose of visit]</small>
                        <textarea class="form-control" name="visit_purpose" rows="2" disabled>{{ $applicantInfo->visit_purpose }}</textarea>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="form-group">
                        <label>Feedback</label> <small class="text-danger text-right"> [Please share your feedback on marketing and promoting Bhutan if any]</small>
                        <textarea class="form-control" name="remarks" rows="2" autocomplete="off" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="form-group col-md-10">
                        <label>Marketing Activities</label><small class="text-danger text-right">[Please mention the marketing activities you use]</small>
                    </div>
            </div>
            @foreach ($activities as $activity)
            <div class="col-md-10">
                <div class="form-group">
                  <textarea class="form-control" name="activities[]" disabled>{{ $activity->activities }}</textarea>
                </div>
            </div>
            @endforeach
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
                    <!-- <div class="form-group col-md-6">
                        <a href="{{ url($documentInfo->upload_url) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-link"></i> View</a>                
                    </div> -->
                    @empty
                    <div class="form-group col-md-12">
                        <p>No data availlable</p>
                    </div>
                    @endforelse                
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Remarks <span class="text-danger">*</span> </label>
                        <textarea type="text" class="form-control" name="remarks" row="3" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
@endsection







