@extends('layouts.pdf')
@section('title', 'Village Home Stay Assessment')
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
                            <th width="50%">Name  :</th>
                            <td width="50%">: {{ $application->applicant_name }}</td>
                        </tr>
                        <tr>
                            <th width="50%">CID No</th>                            
                            <td class="text-left">: {{  $application->cid_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Contact No. :</th>                            
                            <td class="text-left">: {{  $application->contact_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Email</th>                            
                            <td class="text-left">: {{  $application->email }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Dzongkhag</th>                            
                            <td class="text-left">: {{  $application->dzongkhag_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Gewog</th>                            
                            <td class="text-left">: {{  $application->gewog_name }}</td>                            
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Chiwog  </th>
                            <td width="50%">: {{ $application->chiwog_name }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Village :</th>
                            <td width="50%">: {{ $application->village_name}}</td>
                        </tr>
                        <tr>
                            <th width="50%">Thram No</th>                            
                            <td class="text-left">: {{  $application->thram_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">House No :</th>                            
                            <td class="text-left">: {{  $application->house_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Distance from the nearest town/urban centre (hrs or kms)</th>                            
                            <td class="text-left">: {{  $application->town_distance }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Distance from the main road (hrs or kms)</th>                            
                            <td class="text-left">: {{  $application->road_distance }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Condition of the pathway to house from the road point</th>                            
                            <td class="text-left">: {{  $application->condition }}</td>                            
                        </tr>
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
        <h6 class="text-center">Details Of The Family Members Residing In The Same House</h6> 
        <table>
            <tr>
            <td width="100%">
                <table  border='1'>
                    <tr>
                        <th width="25%">Name</th>
                        <th width="25%">Relationship with the applicant</th>
                        <th width="25%">Age</th>
                        <th width="25%">Gender</th>
                    </tr>
                    @foreach ($familyDetails as $familyDetail)
                    <tr>
                        <td width="25%">{{$familyDetail->member_name}}</td>
                        <td width="25%">{{$familyDetail->relation_type}}</td>
                        <td width="25%">{{$familyDetail->member_age}}</td>
                        @if ($familyDetail->member_gender==='M')
                        <td width="25%">Male</td>
                    @else
                    <td width="25%">Female</td>
                    @endif
                    </tr>
                    @endforeach
                </table>
            </td> 
        </tr>
        </table>
    <hr>
    @if ($data->count() > 0)    
    @foreach ($data as $chapter)
    <h6 class="text-center">{{$chapter->checklist_ch_name}}</h6> 
        <table border='1'>
        <thead>
            <tr>
                <th>Area</th>
                <th>Standard</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @php
            $area = '';
            @endphp
            @foreach ($chapter->chapterAreas as $chapterArea)
                @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                        @php
                            $standardlengh=$checkListStandard->count();
                        @endphp
                        <tr>
                            {{-- @if ($area != $chapterArea->checklist_area) --}}
                            <td> {{ $chapterArea->checklist_area }} </td>
                            {{-- @endif --}}
                            <td>{{ $checkListStandard->checklist_standard }}</td>
                            <td>{{ $checkListStandard->standard_code }}</td>
                            @php
                            $area = $chapterArea->checklist_area
                            @endphp 
                        </tr>
                @endforeach  
            @endforeach
        </tbody>
    </table>
@endforeach
@endif
@endsection


