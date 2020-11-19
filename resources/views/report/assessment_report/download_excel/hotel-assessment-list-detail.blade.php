@php
    $scorepointtotal=0;
    $ratingpointtotal=0;
@endphp
<h4>Hotel Assessment</h4>
<table>                    
    <tr>
        <th colspan="4"><b>Applicants Detail</b></th>
    </tr>
    <tr>
        <th>Application Number</th>
        <td>{{ $application->application_no }}</td>
        <th>Registration Type</th>
        <td>{{ $application->star_category_name }}</td>
    </tr>
    <tr>
        <th>License Number</th>                            
        <td>{{  $application->license_no }}</td>   
        <th>License Date</th>                            
        <td> {{  $application->license_date }}</td>                             
    </tr>
    <tr>
        <th>Hotel Name</th>                            
        <td> {{  $application->company_title_name }}</td>  
        <th>Owner Name</th>                            
        <td>{{  $application->owner_name }}</td>                               
    </tr>
    <tr>
        <th>Citizen ID</th>                            
        <td style="text-align:left;">{{ $application->cid_no }}</td>  
        <th>Address  </th>
        <td>{{ $application->address }}</td>                          
    </tr>
    <tr>
        <th>Contact Number</th>
        <td style="text-align:left;">{{ $application->contact_no}}</td>
        <th>Email</th>                            
        <td class="text-left"> {{  $application->email }}</td>     
    </tr>
    <tr>
        <th>Internet Homepage </th>                            
        <td> {{  $application->webpage_url }}</td>  
        <th>Fax Number</th>                            
        <td style="text-align:left;">{{  $application->fax }}</td>                             
    </tr>
    
    <tr>
        <th>Manager Name</th>                            
        <td>{{  $application->manager_name }}</td>    
        <th>Manager Contact No.</th>                            
        <td style="text-align:left;">{{  $application->manager_mobile_no }}</td>                             
    </tr>
    <tr>
        <th>Number of beds</th>                            
        <td style="text-align:left;">{{  $application->number }}</td>                            
    </tr>
</table>
<table>   
    <tr>
        <th colspan="4"><b>Hotel Location</b></th>
    </tr>         
    <tr>
        <th>Dzongkhag</th>
        <td>{{  $application->dzongkhag_name }}</td>
        <th>Gewog</th>
        <td>{{  $application->gewog_name }}</td>                                  
    </tr>
    <tr>
        <th>village</th>
        <td>{{  $application->village_name }}</td> 
    </tr>
</table> 
<table>
    @php
        $total=0;
    @endphp
    <tr>
        <th colspan="2"><b>Room Detail</b></th>
    </tr>  
    <tr>
        <th>Room Types</th>
        <th>Number Of Rooms</th>
    </tr>
    @foreach ($roomDetails as $roomDetail)
    <tr>
        <td>{{$roomDetail->dropdown_name}}</td>
        <td>{{$roomDetail->room_no}}</td>
    </tr>
    @php
        ($total +=$roomDetail->room_no);
    @endphp  
    @endforeach
    <tr>
        <th>Total number of rooms</th>
        <th>{{$total}}</th>
    </tr>
</table>
<table>
    <tr>
        <th colspan="9"><b>Staff Detail</b></th>
    </tr> 
    <tr>
        <th>#</th>
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
            <td>{{ $loop->iteration }}</td>
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
<h4>Check List</h4>  
@foreach ($data as $chapter)
@if (in_array($chapter->id,$chapterId))   
<h4>{{ $chapter->checklist_ch_name }}  </h4>
   <table>
       <thead>
           <tr>
               <th>Area</th>
               <th>Standard</th>
               <th>Score points</th>
               <th> Self score point</th>
               <th>Assessor score point</th>
               <th>B/B* rating</th>
               <th>Self B/B* rating</th>
               <th>Assessor B/B* rating</th>
           </tr>
       </thead>
       <thead>
           @foreach ($chapter->chapterAreas as $chapterArea)
               @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                       <tr>
                           <td style="page-break-inside: auto"> {{ $chapterArea->checklist_area }} </td>
                           <td  style="page-break-inside: auto">{{ $checkListStandard->checklist_standard }}</td>
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
                    Total Assessor’s score point(160-199) :
            @elseif($application->star_category_id==2)
                    Total Assessor’s score point(200-279) :
            @else
                Total Assessor’s score point(280 +):
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
                Total Assessor’s B/B* rating (117 out of 120):
            @elseif($application->star_category_id==2)
                Total Assessor’s B/B* rating (145 out of 149):
            @else
            Total Assessor’s B/B* rating (162 out of 166):
            @endif
         </p>
</div>           










