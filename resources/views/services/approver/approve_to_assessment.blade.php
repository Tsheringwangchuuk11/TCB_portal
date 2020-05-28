@extends('layouts.manager')
@section('page-title','Tour Operator Assessment')
@section('content')
<form action="{{ url('verification/tour-operator-assessment') }}" method="POST" files="true" id="formId" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" name="module_id" value="{{ $applicantInfo->module_id }}">
    <input type="hidden" class="form-control" name="service_id" value="{{ $applicantInfo->service_id }}">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Application Number<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="application_no" value="{{ $applicantInfo->application_no }}" readonly="true">
                    </div>
                  </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_name" value="{{ $applicantInfo->company_title_name }}">
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Location <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="location" value="{{ $applicantInfo->location }}">
                    </div>
                  </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="name" value="{{ $applicantInfo->owner_name }}">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="contact_no" value="{{ $applicantInfo->contact_no }}">
                    </div>
                  </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Owner CID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" value="{{ $applicantInfo->cid_no }}">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">License No.<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="license_no" value="{{ $applicantInfo->license_no }}">
                    </div>
                  </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="license_date"  value="{{ $applicantInfo->license_date }}">
                    </div>
                  </div>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-header">
                <h4 class="card-title">Tour Operator's License</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                    <label>License details <span class="text-danger">*</span> </label>
                    <input type="radio" name="license" required> Valid
                    <input type="radio" name="license" required> Invalid
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Remarks: </label>
                    <textarea class="form-control" name="license_remarks" rows="2" autocomplete="off"></textarea>
                    </div>
                </div>
                </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Office Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($officeInfos as $officeInfo)
                <div class="col-md-6">
                    <div class="form-group">
                        @if ($officeInfo->office_id ===1)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->office_id }}" class="form-control">       
                        <input type="checkbox" name="office_status[]" value="1" {{ $officeInfo->office_status == 1 ? 'checked':'' }}> Separate Premises          
                        <input type="checkbox" name="office_status[]" value="0" {{ $officeInfo->office_status == 0 ? 'checked':'' }}> With Residence
                        @elseif($officeInfo->office_id ===2)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->office_id }}" class="form-control">       
                        <input type="checkbox" name="office_status[]"  value="1" {{ $officeInfo->office_status == 1 ? 'checked':'' }}> Proper Demarcation          
                        <input type="checkbox" name="office_status[]"  value="0" {{ $officeInfo->office_status == 0 ? 'checked':'' }}>  No Demarcation
                        @elseif($officeInfo->office_id ===3)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->office_id }}" class="form-control">       
                        <input type="checkbox" name="office_status[]"  value="1" {{ $officeInfo->office_status == 1 ? 'checked':'' }}> Yes      
                        <input type="checkbox" name="office_status[]"  value="0" {{ $officeInfo->office_status == 0 ? 'checked':'' }}> No
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Remarks: </label>
                    <textarea class="form-control" name="office_r" rows="2" autocomplete="off"></textarea>
                    </div>
                </div>
            </div> --}}
    </div>
    </div>
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Office Equipment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($officeEquipments as $officeEquipment)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> {{ $officeEquipment->equipment_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="equipment_id[]" value="{{ $officeEquipment->equipment_id}}" class="form-control">       
                        <input type="checkbox" name="equipment_status[]" value="1" {{ $officeEquipment->equipment_status == 1 ? 'checked':'' }}> Yes          
                        <input type="checkbox" name="equipment_status[]" value="0" {{ $officeEquipment->equipment_status == 0 ? 'checked':'' }}> No
                    </div>
                </div>
                @endforeach
            </div>       
            {{-- {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="equipment_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Communication Facilities</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($communicationFacilities as $communicationFacilitie)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> {{ $communicationFacilitie->equipment_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="equipment_id[]" value="{{ $communicationFacilitie->equipment_id}}" class="form-control">       
                        <input type="checkbox" name="equipment_status[]" value="1" {{ $communicationFacilitie->equipment_status == 1 ? 'checked':'' }}> Yes          
                        <input type="checkbox" name="equipment_status[]" value="0" {{ $communicationFacilitie->equipment_status == 0 ? 'checked':'' }}> No
                    </div>
                </div>
                @endforeach
            </div>       
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="facilities_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Employment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($employments as $employment)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> {{ $employment->employment_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="employment_id[]" value="{{ $employment->employment_id}}" class="form-control">       
                        <input type="checkbox" name="employment_status[]" value="1" {{ $employment->employment_status == 1 ? 'checked':'' }}> Yes
                        <input type="checkbox" name="employment_status[]" value="0" {{ $employment->employment_status == 0 ? 'checked':'' }}> No
                        <input type="checkbox" name="nationality[]" value="B" {{ $employment->nationality == 'B' ? 'checked':'' }}> Bhutanese
                        <input type="checkbox" name="nationality[]" value="F" {{ $employment->nationality == 'F' ? 'checked':'' }}> Foreigner
                    </div>
                </div>
                @endforeach
            </div>       
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="employment_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div> --}}
        </div>
    </div>
     <div class="card">
        <div class="card-header">
                <h4 class="card-title">Trekking Equipments</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($trekkingEquipments as $trekkingEquipment)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> {{ $trekkingEquipment->equipment_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="equipment_id[]" value="{{ $trekkingEquipment->equipment_id }}" class="form-control">       
                        <input type="checkbox" name="equipment_status[]" value="1" {{ $trekkingEquipment->equipment_status == 1 ? 'checked':'' }}> Yes          
                        <input type="checkbox" name="equipment_status[]" value="0" {{ $trekkingEquipment->equipment_status == 0 ? 'checked':'' }}> No
                    </div>
                </div>
                @endforeach
            </div>     
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="trecking_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div> --}}
        </div>
    </div>
     <div class="card">
        <div class="card-header">
                <h4 class="card-title">Transportation</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($transportations as $transportation)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""> {{ $transportation->vehicle_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="vehicle_id[]" value="{{ $transportation->vehicle_id}}" class="form-control">       
                        <input type="checkbox" name="transport_status[]" value="1" {{ $transportation->transport_status == 1 ? 'checked':'' }}> Yes
                        <input type="checkbox" name="transport_status[]" value="0" {{ $transportation->transport_status == 0 ? 'checked':'' }}> No
                        <input type="checkbox" name="fitness[]" value="1" {{ $transportation->fitness == 1 ? 'checked':'' }}> Valid Fitness
                        <input type="checkbox" name="fitness[]" value="0" {{ $transportation->fitness == 0 ? 'checked':'' }}> Invalid Fitness
                    </div>
                </div>
                @endforeach
            </div>       
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="transportation_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div> --}}
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
                <div class="form-group col-md-12">
                    <label for="">Remarks <span class="text-danger">*</span> </label>
                    <textarea type="text" class="form-control" name="remarks" row="3"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
             {{-- script is written in common util --}}
             <button name="status" value="APPROVED" class="btn btn-success"><li class="fas fa-check"></li> APPROVE</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal"><li class="fas fa-times"></li> REJECT</button>
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
                <button name="status"value="REJECTED" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
            </div>
          </div>
        </div>
      </div>
<form>
@endsection
