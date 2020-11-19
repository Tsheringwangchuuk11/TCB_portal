    <h4>Tour Operator Assessment</h4>
        <table>            
               <tr>
                   <td colspan="4">Applicants Detail</td>
               </tr>
            <tr>
                <th>Application Number</th>
                <td>{{ $application->application_no }}</td>
                <th>Name of the Tour Company</th>                            
                <td>{{  $application->company_title_name }}</td>   
            </tr>
            <tr>
                <th>Name of the proprietor/s</th>                            
                <td>{{  $application->owner_name }}</td>
                <th style="text-align:left">Citizen ID</th>                            
                <td>{{  $application->cid_no }}</td>                              
            </tr>
            <tr>
                <th>Telephone/Mobile No</th>                            
                <td style="text-align:left">{{  $application->contact_no }}</td> 
                <th>License No  </th>
                <td>{{ $application->license_no }}</td>                           
            </tr>
            <tr>
                <th>License Date</th>
                <td>{{ $application->license_date}}</td>
            </tr>
        </table>
        <table> 
            <tr>
                <td colspan="4">Company Location</td>
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

        @if ($checklistDtls->count() > 0)
            <h4>Self Assessment Check List</h4>
            @php
            $i = 0;
            @endphp
            @foreach ($checklistDtls as $chapter)
                <table class="main">
                    <tr>
                        <td colspan="4">{{$chapter->checklist_ch_name}}</td>
                    </tr>
                    @php
                    $area = '';
                    @endphp
                    @foreach ($chapter->chapterAreas as $chapterArea)
                    <tr>
                        @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                @if ($area != $chapterArea->checklist_area)
                                <td>{{ $chapterArea->checklist_area }}</td>
                                @endif
                                    @if (in_array( $checkListStandard->checklist_id, $checklistrec))
                                    <td>{{ $checkListStandard->checklist_standard }}
                                    </td>
                                        @php 
                                        ($i++) 
                                        @endphp 
                                    @endif
                                @php
                                $area = $chapterArea->checklist_area;
                                @endphp 
                        @endforeach  
                    </tr>
                    @endforeach
                </table>
            @endforeach
        @endif


