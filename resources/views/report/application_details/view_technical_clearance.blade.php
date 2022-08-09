@extends('layouts.manager')
@section('page-title','Technical Clearance Registration')
@section('content')
<form action="{{ url('verification/technical-clearance') }}" method="POST" id="form_Id" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" id="service_id" value="{{ $applicantInfo->service_id }}">
    <input type="hidden" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" name="applicant_id" value="{{ $applicantInfo->applicant_id }}">
    <input type="hidden" class="form-control" name="service_name" value="{{ $applicantInfo->name }}">
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
                                <input type="text" class="form-control" name="application_no" value="{{ old('application_no',$applicantInfo->application_no) }}" disabled>
                                <input type="hidden" class="form-control" name="dispatch_no" value="{{ old('dispatch_no',$applicantInfo->dispatch_no) }}">
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="" >Purpose<span class="text-danger"> *</span></label>
                                <select class="form-control select2bs4" name="purpose_id" id="purpose_id" style="width: 100%;" disabled>
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
                                <select class="form-control select2bs4" name="accomodation_type_id" id="accomodation_type_id" style="width: 100%;" disabled>
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
                                <input type="text" class="form-control" name="name" value="{{ old('name',$applicantInfo->applicant_name) }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Citizen ID<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="cid_no" value="{{ old('cid_no', $applicantInfo->cid_no) }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Contact No.<span class="text-danger"> *</span></label>
                                <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no',$applicantInfo->contact_no) }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="proposed_rooms_no" value="{{ old('proposed_rooms_no', $applicantInfo->number) }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                                <div class="input-group date" id="tentative_cons" data-target-input="nearest">
                                    <input type="text" name="tentative_cons" class="form-control" value="{{ old('tentative_cons', $applicantInfo->tentative_cons) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="tentative_com" data-target-input="nearest">
                                    <input type="text" name="tentative_com" class="form-control" value="{{ old('tentative_com',$applicantInfo->tentative_com) }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                                <div class="input-group date" id="drawing_date" data-target-input="nearest">
                                    <input type="text" name="drawing_date" class="form-control" value="{{ old('drawing_date', $applicantInfo->drawing_date) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email<span class="text-danger"> *</span></label>
                                <input type="email" name="email" class="form-control email" value="{{ old('email',$applicantInfo->email) }}" disabled>
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
                        <select  name="dzongkhag_id" id="dzongkhag_id" class="form-control select2bs4 dzongkhagdropdown" style="width: 100%;" disabled>
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
                        <select  name="gewog_id" class="form-control select2bs4 gewogdropdown" id="gewog_id" style="width: 100%;" disabled>
                            <option value="">{{$applicantInfo->gewog_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Village<span class="text-danger"> *</span></label>
                        <select  name="village_id" class="form-control select2bs4" id="village_id" style="width: 100%;" disabled>
                            <option value="{{$applicantInfo->establishment_village_id}}">{{$applicantInfo->village_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($applicantInfo->application_type_id==23)
        <div class="card">
            <div class="card-header">
                <h4 class="card-tile">New Owner Information</h4>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Owner Name <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_owner_name" value="{{ $applicantInfo->new_owner_name }}" disabled>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Citizen ID <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_cid_no" value="{{ $applicantInfo->new_cid_no }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">Contact No.<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="new_contact_no" value="{{ $applicantInfo->new_contact_no }}" disabled>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Email <span class="text-danger"> *</span></label>
                            <input type="email" class="form-control" name="new_email" value="{{ $applicantInfo->new_email }}" disabled>
                        </div>
                    </div>
            </div>
        </div>
    @endif
<form>
@endsection






