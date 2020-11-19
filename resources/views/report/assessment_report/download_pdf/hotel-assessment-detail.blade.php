
@extends('layouts.pdf')
@section('title', 'Hotel Assessment')
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
    $ratingpointtotal=0;
@endphp
    <h4 class="">Hotel Assessment</h4>
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
                            <th width="50%">Citizen ID</th>                            
                            <td class="text-left">: {{  $application->cid_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Address  </th>
                            <td width="50%">: {{ $application->address }}</td>
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
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
                            <th width="50%">Manager Name</th>                            
                            <td class="text-left">: {{  $application->manager_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Manager Contact No.</th>                            
                            <td class="text-left">: {{  $application->manager_mobile_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Number of beds</th>                            
                            <td class="text-left">: {{  $application->number }}</td>                            
                        </tr>
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
        <h4>Hotel Location</h4> 
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
        <h4>Room Detail</h4> 
        <table>
        @php
            $total=0;
        @endphp
            <tr>
                <td width="100%">
                    <table>
                        <tr>
                            <th width="50%">Room Types</th>
                            <th width="50%">Number Of Rooms</th>
                        </tr>
                        @foreach ($roomDetails as $roomDetail)
                        <tr>
                            <td width="50%">{{$roomDetail->dropdown_name}}</td>
                            <td width="50%">{{$roomDetail->room_no}}</td>
                        </tr>
                        @php
                          ($total +=$roomDetail->room_no);
                        @endphp  
                        @endforeach
                        <tr>
                            <th width="50%">Total number of rooms</th>
                            <th width="50%">{{$total}}</th>
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
             @if (in_array($chapter->id,$chapterId))   
             {{ $chapter->checklist_ch_name }}                
                <table class="main" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th style="width:17%;">Area</th>
                            <th style="width:40%;">Standard</th>
                            <th style="width:6%;">Score points</th>
                            <th style="width:6%;"> Self score point</th>
                            <th style="width:9%;">Assessor score point</th>
                            <th style="width:6%;">B/B* rating</th>
                            <th style="width:6%;">Self B/B* rating</th>
                            <th style="width:10%;">Assessor B/B* rating</th>
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
                                        <td>{{ $checkListStandard->standard_code }}</td>
                                        <td>
                                            @if ($checkListStandard->assessor_rating!=0)
                                                {{ $checkListStandard->assessor_rating }}
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @php
                                    ($scorepointtotal +=$checkListStandard->assessor_score_point);
                                    ($ratingpointtotal +=$checkListStandard->assessor_rating);
                                    @endphp 
                            @endforeach  
                        @endforeach
                    </thead>
                </table>
             @endif
        @endforeach  
        <div>
            <h4>Score Points and Basic Standards(B + B*) Details</h4>
               <p style="font-size:12pt"> 
                    @if ($application->star_category_id==1)
                            Total self score point(160-199)
                    @elseif($application->star_category_id==2)
                            Total Self score point(200-279)
                    @else
                        Total Self score point(280 +)
                    @endif
                    <span id="scorepoint">: &nbsp;<b>{{ $scorepointtotal }}</b></span>	
               </p>
                <p style="font-size:12pt">
                    @if ($application->star_category_id==1)
                            Total Assessor’s score point(160-199) :____
                    @elseif($application->star_category_id==2)
                            Total Assessor’s score point(200-279) :_____
                    @else
                        Total Assessor’s score point(280 +):____
                    @endif
                </p>	
                <p style="font-size:12pt">
                    @if ($application->star_category_id==1)
                            Total Self B/B* rating (117 out of 120)
                    @elseif($application->star_category_id==2)
                            Total Self B/B* rating (145 out of 149)
                    @else
                        Total Self B/B* rating (162 out of 166)
                    @endif
                    <span id="bspoints">:&nbsp;<b>{{ $ratingpointtotal }}</b></span>
                 </p>
                <p style="font-size:12pt">
                    @if ($application->star_category_id==1)
                        Total Assessor’s B/B* rating (117 out of 120):_____
                    @elseif($application->star_category_id==2)
                        Total Assessor’s B/B* rating (145 out of 149):_____
                    @else
                    Total Assessor’s B/B* rating (162 out of 166):______
                    @endif
                 </p>
        </div>           
    </div>
@endsection


