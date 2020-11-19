@php
    $scorepointtotal=0;
    $total=0;
@endphp
<h4>Restaurant Assessment</h4>
<table>                    
    <tr>
        <th colspan="4"><b>Applicants Detail</b></th>
    </tr>
    <tr>
        <th>Application Number</th>
        <td>{{ $application->application_no }}</td>
        <th>License Number</th>                            
        <td>{{  $application->license_no }}</td>   
    </tr>
    <tr>
       
        <th>License Date</th>                            
        <td> {{  $application->license_date }}</td>    
        <th>Restaurant Name</th>                            
        <td> {{  $application->company_title_name }}</td>                           
    </tr>
    <tr>
        <th>Owner Name</th>                            
        <td>{{  $application->owner_name }}</td>   
        <th>Citizen ID</th>                            
        <td style="text-align:left;">{{ $application->cid_no }}</td>                              
    </tr>
    <tr>
        <th>Address  </th>
        <td>{{ $application->address }}</td>   
        <th>Contact Number</th>
        <td style="text-align:left;">{{ $application->contact_no}}</td>                       
    </tr>
    <tr>
        <th>Email</th>                            
        <td class="text-left"> {{  $application->email }}</td> 
        <th>Internet Homepage </th>                            
        <td> {{  $application->webpage_url }}</td>      
    </tr>
    <tr>
        <th>Fax Number</th>                            
        <td style="text-align:left;">{{  $application->fax }}</td>                             
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
<h4>{{ $chapter->checklist_ch_name }}  </h4>
   <table>
       <thead>
           <tr>
               <th>Area</th>
               <th>Standard</th>
               <th>Score points</th>
               <th> Self score point</th>
               <th>Assessor score point</th>
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
                                   {{ $checkListStandard->assessor_score_point }}
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
    <h4>Score Points Details</h4>
       <p style="font-size:12pt"> 
        Total self score point ({{$total}}/330)
            <span id="scorepoint">: &nbsp;<b>{{ $scorepointtotal }}</b></span>	
       </p>
        <p style="font-size:12pt">
            Total Assessor’s score point({{$total}}/330):________
        </p>	
</div>           










