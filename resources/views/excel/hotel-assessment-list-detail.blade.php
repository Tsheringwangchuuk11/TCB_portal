<table>
    <thead>
        <tr>
            <th colspan="16">Hotel Assessment Detail</th>
        </tr>
        <tr>            
            <th style="background-color: #45d090;">Name and type of accommodation</th>
            <th style="background-color: #45d090;">Licence  number/date</th>
            <th style="background-color: #45d090;">Accommodation owner/manage</th>
            <th style="background-color: #45d090;">Address</th>           
            <th style="background-color: #45d090;">Telephone</th>           
            <th style="background-color: #45d090;">Fax</th>           
            <th style="background-color: #45d090;">E-mail</th>           
            <th style="background-color: #45d090;">Address</th>           
            <th style="background-color: #45d090;">Internet Homepage</th>           
            <th style="background-color: #45d090;">Room Count</th>           
            <th style="background-color: #45d090;">Single Room</th>           
            <th style="background-color: #45d090;">Double Room</th>           
            <th style="background-color: #45d090;">Suites Room</th>           
            <th style="background-color: #45d090;">Number of beds</th>           
            <th style="background-color: #45d090;">Staff Number</th>           
        </tr>
    </thead>
    <tbody>        
            <tr>                
                <td>{{ $application->company_title_name }}</td>
                <td>{{ $application->license_no .'/'. $application->license_date }}</td>
                <td>{{  $application->owner_name }}</td>
                <td>{{  $application->address }}</td> 
                <td>{{  $application->contact_no }}</td> 
                <td>{{  $application->fax }}</td> 
                <td>{{  $application->email }}</td> 
                <td>{{  $application->webpage_url }}</td> 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>        
    </tbody>
</table> 
@if ($data->count() > 0)  
@foreach ($data as $chapter)
<table>  
    <thead>
        <tr>
            <th colspan="6" style="background-color: #4581d0;">{{$chapter->checklist_ch_name}}</th>
        </tr>      
        <tr>
            <th style="background-color: #45d090;">Area</th>
            <th style="background-color: #45d090;">Standard</th>
            <th style="background-color: #45d090;">Points</th>
            <th style="background-color: #45d090;">Points Entry</th>
            <th style="background-color: #45d090;">Rating</th>
            <th style="background-color: #45d090;">Rating Point</th>
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
                        @if ($area != $chapterArea->checklist_area)
                        <td> {{ $chapterArea->checklist_area }} </td>
                        @endif
                        <td>{{ $checkListStandard->checklist_standard }}</td>
                        <td>{{ $checkListStandard->checklist_pts }}</td>
                        <td>_________</td>
                        <td>{{ $checkListStandard->standard_code }}</td>
                        <td>_________</td>
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

