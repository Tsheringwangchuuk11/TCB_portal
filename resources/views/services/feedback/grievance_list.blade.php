@extends('layouts.manager')
@section('page-title','Grievance Redressal')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Grievance Redressal List</h4>
    </div>
        <div class="card-body">
            <table id="tableId" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Application Number</th>
                        <th>Complainant Name</th>
                        <th>Contact Number</th>
                        <th>Submitted Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grievanceLists as $grievanceList)
                    <tr>
                        <td>
                            <a href="{{ url('feedback/openApplication',['applicationNo'=>$grievanceList->application_no]) }}" data-toggle="tooltip" title="{{ $grievanceList->application_no }} - Open">
                                    {{ $grievanceList->application_no }}
                            </a>
                        </td>
                        <td> {{ $grievanceList->complainant_name }}</td>
                        <td> {{ $grievanceList->complainant_mobile_no }}</td>
                        <td> {{ date('d/m/Y', strtotime($grievanceList->date)) }}</td>
                    </tr>  
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-danger">There are no data.</td>
                    </tr> 
                    @endforelse
                </tbody>
            </table><br>
            <div class="float-right">
                 {{ $grievanceLists->links() }}
            </div>
        </div>
</div>
@endsection




