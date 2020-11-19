@extends('frontend/layouts/template')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Course List</h5>
    </div>
    <div class="card-body">
        <table id="datatable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course Title</th>
                    <th>Application Date</th>
                    <th>Course Date</th>
                    <th>Location</th>
                    <th>Intake Capacity</th>
                    <th>Contact Person</th>
                    <th>Contact No.</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coursedtllists as $coursedtllist)
                @if ($coursedtllist->id!=null)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $coursedtllist->dropdown_name }}</td>
                    <td>{{ date_format(date_create($coursedtllist->app_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->app_end_date), "F jS Y") }}</td> 
                    <td>{{ date_format(date_create($coursedtllist->course_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->course_end_date), "F jS Y") }}</td> 
                    <td>{{ $coursedtllist->dzongkhag_name }}</td>
                    <td>{{ $coursedtllist->total_slot }}</td>
                    <td>{{ $coursedtllist->contact_person }}</td>
                    <td>{{ $coursedtllist->mobile_no }}</td>
                    @if($coursedtllist->course_status == 1)
                    <td><span class="badge badge-pill badge-danger">Closed</span></td>
                    @else
                    <td><a class="badge badge-pill badge-info" href="{{ url('registration-for-training/'. $coursedtllist->id) }}"> Apply</a></td>
                    @endif
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
@endsection
