@extends('layouts.pdf')
@section('title', 'Village Home Stay Assessment')
@section('extra_styles')
@endsection
@section('content')
    <h4>Village Home Stay Assessment</h4>
    <hr>	
        <h4>Applicants Detail</h4> 
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
                            <th width="50%">Citizen ID</th>                            
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
                        <tr>
                            <th width="30%">Chiwog  </th>
                            <td width="70%">: {{ $application->chiwog_name }}</td>
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        
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
        <h4>Details Of The Family Members Residing In The Same House</h4> 
        <table>
            <tr>
            <td width="100%">
                <table>
                    <tr>
                        <th width="25%">Name</th>
                        <th width="25%">Relationship with the applicant</th>
                        <th width="25%">Age</th>
                        <th width="25%">Gender</th>
                    </tr>
                    @foreach ($familyDetails as $familyDetail)
                    <tr>
                        <td width="25%">{{$familyDetail->member_name}}</td>
                        <td width="25%">{{$familyDetail->dropdown_name}}</td>
                        <td width="25%">{{$familyDetail->member_dob}}</td>
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
    <h4>{{$chapter->checklist_ch_name}}</h4> 
        <table class="main">
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
                            <td> {{ $chapterArea->checklist_area }} </td>
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


