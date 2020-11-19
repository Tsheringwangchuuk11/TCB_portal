<table>
    <thead>
        <tr>
            <th colspan="4">Hotel Assessment List</th>
        </tr>
        <tr>
            <th style="background-color: #45d090;">#</th>
            <th style="background-color: #45d090;">Application No.</th>
            <th style="background-color: #45d090;">CID.</th>
            <th style="background-color: #45d090;">Owner Name</th>
            <th style="background-color: #45d090;">Submitted Date</th>           
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $application)
            <tr>
                <td class="text-center">{{ $loop->iteration}}</td>
                <td>{{$application->application_no}}</td>
                <td>{{$application->cid_no}}</td>
                @if ($application->module_id===2)
                <td>{{$application->applicant_name}}</td>
                @else
                <td>{{$application->owner_name}}</td>
                @endif
                <td>{{$application->created_at}}</td> 
            </tr>
        @endforeach
    </tbody>
</table> 