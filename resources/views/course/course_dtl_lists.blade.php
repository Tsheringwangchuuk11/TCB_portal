@extends('layouts.manager')
@section('page-title', 'Courses')
@section('buttons')
     <a href="javascript:void(0)" data-href="{{ url('course/course-create') }}"  class="btn  btn-sm btn-success  btn-flat coursedtls"><i class="fa fa-plus" ></i> Add Course</a>
@endsection
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
                                <th>Application Date</th>
                                <th>Course Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coursedtllists as $coursedtllist)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{$coursedtllist->dropdown_name}}</td>
                                <td>{{ date_format(date_create($coursedtllist->app_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->app_end_date), "F jS Y") }}</td>
                                <td>{{ date_format(date_create($coursedtllist->course_start_date), "F jS Y") }} to {{ date_format(date_create($coursedtllist->course_end_date), "F jS Y") }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-href="{{ url('course/course-edit/'. $coursedtllist->id) }}"  class="btn  btn-sm btn-info  btn-flat coursedtls" title="Edit">Edit</a>
                                    <a href="#" class="form-confirm  btn btn-sm btn-danger  btn-flat" title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <a data-form="#frmDelete-{!! $coursedtllist->id !!}" data-title="Delete {!! $coursedtllist->dropdown_name !!}" data-message="Are you sure you want to delete this course details ?"></a>
                                    </a>
                                    <form action="{{ ('course/delete-course/' . $coursedtllist->id) }}" method="POST" id="{{ 'frmDelete-'.$coursedtllist->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="course_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body course_model_body">
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.include.confirm-delete')
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
