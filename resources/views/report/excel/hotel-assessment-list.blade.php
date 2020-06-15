<table>
    <thead>
        <tr>
            <th colspan="4">Hotel Assessment List</th>
        </tr>
        <tr>
            <th style="background-color: #45d090;">#</th>
            <th style="background-color: #45d090;">Application No.</th>
            <th style="background-color: #45d090;">License No.</th>
            <th style="background-color: #45d090;">Owner Name</th>
            <th style="background-color: #45d090;">Submitted Date</th>           
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $application)
            <tr>
                <td class="text-center">{{ $loop->iteration}}</td>
                <td>{{$application->application_no}}</td>
                <td>{{$application->license_no}}</td>
                <td>{{$application->owner_name}}</td>
                <td>{{$application->created_at}}</td> 
            </tr>
        @endforeach
    </tbody>
</table> 