<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Purpose Survey Detail List</h3>
            </div>
            <div class="card-body">
                @if ($report_category_id==1)
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Purpose</th>
                                <th>Value</th>
                                <th>Vistors Types</th>
                                <th>Country</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purposesurveylists as $purposesurveylist)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{$purposesurveylist->purpose}}</td>
                                    <td>{{$purposesurveylist->value}}</td>
                                    <td>{{$purposesurveylist->visitor_types}}</td>
                                    <td>{{$purposesurveylist->country}}</td>
                                    <td>{{$purposesurveylist->year}}</td>
                                    <td>
                                        @if((int)$privileges->delete == 1)
                                            <a href="javascript:void(0)" data-href="{{ url('statistical/edit-purpose-survey/'.$purposesurveylist->id) }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                        @endif
                                        @if((int)$privileges->delete == 1)
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat delete_option" data-id="{{ $purposesurveylist->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($report_category_id==2)
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Purpose</th>
                                <th>Gender</th>
                                <th>Value</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purposesurveylists as $purposesurveylist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$purposesurveylist->purpose}}</td>
                                <td>
                                    @if ($purposesurveylist->gender=='F')
                                        Female
                                    @else
                                            Male
                                    @endif
                                </td>
                                <td>{{$purposesurveylist->value}}</td>
                                <td>{{$purposesurveylist->year}}</td>
                                <td>
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/edit-purpose-survey/'.$purposesurveylist->id) }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat delete_option" data-id="{{ $purposesurveylist->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($report_category_id==3)
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Purpose</th>
                                @if ($visitor_type_id==316)
                                <th>Gender</th>
                                @endif
                                <th>Value</th>
                                <th>Vistor Types</th>
                                <th>Dzongkhag</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purposesurveylists as $purposesurveylist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$purposesurveylist->purpose}}</td>
                                @if ($visitor_type_id==316)

                                <td>
                                    @if ($purposesurveylist->gender=='F')
                                        Female
                                    @else
                                            Male
                                    @endif
                                </td>
                                @endif
                                <td>{{$purposesurveylist->value}}</td>
                                <td>{{$purposesurveylist->visitor_types}}</td>
                                <td>{{$purposesurveylist->dzongkhag_name}}</td>
                                <td>{{$purposesurveylist->year}}</td>
                                <td>
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/edit-purpose-survey/'.$purposesurveylist->id) }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat delete_option" data-id="{{ $purposesurveylist->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif($report_category_id==4)
                    <table id="datatableId" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Purpose</th>
                                <th>Gender</th>
                                <th>Value</th>
                                <th>Dzongkhag</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purposesurveylists as $purposesurveylist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{$purposesurveylist->purpose}}</td>
                                <td>
                                    @if ($purposesurveylist->gender=='F')
                                        Female
                                    @else
                                            Male
                                    @endif
                                </td>
                                <td>{{$purposesurveylist->value}}</td>
                                <td>{{$purposesurveylist->dzongkhag_name}}</td>
                                <td>{{$purposesurveylist->year}}</td>
                                <td>
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" data-href="{{ url('statistical/edit-purpose-survey/'.$purposesurveylist->id) }}"  class="btn  btn-sm btn-info  btn-flat editdata" title="Edit">Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat delete_option" data-id="{{ $purposesurveylist->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 @else
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_data_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="model_hearder_name_edit"></span>,<small><span id="report_category_name_edit"></span></small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edit_data_model_body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="form-confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="form-title"> Delete confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('statistical/delete-purpose-survey') }}"  method="POST">
                @csrf
                @method('DELETE')
            <div class="modal-body" id="form-body">
                <p>
                    Are you sure you want to delete this ?
                </p> 
                <input type="hidden" name="record_id" id="record_id" value="">
            </div>
            <div class="modal-footer text-right">
                <button type="submit" class="btn btn-danger btn-sm" id="deletedropdown"><i class="fas fa-check"></i> PROCEED</button>
            </div>
        </form>
        </div>
    </div>
</div>
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
        })

        $('.editdata').on('click',function(){
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#model_hearder_name_edit").html(report_type__name);

            var report_category_name = $("#report_category_id  option:selected").text();
            $("#report_category_name_edit").html(report_category_name);

            var dataURL = $(this).attr('data-href');
            $('.edit_data_model_body').load(dataURL,function(){
                $('#edit_data_modal').modal({show:true});
            });
        });
        $('body').on('click', '.delete_option', function () {
            var dataId = $(this).attr('data-id');
            $('#form-confirm').modal({show:true});
            $("#record_id").val(dataId);
        });
    </script>
