@extends('layouts.pdf')
@section('title', 'Home Stay Assessment')
@section('extra_styles')
<style>
    table,th,td {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        /* border-collapse: collapse; */
        width: 100%;
        border: 1px solid black;

    }
   
    #container {
        padding-top: 20px;
        padding-bottom: 20px;
    }   

    hr {
        color: #ddd;
    } 
    .page-break {
    page-break-after: always;
} 
 
</style>
@endsection
@section('content')
    <p class="print-title text-center">Hotel Assessment</p>
    <hr>	
    <div id="container">
        <h6 class="text-center">Applicants Detail</h6> 
        <table>            
            <tr>  
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Application Number</th>
                            <td width="50%">: {{ $application->application_no }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Name of the Tour Company</th>                            
                            <td class="text-left">: {{  $application->company_title_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Location  :</th>                            
                            <td class="text-left">: {{  $application->location }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Name of the proprietor/s</th>                            
                            <td class="text-left">: {{  $application->owner_name }}</td>                            
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                         <tr>
                            <th width="50%">Telephone/Mobile No</th>                            
                            <td class="text-left">: {{  $application->contact_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">CID No</th>                            
                            <td class="text-left">: {{  $application->cid_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">License No  </th>
                            <td width="50%">: {{ $application->license_no }}</td>
                        </tr>
                        <tr>
                            <th width="50%">License Date  :</th>
                            <td width="50%">: {{ $application->license_date}}</td>
                        </tr>
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
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
    <hr>
   
@endsection


