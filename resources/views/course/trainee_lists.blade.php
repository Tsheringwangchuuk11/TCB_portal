@extends('layouts.manager')
@section('page-title', 'Trainees')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Detail List</h3>
                </div>
                <div class="card-body">
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Course Title</th>
                                <th>Intake Capacity</th>
                                <th>Application Date</th>
                                <th>Course Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coursedtllists as $coursedtllist)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td> <a href="{{ url('course/trainee-apply-list/'. $coursedtllist->id) }}"> {{$coursedtllist->dropdown_name}}</a></td>
                                <td>{{$coursedtllist->total_slot}}</td>
                                <td>{{ date_format(date_create($coursedtllist->app_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->app_end_date), "F jS Y") }}</td>
                                <td>{{ date_format(date_create($coursedtllist->course_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->course_end_date), "F jS Y") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                "info": false,
                "autoWidth": false,
            });
      $('.coursedtls').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.course_model_body').load(dataURL,function(){
                $('#course_modal').modal({show:true});
            });
        });
    })
</script>
@endsection
