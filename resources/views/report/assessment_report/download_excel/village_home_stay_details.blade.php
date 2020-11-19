    <h4>Village Home Stay Assessment</h4>
    <hr>	
        <h4>Applicants Detail</h4> 
        <table>            
                <tr>
                    <th>Application Number</th>
                    <td> {{ $application->application_no }}</td>
                    <th>Name</th>
                    <td>{{ $application->applicant_name }}</td>
                </tr>
                <tr>
                    <th>Citizen ID</th>                            
                    <td>{{  $application->cid_no }}</td>  
                    <th>Contact No.</th>                            
                    <td>{{  $application->contact_no }}</td>                          
                </tr>
                <tr>
                    <th>Email</th>                            
                    <td>{{  $application->email }}</td>  
                    <th>Dzongkhag</th>                            
                    <td>{{  $application->dzongkhag_name }}</td>                          
                </tr>
                <tr>
                    <th>Gewog</th>                            
                    <td>{{  $application->gewog_name }}</td>   
                    <th>Chiwog  </th>
                    <td>{{ $application->chiwog_name }}</td>                         
                </tr>
                <tr>
                    <th>Village :</th>
                    <td>{{ $application->village_name}}</td>
                    <th>Thram No</th>                            
                    <td>{{  $application->thram_no }}</td>       
                </tr>
                <tr>
                    <th>House No</th>                            
                    <td>{{  $application->house_no }}</td> 
                    <th>Distance from the nearest town/urban centre (hrs or kms)</th>                            
                    <td>{{  $application->town_distance }}</td>                             
                </tr>
                <tr>
                    <th>Distance from the main road (hrs or kms)</th>                            
                    <td>{{  $application->road_distance }}</td> 
                    <th>Condition of the pathway to house from the road point</th>                            
                    <td>{{  $application->condition }}</td>                            
                </tr>          
        </table>
        <hr>
        <h4>Details Of The Family Members Residing In The Same House</h4> 
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


