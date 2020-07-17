@extends('layouts.pdf')
@section('title', $reportTitle)
@section('content')
    <p class="print-title text-center">{{$reportTitle}}</p>
    <table class="main">
        <thead>
        <tr>
            <th class="text-center">#</th>
            @if($reportTypeId == 1)
                <th style="background-color: #45d090;">Air</th>
                <th style="background-color: #45d090;">Land</th>
            @elseif($reportTypeId == 2)
                <th style="background-color: #45d090;">Nationality</th>
            @elseif($reportTypeId == 3)
                <th style="background-color: #45d090;">Activity</th>
            @elseif($reportTypeId == 4)
                <th style="background-color: #45d090;">Dzongkhag</th>
            @endif
            <th style="background-color: #45d090;">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($statisticReportDtls as $reportDtl)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                @if($reportTypeId == 1)
                    <td>{{ $reportDtl->air }}</td>
                    <td>{{ $reportDtl->land }}</td>
                @else
                    <td>{{ $reportDtl->name }}</td>
                @endif
                <td>{{ $reportDtl->total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
