@extends('layouts.pdf')
@section('title', 'Hotel Assessment')
@section('extra_styles')
<style>
    table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #container {
        padding-top: 20px;
        padding-bottom: 20px;
    }   

    hr {
        color: #ddd;
    }  
 
</style>
@endsection
@section('content')
    <p class="print-title text-center">Hotel Assessment</p>
    <hr>	
    <div id="container">
        <h5 class="text-center">Data about accommodation</h5> 
        <table>            
            <tr>  
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Name and type of accommodation  </th>
                            <td width="50%">: {{ $application->company_title_name }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Licence  number/date :</th>
                            <td width="50%">: {{ $application->license_no .'/'. $application->license_date }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Accommodation owner/manage</th>                            
                            <td class="text-left">: {{  $application->owner_name }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Address :</th>                            
                            <td class="text-left">: {{  $application->address }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Telephone</th>                            
                            <td class="text-left">: {{  $application->contact_no }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">Fax</th>                            
                            <td class="text-left">: {{  $application->fax }}</td>                            
                        </tr>
                        <tr>
                            <th width="50%">E-mail</th>                            
                            <td class="text-left">: {{  $application->email }}</td>                            
                        </tr>
                    </table>
                </td>
                <td width="50%">
                    <table>
                        <tr>
                            <th width="50%">Internet Homepage  </th>
                            <td width="50%">: {{ $application->webpage_url }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Room Count :</th>
                            {{-- <td width="50%">: {{ $application->license_no .'/'. $application->license_date }}</td> --}}
                        </tr>
                        <tr>
                            <th width="50%">Single Room</th>                            
                            {{-- <td class="text-left">: {{  $application->owner_name }}</td>                             --}}
                        </tr>
                        <tr>
                            <th width="50%">Double Room :</th>                            
                            {{-- <td class="text-left">: {{  $application->address }}</td>                             --}}
                        </tr>
                        <tr>
                            <th width="50%">Suites Room</th>                            
                            {{-- <td class="text-left">: {{  $application->contact_no }}</td>                             --}}
                        </tr>
                        <tr>
                            <th width="50%">Number of beds</th>                            
                            {{-- <td class="text-left">: {{  $application->fax }}</td>                             --}}
                        </tr>
                        <tr>
                            <th width="50%">Staff Number</th>                            
                            {{-- <td class="text-left">: {{  $application->email }}</td>                             --}}
                        </tr>
                    </table>    
                </td>                             
            </tr>
        </table>
    <hr>
    @if ($data->count() > 0)    
    @foreach ($data as $chapter)
        <div class="card collapsed-card">
            <div class="card-header" data-card-widget="collapse">
                <strong>{{$chapter->checklist_ch_name}}</strong>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table order-list table-bordered" id="">
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
                                @foreach ($chapterArea->checkListStandards as $checkListStandard) 
                                        @php
                                            $standardlengh=$checkListStandard->count();
                                        @endphp
                                        <tr>
                                            @if ($area != $chapterArea->checklist_area)
                                            <td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}"> {{ $chapterArea->checklist_area }} </td>
                                            @endif
                                            <td><input type="hidden" name="checklist_id[]" value="{{ $checkListStandard->checklist_id }}">{{ $checkListStandard->checklist_standard }}</td>
                                            <td>{{ $checkListStandard->checklist_pts }}</td>
                                            <td><input type="text" size="4" name="checklist_pts[]" value="" class="txt numeric-only"></td>
                                            <td>{{ $checkListStandard->standard_code }}</td>
                                            <td><input type="text" size="4" name="ratingpoint[]" value="" class="bstxt numeric-only"></td>
                                            @php
                                            $area = $chapterArea->checklist_area
                                            @endphp 
                                        </tr>
                                @endforeach  
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection


