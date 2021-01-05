
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $dropdown->dropdown_name }}</h3>
            <div class="card-tools pull-right">
                @if ($privileges["create"] == 1)
                <input type="hidden" name="highlighttypeid" id="highlighttypeid" value="{{ $dropdown->id }}" class="form-control">
                <a href="javascript:void(0)" class="btn  btn-sm btn-success  btn-flat" id="add-dropdown_list"><i class="fa fa-plus" ></i> Add</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="datatableId" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Key highlight Types</th>
                        <th>Total Number</th>
                        <th>Percent</th>
                        <th>Year</th>
                        <th>Publish Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablebodyId">
                    <input type="hidden" id="datacount" value="{{ $keyhighligtslists->count()}}" />
                    @foreach($keyhighligtslists as $keyhighligtslist)
                    <tr id="key_highlight_id_{{ $keyhighligtslist->key_highlight_id }}">
                        <td class="text-center">
                            <input type="hidden" id="hidden_id_{{ $keyhighligtslist->key_highlight_id }}" value="{{ $loop->iteration}}" />
                            {{ $loop->iteration }}</td>
                        <td>{{$keyhighligtslist->dropdown_name}}</td>
                        <td>{{$keyhighligtslist->total_no}}</td>
                        <td>{{$keyhighligtslist->percent}}</td>
                        <td>{{$keyhighligtslist->year}}</td>
                        <td>
                            @if ($keyhighligtslist->is_publish=='N')
                                No
                            @else
                                 Yes  
                            @endif
                        </td>
                        <td class="btn-group">
                            @if ($privileges["edit"] == 1)
                               <a href="javascript:void(0)" id="edit_drop_down_list" data-id="{{ $keyhighligtslist->key_highlight_id }}" class="btn  btn-sm btn-info  btn-flat" title="Edit">Edit</a>
                            @endif
                            @if((int)$privileges->delete == 1)
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat" data-id="{{ $keyhighligtslist->key_highlight_id }}" title="Delete"  id="delete_drop_down_list">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>           
        </div>
    </div>
</div>
<div class="modal fade" id="add_dropdown_list_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">{{$dropdown->dropdown_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dropdownlist">
                <form id="dropdownform" action="{{ url('master/highlight_types') }}" class="form-horizontal" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="">Key Highlights Types<span class="text-danger">*</span></label>
                            <input type="text" name="highlight_type_name" class="form-control" id="highlight_type_name" value="{{$dropdown->dropdown_name}}" readonly>
                                <div class="alert alert-danger" id="dropDownNameErrorMsg" style="display:none"></div>
                                <input type="hidden" name="highlight_type_id" id="highlight_type_id" value="{{ $dropdown->id }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5  offset-md-2">
                            <div class="form-group">
                            <label for="">Total Number</label>
                            <input type="text" name="total_no" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="">Percent<span class="text-danger">*</span></label>
                            <input type="text" name="percent" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <label for="">Year </label>
                            <div class="input-group date" id="year" data-target-input="nearest">
                                <input type="text" name="year" class="form-control datetimepicker-input" data-target="#year" value="{{ old('year') }}">
                                <div class="input-group-append" data-target="#year" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:-14px;">
                        <button type="button" id="add-btn-save" class="btn btn-success btn-flat margin-r-5">Save</button>
                        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_dropdown_list_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">{{$dropdown->dropdown_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dropdownlist">
                <form id="edit_dropdownform" action="{{ url('master/highlight_types/update') }}" class="form-horizontal" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                            <label for="">Key Highlights Types<span class="text-danger">*</span></label>
                            <input type="text" name="highlight_type_name" class="form-control" id="edit_highlight_type_name"  readonly>
                                <input type="hidden" name="highlight_type_id" id="edit_highlight_type_id" class="form-control">
                                <input type="hidden" name="key_highlight_id" id="edit_key_highlight_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5  offset-md-2">
                            <div class="form-group">
                            <label for="">Total Number<span class="text-danger">*</span></label>
                            <input type="text" name="total_no" id="edit_total_no" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Percent</label>
                                <input type="text" name="percent" id="edit_percent" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-5 offset-md-2">
                            <div class="form-group">
                                <label for="">Year<span class="text-danger">*</span> </label>
                                <input type="text" name="year" class="form-control datetimepicker-input" id="edit_year" data-toggle="datetimepicker" data-target="#edit_year">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Publish Status<span class="text-danger">*</span> </label>
                                <select class="form-control" name="is_publish" id="edit_is_publish">
                                    <option value=""> </option>
                                    @foreach (config()->get('settings.is_publish') as $k => $v)
                                    <option value="{{ $k }}" {{ old('is_publish') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-bottom:-14px;">
                        <button type="button" id="edit-btn-save" class="btn btn-success btn-flat margin-r-5">Update</button>
                        <button type="button" class="btn btn-flat btn-close btn-danger float-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
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
            <form action="{{ url('master/highlight_types/destroy') }}" id="deletedropdown" method="POST">
                @csrf
                @method('DELETE')
            <div class="modal-body" id="form-body">
                <div class="alert alert-info alert-dismissible" id="alertMyId" style="display: none">
                    <i class="fa fa-info-circle fa-lg"></i><strong><span id="myMsg"></span></strong>
                </div>
                <p>
                    Are you sure you want to delete this ?
                </p> 
                <input type="hidden" name="key_highlight_id" id="delete_key_highlight_id" value="">
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-danger btn-sm" id="deletedropdown"><i class="fas fa-check"></i> PROCEED</button>
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
        $('#year').datetimepicker({
            viewMode: 'years',
            format: 'YYYY',
            useCurrent: true
        }); 
        $('#edit_year').datetimepicker({
            viewMode: 'years',
            format: 'YYYY',
            useCurrent: true
        });
        $('#dropdownform').validate({
            rules: {
                total_no: {
                required: true,
                },
                year: {
                required: true,
                },
            },
            messages: {
                total_no: {
                required: "Please enter total number",
                },
                year: {
                required: "Please enter year",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#edit_dropdownform').validate({
            rules: {
                total_no: {
                required: true,
                },
                year: {
                required: true,
                },
            },
            messages: {
                total_no: {
                required: "Please enter total number",
                },
                percent: {
                required: "Please enter percent",
                },
                year: {
                required: "Please enter year",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		}); 
        $('body').on('click', '#delete_drop_down_list', function () {
            var dataId = $(this).attr('data-id');
            $('#form-confirm').modal({show:true});
            $("#delete_key_highlight_id").val(dataId);
        }); 

        $('#add-dropdown_list').on('click',function(){
            $('#add_dropdown_list_modal').modal({show:true});
        });

        $('#add-btn-save').click(function(e){
            if (!$("#dropdownform").valid()) {
            return false;
           }
        $('.dataTables_empty').remove();
        var formData = $('#dropdownform');
        var a =  $('#datatableId').find('tr').length;
        var slNo=a-1;
		 $.ajax({
            type: formData.attr('method'),
            url: formData.attr('action'),
            data: formData.serialize(),
			  dataType: 'json',
			  success: function (data) {
                         var publis_status=null;
                         if(data.is_publish=='N'){
                            publis_status="No";
                         }else{
                            publis_status="Yes";
                         }
                        $('#dropdownform').trigger("reset");
                        $('#add_dropdown_list_modal').modal('hide');
					    var dropdownlist = '<tr id="key_highlight_id_' + data.key_highlight_id + '"><td class="text-center">'+ slNo +'<input type="hidden" id="hidden_id_' + data.key_highlight_id + '" value="'+slNo+'" /></td><td>' + data.dropdown_name + '</td><td>' + data.total_no + '</td><td>'+data.percent+'</td><td>' +data.year + '</td><td>' +publis_status+ '</td>';
                            dropdownlist += '<td class="btn-group" ><a href="javascript:void(0)" id="edit_drop_down_list" data-id="' + data.key_highlight_id + '" class="btn  btn-sm btn-info  btn-flat add-dropdown_list" title="Edit">Edit</i></a> ';
                            dropdownlist += '<a href="javascript:void(0)" data-id="' + data.key_highlight_id + '" class ="btn btn-sm btn-danger btn-flat" title="Delete" id="delete_drop_down_list"><i class="fas fa-trash"></i></a></td></tr>';
                          $('#tablebodyId').append(dropdownlist); 
			        }
		     });
      });
      
    //edit
    $('body').on('click', '#edit_drop_down_list', function () {
        var key_highlight_id = $(this).data('id');
        $.get('/master/highlight_types/'+key_highlight_id+'/edit', function (data) {		  
            $('#edit_dropdown_list_modal').modal('show');
            $('#edit_highlight_type_name').val(data.dropdown_name);		
            $('#edit_highlight_type_id').val(data.highlight_type_id);	
            $('#edit_total_no').val(data.total_no);
            $('#edit_percent').val(data.percent);
            $('#edit_year').val(data.year);	
            $('#edit_key_highlight_id').val(key_highlight_id);
            $('#edit_is_publish').val(data.is_publish).trigger("change");

        })
    });

    $('#edit-btn-save').click(function(e){
            if (!$("#edit_dropdownform").valid()) {
            return false;
           }
        var formData = $('#edit_dropdownform');
		 $.ajax({
            type: formData.attr('method'),
            url: formData.attr('action'),
            data: formData.serialize(),
			  dataType: 'json',
			  success: function (data) {
                slNo = $('#hidden_id_'+data.key_highlight_id).val();
                $('#edit_dropdown_list_modal').modal('hide');
                var publis_status=null;
                    if(data.is_publish=='N'){
                        publis_status="No";
                    }else{
                        publis_status="Yes";
                    }
                var dropdownlist = '<tr id="key_highlight_id_' + data.key_highlight_id + '"><td class="text-center">'+ slNo +'<input type="hidden" id="hidden_id_' + data.key_highlight_id + '" value="'+slNo+'" /></td><td>' + data.dropdown_name + '</td><td>' + data.total_no + '</td><td>'+data.percent+'</td><td>' +data.year + '</td><td>'+ publis_status +'</td>';
                    dropdownlist += '<td class="btn-group"><a href="javascript:void(0)" id="edit_drop_down_list" data-id="' + data.key_highlight_id + '" class="btn  btn-sm btn-info  btn-flat add-dropdown_list" title="Edit">Edit</i></a> ';
                    dropdownlist += '<a href="javascript:void(0)" data-id="' + data.key_highlight_id + '" class ="btn btn-sm btn-danger btn-flat" title="Delete" id="delete_drop_down_list"><i class="fas fa-trash"></i></a></td></tr>';
                    $("#key_highlight_id_" + data.key_highlight_id).replaceWith(dropdownlist);
			  }
		  });
	});

    $("#deletedropdown").click(function(){
        var formData = $('#deletedropdown');
        var rowId=$("#delete_key_highlight_id").val();
		 $.ajax({
            type: formData.attr('method'),
            url: formData.attr('action'),
            data: formData.serialize(),
			dataType: 'json',
			  success: function (data) {
                if(data.status = 'true'){
                $("#key_highlight_id_" + rowId).remove();
                $('#form-confirm').modal('hide');
                }else{
                      $('#myMsg').html(data.falsemsg);
                        $('#alertMyId').show().delay(3000).queue(function (n) {
                            $(this).hide();
                            n();
                    });
                 }
			  }
		  });
     });
 })
</script>
