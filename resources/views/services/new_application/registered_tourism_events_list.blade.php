@extends('layouts.enduser')
@section('page-title', 'Event')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Event List</h3>
                </div>
                <div class="card-body">
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Event Name</th>
                                <th>Country</th>
                                <th>Contact Person</th>
                                <th>Contact Address</th>
                                <th>Event Date</th>
                                <th>Last Date Registration</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($eventFairDetails as $eventFairDetail)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{$eventFairDetail->event_name}}</td>
                                <td>{{$eventFairDetail->dropdown_name}}</td>
                                <td>{{$eventFairDetail->contact_person}}</td>
                            <td>{{$eventFairDetail->mobile_no}} / {{$eventFairDetail->email}}</td>
                                <td>{{ date_format(date_create($eventFairDetail->start_date), "F jS Y") }} to {{ date_format(date_create($eventFairDetail->end_date), "F jS Y") }}</td>
                                <td>{{ date_format(date_create($eventFairDetail->last_date), "F jS Y") }} </td>
                                <td class="text-center">
                                    <a href="{{ url('application/get-event-details',['id'=>$eventFairDetail->id,'serviceId'=>$idInfos->service_id,'moduleId'=>$idInfos->module_id]) }}" class="btn bg-blue btn-xs btn-flat"><i class="fa fa-tasks"></i> Apply </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-danger text-center">No events to be displayed</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    {{-- <div class="float-right">
                        {{ $countrylists->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#datatableId').DataTable({
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