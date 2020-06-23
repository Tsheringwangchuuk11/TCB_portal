@extends('layouts.manager')
@section('page-title','Assessment And Registration Of Tour Operators Office')
@section('content')
<form action="{{ url('application/save-application') }}" method="POST" id="formdata" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="service_id" value="{{ $idInfos->service_id }}" id="service_id">
    <input type="hidden" name="module_id" value="{{ $idInfos->module_id }}" id="module_id">
    <input type="hidden" name="service_name" value="{{ $idInfos->name }}" id="service_name">
    <input type="hidden" name="module_name" value="{{ $idInfos->module_name }}" id="module_name">
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">General Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name of the Tour Company <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="company_title_name" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Location <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="location" autocomplete="off">
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Name of the proprietor/s <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="owner_name" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                  <div class="form-group">
                    <label for="">Telephone/Mobile No. <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="contact_no" autocomplete="off">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="">Owner CID<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" name="cid_no" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">License No.<span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="license_no" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                      <label for="">License Date.<span class="text-danger">*</span> </label>
                      <input type="date" class="form-control" name="license_date" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group">
                      <label for="">Email.<span class="text-danger">*</span> </label>
                      <input type="email" class="form-control" name="email" autocomplete="off">
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
                        @if ($officeInfo->id ===1)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_status[]" value="{{$loop->index}}">
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->id}}" class="form-control">       
                        <input type="radio" name="office_status{{$loop->index}}" value="0"> Separate Premises          
                        <input type="radio" name="office_status{{$loop->index}}" vlaue="1"> With Residence
                        @elseif($officeInfo->id ===2)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_status[]" value="{{$loop->index}}">
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->id}}" class="form-control">       
                        <input type="radio" name="office_status{{$loop->index}}" value="1"> Proper Demarcation          
                        <input type="radio" name="office_status{{$loop->index}}" value="0">  No Demarcation
                        @elseif($officeInfo->id ===3)
                        <label for=""> {{ $officeInfo->office_name }}<span class="text-danger">*</span> </label>
                        <input type="hidden" name="office_status[]" value="{{$loop->index}}">
                        <input type="hidden" name="office_id[]" value="{{ $officeInfo->id}}" class="form-control">       
                        <input type="radio" name="office_status{{$loop->index}}" value="1"> Yes      
                        <input type="radio" name="office_status{{$loop->index}}" value="0"> No
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
                        <input type="hidden" name="equipment_status[]" value="{{$officeEquipment->equipment_type}}{{$loop->index}}">
                        <input type="hidden" name="equipment_id[]" value="{{ $officeEquipment->id}}" class="form-control">       
                        <input type="radio" name="equipment_status{{$officeEquipment->equipment_type}}{{$loop->index}}" value="1"> Yes          
                        <input type="radio" name="equipment_status{{$officeEquipment->equipment_type}}{{$loop->index}}" value="0"> No
                    </div>
                </div>
                @endforeach
            </div>      
            {{-- <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="">Remarks: </label>
                <textarea class="form-control" name="equipment_remarks" rows="2" autocomplete="off"></textarea>
                </div>
            </div>
            </div> --}}
        </div>
    </div>

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
                        <input type="hidden" name="equipment_id[]" value="{{ $communicationFacilitie->id}}" class="form-control">       
                        <input type="hidden" name="equipment_status[]" value="{{$communicationFacilitie->equipment_type}}{{$loop->index}}">
                        <input type="radio" name="equipment_status{{$communicationFacilitie->equipment_type}}{{$loop->index}}" value="1"> Yes          
                        <input type="radio" name="equipment_status{{$communicationFacilitie->equipment_type}}{{$loop->index}}" value="0"> No
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
                        <input type="hidden" name="employment_id[]" value="{{ $employment->id}}" class="form-control"> 
                        <input type="hidden" name="employment_status[]" value="{{$loop->index}}">      
                        <input type="radio" name="employment_status{{$loop->index}}" value="1"> Yes
                        <input type="radio" name="employment_status{{$loop->index}}" value="0"> No
                        <input type="hidden" name="nationality[]" value="{{$loop->index}}">      
                        <input type="radio" name="nationality{{$loop->index}}" value="B"> Bhutanese
                        <input type="radio" name="nationality{{$loop->index}}" value="F"> Foreigner
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
                        <input type="hidden" name="equipment_id[]" value="{{ $trekkingEquipment->id }}" class="form-control"> 
                        <input type="hidden" name="equipment_status[]" value="{{$trekkingEquipment->equipment_type}}{{$loop->index}}">      
                        <input type="radio" name="equipment_status{{$trekkingEquipment->equipment_type}}{{$loop->index}}" value="1"> Yes          
                        <input type="radio" name="equipment_status{{$trekkingEquipment->equipment_type}}{{$loop->index}}" value="0"> No
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
                        <input type="hidden" name="vehicle_id[]" value="{{ $transportation->id}}" class="form-control">
                        <input type="hidden" name="transport_status[]" value="{{$loop->index}}">             
                        <input type="radio" name="transport_status{{$loop->index}}" value="1"> Yes
                        <input type="radio" name="transport_status{{$loop->index}}" value="0"> No
                        <input type="hidden" name="fitness[]" value="{{$loop->index}}">             
                        <input type="radio" name="fitness{{$loop->index}}" value="1"> Valid Fitness
                        <input type="radio" name="fitness{{$loop->index}}" value="0"> Invalid Fitness
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
             <h4 class="card-title">File Attachment</h4>
        </div>
        <div class="card-body">
            <h6> <strong>Required supporting documents:</strong></h6>
            <ol>
                <li>
                    <em>A copy of the valid trade license.</em>      
                </li>
                <li>
                    <em>A copy of the letter of authorization from the building owner stating that the applicant is authorized to operate the office in his/her property or ownership certificate in case of own building</em>      
                </li>
            </ol>
            @include('services/fileupload/fileupload')
        </div>
        <div class="card-footer text-center">
            <button type="submit"class="btn btn-success"><i class="fa fa-check"></i> APPLY</button>
            <button type="reset"class="btn btn-danger"><i class="fa fa-times"></i> RESET</button>
        </div>
    </div>
<form>
@endsection