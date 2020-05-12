@extends('layouts.manager')
@section('page-title','Registration of Tourist Standard Hotels')
@section('content')
<form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Application No.</label>
                    <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label>Registration Type</label>
                    <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                        <option value="">- Select -</option>
                        @foreach ($starCategoryLists as $starCategoryList)
                        <option value="{{ $starCategoryList->id }}" {{ old('star_category_id', $applicantInfo->star_category_id) == $starCategoryList->id ? 'selected' : '' }}> {{ $starCategoryList->star_category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">License Number</label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">License Date</label>
                    <input type="date" class="form-control" name="license_date" value="{{ $applicantInfo->license_date }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Hotel Name </label>
                    <input type="text" class="form-control" name="company_title_name"  value="{{ $applicantInfo->company_title_name }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $applicantInfo->owner_name }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">CID No.</label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $applicantInfo->address }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Contact No </label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5  offset-md-2">
                    <label for="">Fax </label>
                    <input type="text" class="form-control" name="fax" value="{{ $applicantInfo->fax }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Email</label>
                    <input type="email" class="form-control email" name="email" value="{{ $applicantInfo->email }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Internet Homepage</label>
                    <input type="text" class="form-control" name="webpage_url" value="{{ $applicantInfo->webpage_url }}" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Number of Beds</label>
                    <input type="text" class="form-control numeric-only" name="number" value="{{ $applicantInfo->number }}" autocomplete="off">
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Location</label>
                    <input type="text" class="form-control numeric-only" name="location_id" value="{{ $applicantInfo->location_id }}" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Room Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Room Type</label>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <label for="">Number of Room</label>
                </div>
            </div>
            @forelse ($roomInfos as $roomInfo)
            <div class="row">
                <div class="form-group col-md-5">
                    <select class="form-control required" name="room_type_id[]" id="room_type_id">
                        <option value=""> - Select Room - </option>
                        @foreach ($roomTypeLists as $roomTypeList)
                        <option value="{{ $roomTypeList->id }}" {{ old('room_type_id', $roomTypeList->id) == $roomInfo->room_type_id ? 'selected' : '' }}>{{ $roomTypeList->room_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5 offset-md-2">
                    <input type="text" class="form-control" name="room_no" value="{{$roomInfo->room_no}}" autocomplete="off">
                </div>
            </div>
            @empty
            <div class="form-group col-md-12">
                <p>No data availlable</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Staff Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Area</label>
                </div>
                <div class="form-group col-md-3">
                    <label>Division</label>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Name</label>
                </div>
                <div class="form-group col-md-3">
                    <label>Gender</label>
                </div>
            </div>
            <div id="row1">
                @forelse ($staffInfos as $staffInfo)
                <div class="row">
                    <div class="form-group col-md-3">
                        <select class="form-control" name="staff_area_id[]" id="staff_area_id">
                            <option value="">- Select -</option>
                            @foreach ($staffAreaLists as $staffAreaList)
                            <option value="{{ $staffAreaList->id }}" {{ old('staff_area_id', $staffAreaList->id) == $staffInfo->staff_area_id ? 'selected' : '' }}> {{ $staffAreaList->staff_area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select class="form-control required" name="hotel_div_id[]" id="hotel_div_id">
                            <option value="">- Select -</option>
                            @foreach ($hotelDivisionLists as $hotelDivisionList)
                            <option value="{{ $hotelDivisionList->id }}" {{ old('hotel_div_id', $hotelDivisionList->id) == $staffInfo->hotel_div_id ? 'selected' : '' }}> {{ $hotelDivisionList->hotel_div_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="staff_name" autocomplete="off" value="{{$staffInfo->staff_name}}">
                    </div>
                    <div class="form-group col-md-3">
                        <select  name="staff_gender" class="form-control required">
                            <option value="">---SELECT---</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                            <option value="{{ $k }}" {{ old('gender', $staffInfo->staff_gender) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                @empty
                <div class="form-group col-md-12">
                    <p>No data availlable</p>
                </div>
                @endforelse
                </div>
        </div>
    </div>
    @if ($checklistDtls->count() > 0)
        <h5>Checklist</h5>
        @foreach ($checklistDtls as $chapter)
            <div class="card collapsed-card">
                <div class="card-header" data-card-widget="collapse">
                    <span>{{$chapter->checklist_ch_name}}</span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table order-list table-bordered" id="">
                            <thead>
                                <tr>
                                    <td>Area</td>
                                    <td>Standard</td>
                                    <td>Points</td>
                                    <td>Rating</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $area = '';
                                @endphp
                                @foreach ($chapter->chapterAreas as $chapterArea)
                                    @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                            <tr>
                                                @if ($area != $chapterArea->checklist_area)
                                                <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}">{{ $chapterArea->checklist_area }}</td>
                                                @endif
                                                <td>{{ $checkListStandard->checklist_standard }}</td>
                                                <td>{{ $checkListStandard->checklist_pts }}</td>
                                                <td>{{ $checkListStandard->standard_code }}</td>
                                                @php
                                                $area = $chapterArea->checklist_area
                                                @endphp 
                                            </tr>
                                    @endforeach  
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
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
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPROVE</button>
            <a href="#" class="btn btn-danger"><li class="fas fa-times fa-sm"></li> CANCEL</a>
        </div>
    </div>
</form>
@endsection


