@extends('layouts.pdf')
@section('title', 'Hotel Assessment')
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
                            <th width="50%">Registration Type  :</th>
                            <td width="50%">: {{ $application->star_category_name }}</td>
                        </tr>
                        <tr>
                            <th width="50%">License Number</th>                            
                            <td class="text-left">: {{  $application->license_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">License Date  :</th>                            
                            <td class="text-left">: {{  $application->license_date }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Hotel Name</th>                            
                            <td class="text-left">: {{  $application->company_title_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Owner Name</th>                            
                            <td class="text-left">: {{  $application->owner_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">CID No</th>                            
                            <td class="text-left">: {{  $application->cid_no }}</td>                            
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Address  </th>
                            <td width="50%">: {{ $application->address }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Contact Number  :</th>
                            <td width="50%">: {{ $application->contact_no}}</td>
                        </tr>
                        <tr>
                            <th width="50%">Email</th>                            
                            <td class="text-left">: {{  $application->email }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Internet Homepage :</th>                            
                            <td class="text-left">: {{  $application->webpage_url }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Fax Number</th>                            
                            <td class="text-left">: {{  $application->fax }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Number of beds</th>                            
                            <td class="text-left">: {{  $application->number }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Location</th>                            
                            <td class="text-left">: {{  $application->location_name }}</td>                            
                        </tr>
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
        <h6 class="text-center">Room Detail</h6> 
        <table>
            <tr>
                <td width="100%">
                    <table>
                        <tr>
                            <th width="50%">Room Types</th>
                            <th width="50%">Number Of Rooms</th>
                        </tr>
                        @foreach ($roomDetails as $roomDetail)
                        <tr>
                            <td width="50%">{{$roomDetail->room_name}}</td>
                            <td width="50%">{{$roomDetail->room_no}}</td>
                        </tr>
                        @endforeach
                    </table>
                </td> 
            </tr>
        </table>
        <hr>
        <h6 class="text-center">Staff Detail</h6> 
        <table>
            <tr>
                <td width="100%">
                    <table>
                        <tr>
                            <th width="25%">Area</th>
                            <th width="25%">Division</th>
                            <th width="25%">Name</th>
                            <th width="25%">Gender</th>
                        </tr>
                        @foreach ($staffDetails as $staffDetail)
                        <tr>
                            <td width="25%">{{$staffDetail->staff_area_name}}</td>
                            <td width="25%">{{$staffDetail->hotel_div_name}}</td>
                            <td width="25%">{{$staffDetail->staff_name}}</td>
                            @if ($staffDetail->staff_gender==='M')
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
                {{$chapter->checklist_ch_name}}
                {{-- <table>
                    <tr>
                        <td> --}}
                        {{-- <div style='page-break-inside: after;'> --}}
                            <table border='1'>
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Standard</th>
                                    <th>Points</th>
                                    <th>Points Entry</th>
                                    <th>Rating</th>
                                    <th>Rating Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $area = '';
                                @endphp
                                @foreach ($chapter->chapterAreas as $chapterArea)
                                    @foreach ($chapterArea->checkListStandards as $key => $checkListStandard) 
                                        <tr>
                                            {{-- @if ($area != $chapterArea->checklist_area) --}}
                                            <td> {{ $chapterArea->checklist_area }} </td>   
                                            {{-- @endif --}}
                                            <td>{{ $checkListStandard->checklist_standard }}</td>
                                            <td>{{ $checkListStandard->checklist_pts }}</td>
                                            <td></td>
                                            <td>{{ $checkListStandard->standard_code }}</td>
                                            <td></td>
                                        </tr>
                                    @php
                                    $area = $chapterArea->checklist_area
                                    @endphp 
                                    @endforeach  
                                @endforeach
                            </tbody>
                        </table>
                        {{-- </td>
                    </tr>
                </table> --}}
            @endforeach
        @endif
    </div>
@endsection


