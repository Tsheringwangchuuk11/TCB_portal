
@extends('layouts.pdf')
@section('title', 'Restaurant Assessment')
@section('extra_styles')
<style>
    
    #container {
        padding-top: 20px;
        padding-bottom: 20px;
    }   
</style>
@endsection
@section('content')
@php
    $scorepointtotal=0;
    $total=0;
@endphp
    <h4 class="">Restaurant Assessment</h4>
    <hr>	
    <div id="container">
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
                            <th width="50%">License Number</th>                            
                            <td class="text-left">: {{  $application->license_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">License Date  :</th>                            
                            <td class="text-left">: {{  $application->license_date }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Restaurant  Name</th>                            
                            <td class="text-left">: {{  $application->company_title_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Owner Name</th>                            
                            <td class="text-left">: {{  $application->owner_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Citizen ID</th>                            
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
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
        <h4>Restaurant Location</h4> 
        <table>            
            <tr>  
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Dzongkhag</th>
                            <td class="text-left">: {{  $application->dzongkhag_name }}</td>                               
                        </tr>
                        <tr>
                            <th width="50%">village</th>
                            <td class="text-left">: {{  $application->village_name }}</td>                               
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Gewog</th>
                            <td class="text-left">: {{  $application->gewog_name }}</td>   
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>
        <h4>Staff Detail</h4> 
        <table class="main" style="table-layout:fixed;">
            <tr>
                <th style="text-align: center;width:5%;">#</th>
                <th>Citizen ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Qualification</th>
                <th>Experience</th>
                <th>Salary</th>
                <th>Hospitility relating</th>
            </tr>
            @foreach ($staffInfos as $staffInfo)
                <tr>
                    <td style="text-align: center;width:5%;">{{ $loop->iteration }}</td>
                    <td>{{ $staffInfo->staff_cid_no }}</td>
                    <td>{{ $staffInfo->staff_name }}</td>
                    <td>
                        @if ($staffInfo->staff_gender==='F')
                            Female
                        @else
                            Male
                        @endif
                    </td>
                    <td> {{ $staffInfo->staff_designation }}</td>
                    <td> {{ $staffInfo->qualification }}</td>
                    <td> {{ $staffInfo->experience }}</td>
                    <td>{{ $staffInfo->salary }}</td>
                    <td>
                        @if($staffInfo->hospitility_relating==="Y" )
                            Yes
                        @else
                            No
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <br><br>
        <h4>Check List</h4>  
        @foreach ($data as $chapter)
             {{ $chapter->checklist_ch_name }}                
                <table class="main" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th style="width:20%;">Area</th>
                            <th style="width:60%;">Standard</th>
                            <th style="width:10%;">Score points</th>
                            <th style="width:10%;"> Self score point</th>
                            <th style="width:10%;">Assessor score point</th>
                        </tr>
                    </thead>
                    <thead>
                        @foreach ($chapter->chapterAreas as $chapterArea)
                            @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                    <tr>
                                        <td style="justify"> {{ $chapterArea->checklist_area }} </td>
                                        <td style="justify">{{ $checkListStandard->checklist_standard }}</td>
                                        <td>{{ $checkListStandard->checklist_pts }}</td>
                                        <td>
                                            @if ($checkListStandard->assessor_score_point!=0)
                                                {{ $checkListStandard->assessor_score_point }}
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @php
                                    ($scorepointtotal +=$checkListStandard->assessor_score_point);
                                    ($total +=$checkListStandard->checklist_pts);
                                    @endphp 
                            @endforeach  
                        @endforeach
                    </thead>
                </table>
        @endforeach  
        <div>
            <h4>Score Points and Basic Standards(B + B*) Details</h4>
               <p style="font-size:12pt"> 
                            Total self score point ({{$total}}/330):
                    <span id="scorepoint">: &nbsp;<b>{{ $scorepointtotal }}</b></span>	
               </p>
                <p style="font-size:12pt">
                            Total Assessor’s score point ({{$total}}/330) :____
                </p>	
        </div>           
    </div>
@endsection


