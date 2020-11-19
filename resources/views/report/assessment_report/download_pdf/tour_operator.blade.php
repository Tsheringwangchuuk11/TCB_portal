@extends('layouts.pdf')
@section('title', 'Tour Operator Assessment')
@section('content')
    <h4>Tour Operator Assessment</h4>
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
                            <th width="50%">Name of the Tour Company</th>                            
                            <td class="text-left">: {{  $application->company_title_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Name of the proprietor/s</th>                            
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
                            <th width="50%">Telephone/Mobile No</th>                            
                            <td class="text-left">: {{  $application->contact_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">License No  </th>
                            <td width="50%">: {{ $application->license_no }}</td>
                        </tr>
                        <tr>
                            <th width="50%">License Date  :</th>
                            <td width="50%">: {{ $application->license_date}}</td>
                        </tr>
                    </table>    
                </td>                            
            </tr>
        </table>
        <hr>
        <h4>Company Location</h4> 
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
        @if ($checklistDtls->count() > 0)
            <h4>Self Assessment Check List</h4>
            @php
            $i = 0;
            @endphp
            @foreach ($checklistDtls as $chapter)
            {{$chapter->checklist_ch_name}}
                <table class="main">
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
                                        <input type="radio" name="check{{ $chapterArea->id }}" value="{{ $checkListStandard->checklist_id}}" {{ $checklistrecords[$i]->checklist_id  ==  $checkListStandard->checklist_id ? 'checked':'' }}>

                                    </td>
                                        @php 
                                        ($i++) 
                                        @endphp 
                                        @else
                                        <td>{{ $checkListStandard->checklist_standard }}
                                            <input type="radio" name="check{{$chapterArea->id}}" value="{{$checkListStandard->checklist_id}}">
                                        </td>
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
@endsection


