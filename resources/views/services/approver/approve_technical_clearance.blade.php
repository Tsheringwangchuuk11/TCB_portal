@extends('layouts.manager')
@section('page-title','Technical Clearance Registration')
@section('content')
<form action="{{ url('verification/technical-clearance') }}" method="POST" id="form_Id" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" name="applicant_id" value="{{ $applicantInfo->applicant_id }}">
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
                                <label for="" >Application Number<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="application_no" value="{{ old('application_no',$applicantInfo->application_no) }}" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Purpose<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="purpose_id" id="purpose_id" style="width: 100%;">
                                    <option value="">- Select -</option>
                                    @foreach ($purposes as $purpose)
                                    <option value="{{ $purpose->id }}" {{ old('purpose_id', $purpose->id) == $applicantInfo->application_type_id ? 'selected' : '' }}>{{$purpose->dropdown_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Accommodation Type<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="accomodation_type_id" id="accomodation_type_id" style="width: 100%;">
                                    <option value="">- Select -</option>
                                    @foreach ($accommodationtypes as $accommodationtype)
                                    <option value="{{ $accommodationtype->id }}" {{ old('accomodation_type_id', $accommodationtype->id) == $applicantInfo->star_category_id ? 'selected' : '' }}>{{$accommodationtype->dropdown_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name',$applicantInfo->applicant_name) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">CID No.<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no', $applicantInfo->cid_no) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no',$applicantInfo->contact_no) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="proposed_rooms_no" value="{{ old('proposed_rooms_no', $applicantInfo->number) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                                <input type="date" name="tentative_cons" class="form-control" value="{{ old('tentative_cons', $applicantInfo->tentative_cons) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="tentative_com" value="{{ old('tentative_com', $applicantInfo->tentative_com) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="drawing_date" value="{{ old('drawing_date', $applicantInfo->drawing_date) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control email" value="{{ old('email',$applicantInfo->email) }}" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Proposed location for construction</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                        <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;">
                            <option value=""> -Select-</option>
                            @foreach ($dzongkhagLists as $dzongkhagList)
                            <option value="{{ $dzongkhagList->id }}" {{ old('dzongkhag_id', $dzongkhagList->id) == $applicantInfo->dzongkhag_id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                        <label for="">Gewog<span class="text-danger"> *</span></label>
                        <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;">
                            <option value="">{{$applicantInfo->gewog_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;">
                            <option value="{{$applicantInfo->establishment_village_id}}">{{$applicantInfo->village_name}}</option>
                        </select>
                    </div>
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
                    <a href="{{ url($documentInfo->upload_url) }}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-link"></i> View</a>                
                </div>
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse                
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button name="status" value="APPROVED" class="btn btn-success">
                <li class="fas fa-check"></li>
                APPROVE
            </button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                <li class="fas fa-times"></li>
                REJECT
            </button>
        </div>
    </div>
    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Message</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure,you want to reject &hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button name="status" value="REJECTED" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>
<form>
@endsection





