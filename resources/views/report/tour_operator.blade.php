@extends('layouts.manager')
@section('page-title', 'Tour Operator Assessment Details')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=pdf&'. Request::getQueryString()) }}" class="btn btn-sm btn-danger btn-flat" target="_blank"><i class="fa fa-print"></i> Print PDF</a>    
    <a href="{{	url('report/assessment-reports/'.$application->application_no.'/'.$application->module_id.'?print=excel&'. Request::getQueryString()) }}" class="btn btn-sm btn-success btn-flat" target="_blank"><i class="fa fa-file-excel"></i></i> Export to Excel</a>    
    <a href="{{url('report/assessment-reports')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back to List</a>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Applicants Detail</h3>
            </div>    
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">              
                            <label for="">Application Number</label> :{{ $application->application_no }}
                        </div>         
                        </div>     
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Name of the Tour Company </label> :{{ $application->company_title_name }}      
                            </div>        
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Location</label> :{{ $application->location }}
                            </div> 
                        </div>                 
                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Name of the proprietor/s </label> :{{ $application->owner_name }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telephone/Mobile No</label> :{{$application->contact_no}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">CID No.</label> :{{$application->cid_no}}
                            </div>
                        </div> 
                    </div>  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">License No </label> :{{$application->license_no}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">License Date </label> :{{$application->license_date}}
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
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
                        <input type="hidden" name="equipment_id[]" value="{{ $communicationFacilitie->equipment_id}}" class="form-control">       
                        <input type="checkbox" name="equipment_status[]" value="1" {{ $communicationFacilitie->equipment_status == 1 ? 'checked':'' }}> Yes          
                        <input type="checkbox" name="equipment_status[]" value="0" {{ $communicationFacilitie->equipment_status == 0 ? 'checked':'' }}> No
                    </div>
                </div>
                @endforeach
            </div>       
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
        </div>
    </div>
</div>                   
@endsection
