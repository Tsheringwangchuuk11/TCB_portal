@extends('layouts.pdf')
@section('title', 'Hotel Assessment')
@section('content')
    <p class="print-title text-center">Hotel Assessment</p>
	<table>        
        <tr>
            <td width="25%">
                <h5>Data about accommodation</h5>                
            </td>            
        </tr>
        <tr>
            <th with="50%">1)  Name and type of accommodation :</th>
            <td with="50%">{{ $application->company_title_name }}</td>
        </tr>
        <tr>
            <th>2)  Licence  number/date :</th>
            <td>{{ $application->license_no .'/'. $application->license_date}}</td>
            
        </tr>
        <tr>
            <th>3)  Accommodation owner/manage :</th>
            <td>{{ $application->owner_name }}</td>
        </tr>
        <tr>
            <th>4)  Address :</th>
            <td>{{ $application->address}}</td>
        </tr>
        <tr>
            <th>5)  Telephone :</th>
            <td>{{ $application->contact_no}}</td>
        </tr>
        <tr>
            <th>6)  Fax :</th>
            <td>{{ $application->fax}}</td>
        </tr>
        <tr>
            <th>7)  E-mail :</th>
            <td>{{ $application->email }}</td>
        </tr>
        <tr>
            <th>8)  Internet Homepage :</th>
            <td>{{ $application->webpage_url }}</td>
        </tr>
        <tr>
            <th>9)  Room Count :</th>  
            <td></td>                               
        </tr>
        <tr>                     
            <th>Single Room :</th>
            <td></td>
        </tr>
        <tr>
            <th>Double Room :</th>
            <td></td>
        </tr>
        <tr>
            <th>Suites Room :</th>
            <td></td>
        </tr>
        <tr>
            <th>10)  Number of beds :</th>
            <td></td>
        </tr>
        <tr>
            <th>11)  Staff Number :</th>
            <td></td>
        </tr>        
    </table>  
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


