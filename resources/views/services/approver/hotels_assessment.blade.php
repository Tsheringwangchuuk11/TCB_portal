@extends('layouts.manager')
@section('page-title','New : Tourist Standard Hotel Assessment')
{{-- @include('layouts.include.alert_success') --}}
@section('content')
<div class="card">
<div class="card-header bg-success">
    <h4 class="card-title">Registration of Tourist Standard Hotels</h4>
</div>
<form action="{{ url('verification/approve-application') }}" method="POST" files="true" id="formdata" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Application No.</label>
                        <input type="text" class="form-control" name="application_no" value="{{ $appInfos->application_no }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label>Registration Type</label>
                        <select class="form-control select2bs4" name="star_category_id" id="star_category_id" style="width: 100%;">
                            <option value="">- Select -</option>
                            @foreach ($starCategoryLists as $starCategoryList)
                            <option value="{{ $starCategoryList->id }}" {{ old('star_category_id', $appInfos->star_category_id) == $starCategoryList->id ? 'selected' : '' }}> {{ $starCategoryList->star_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">License Number</label>
                        <input type="text" class="form-control" name="license_no" value="{{ $appInfos->license_no }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">License Date</label>
                        <input type="date" class="form-control" name="license_date" value="{{ $appInfos->license_date }}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="name"  value="{{ $appInfos->name }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Owner</label>
                        <input type="text" class="form-control" name="owner" value="{{ $appInfos->owner }}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">CID No.</label>
                        <input type="text" class="form-control" name="cid_no" value="{{ $appInfos->cid_no }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $appInfos->address }}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Contact No </label>
                        <input type="text" class="form-control" name="contact_no" value="{{ $appInfos->contact_no }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5  offset-md-2">
                        <label for="">Fax </label>
                        <input type="text" class="form-control" name="fax" value="{{ $appInfos->fax }}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Email</label>
                        <input type="email" class="form-control email" name="email" value="{{ $appInfos->email }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Internet Homepage</label>
                        <input type="text" class="form-control" name="internet_url" value="{{ $appInfos->internet_url }}" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="">Number of Beds</label>
                        <input type="text" class="form-control numeric-only" name="bed_no" value="{{ $appInfos->bed_no }}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5 offset-md-2">
                        <label for="">Location</label>
                        <input type="text" class="form-control numeric-only" name="location_id" value="{{ $appInfos->location_id }}" autocomplete="off">
                    </div>
                </div>
                <!-- select room -->
                <h5>Room Details</h5>
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
                    <input type="text" class="form-control" name="room_type_id" value="{{$roomInfo->room_name}}" autocomplete="off">
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
                <!-- staff -->
                <h5>Staff Details</h5>
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
                            <input type="text" class="form-control" name="staff_area_id" value="{{$staffInfo->staff_area_name}}" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="hotel_div_id" value="{{$staffInfo->hotel_div_name}}" autocomplete="off">
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
                <h5>Document Attachment</h5>
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
                    @endforelse                </div>
               
                <!-- card body ends -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Remarks <span class="text-danger">*</span> </label>
                        <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPROVE</button>
            <a href="#" class="btn btn-danger"><li class="fas fa-times fa-sm"></li> CANCEL</a>        </div>
        </form>
  </div>
@endsection
