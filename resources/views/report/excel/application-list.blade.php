<table>
    <thead>
        <tr>
            <th colspan="4">Application List</th>
        </tr>
        <tr>
            <th style="background-color: #45d090;">#</th>
            <th style="background-color: #45d090;">Application No.</th>
            <th style="background-color: #45d090;">Module Name</th>
            <th style="background-color: #45d090;">Services</th>
            <th style="background-color: #45d090;">Applicant Name</th>           
            <th style="background-color: #45d090;">Applicant CID</th>           
            <th style="background-color: #45d090;">Status</th>           
            <th style="background-color: #45d090;">Submitted Date</th>           
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $application)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $application->application_no }}</td>
                <td>{{ $application->module_name }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->applicant_name }}</td>
                <td>{{ $application->cid_no }}</td>                                                                            
                <td>{{ $application->status_name }}</td>                                                                            
                <td>{{ $application->created_at }}</td> 
            </tr>
        @endforeach
    </tbody>
</table> 