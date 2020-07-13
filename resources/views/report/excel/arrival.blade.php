<table>
    <thead>
    <tr>
        <th colspan="4">{{$reportTitle}}</th>
    </tr>
    <tr>
        <th style="background-color: #45d090;">#</th>
        <th style="background-color: #45d090;">Air</th>
        <th style="background-color: #45d090;">Land</th>
        <th style="background-color: #45d090;">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($statisticReportDtls as $reportDtl)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $reportDtl->air }}</td>
            <td>{{ $reportDtl->land }}</td>
            <td>{{ $reportDtl->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
