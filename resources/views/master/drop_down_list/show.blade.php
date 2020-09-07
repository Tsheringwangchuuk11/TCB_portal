
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $masterdropdown->master_name }}</h3>
            <div class="card-tools pull-right">
                @if ($privileges["create"] == 1)
                <input type="hidden" name="masterId" id="masterId" value="{{ $masterdropdown->id }}" class="form-control">
                <a href="javascript:void(0)" class="btn  btn-sm btn-success  btn-flat" id="add-dropdown_list"><i class="fa fa-plus" ></i> Add</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="datatableId" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Dropdown Name</th>
                        <th>Active Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tablebodyId">
                    <input type="hidden" id="datacount" value="{{ $dropdownlists->count()}}" />
                    @foreach($dropdownlists as $dropdownlist)
                    <tr id="dropdown_id_{{ $dropdownlist->id }}">
                        <td class="text-center">
                            <input type="hidden" id="hidden_id_{{ $dropdownlist->id }}" value="{{ $loop->iteration}}" />
                            {{ $loop->iteration }}</td>
                        <td>{{$dropdownlist->dropdown_name}}</td>
                        <td>
                            @if ($dropdownlist->is_active=="Y")
                            Yes 
                            @else
                            No
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($privileges["edit"] == 1)
                               <a href="javascript:void(0)" id="edit_drop_down_list" data-id="{{ $dropdownlist->id }}" class="btn  btn-sm btn-info  btn-flat" title="Edit">Edit</a>
                            @endif
                            @if((int)$privileges->delete == 1)
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat" data-id="{{ $dropdownlist->id }}" title="Delete"  id="delete_drop_down_list">
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
            <h4 class="modal-title">{{$masterdropdown->master_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dropdownlist">
                <form id="dropdownform" action="{{ url('master/drop-down-master') }}" class="form-horizontal" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Dropdown Name<span class="text-danger">*</span></label>
                                <input type="text" name="dropdown_name" class="form-control" id="dropdown_name">
                                <div class="alert alert-danger" id="dropDownNameErrorMsg" style="display:none"></div>
                                <input type="hidden" name="master_id" id="master_id" class="form-control">
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
            <h4 class="modal-title">{{$masterdropdown->master_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dropdownlist">
                <form id="edit_dropdownform" action="{{ url('master/drop-down-master/update') }}" class="form-horizontal" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Dropdown Name <span class="text-danger">*</span></label>
                                <input type="text" name="dropdown_name" id="edit_dropdown_name" class="form-control">
                                <input type="hidden" name="drop_down_id" id="edit_drop_down_id">

                            </div>
                        </div>
                        <div class="col-md-5 offset-md-2">
                            <div class="form-group">
                               <label for="">Active Status <span class="text-danger">*</span></label>
                               <div class="form-check">
                                <input type="radio" name="is_active" id="status1" value="Y" {{ old('status') == null || old('status') == 'Y' ? 'checked' : '' }}>          
                                <label class="form-check-label">Yes </label>
                                <input type="radio" name="is_active" id="status2" value="N" {{ old('status') == null || old('status') == 'N' ? 'checked' : '' }}> 
                                <label class="form-check-label">No</label>
                              </div>
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
            <form action="{{ url('master/drop-down-master/destroy') }}" id="deletedropdown" method="POST">
                @csrf
                @method('DELETE')
            <div class="modal-body" id="form-body">
                <div class="alert alert-info alert-dismissible" id="alertMyId" style="display: none">
                    <i class="fa fa-info-circle fa-lg"></i><strong><span id="myMsg"></span></strong>
                </div>
                <p>
                    Are you sure you want to delete this ?
                </p> 
                <input type="hidden" name="drop_down_id" id="drop_down_id" value="">
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
            $('#dropdownform').validate({
                rules: {
                    dropdown_name: {
                    required: true,
                    },
                },
                messages: {
                    dropdown_name: {
                    required: "Please enter a dropdown name",
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
                    dropdown_name: {
                    required: true,
                    },
                },
                messages: {
                    dropdown_name: {
                    required: "Please enter a dropdown name",
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
            $("#drop_down_id").val(dataId);
        }); 

        $('#add-dropdown_list').on('click',function(){
            var masterId = $("#masterId").val();
            $('#add_dropdown_list_modal').modal({show:true});
                $('#master_id').val(masterId);
           
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
                        $('#dropdownform').trigger("reset");
                        $('#add_dropdown_list_modal').modal('hide');
					    var dropdownlist = '<tr id="dropdown_id_' + data.id + '"><td class="text-center">'+ slNo +'<input type="hidden" id="hidden_id_' + data.id + '" value="'+slNo+'" /></td><td>' + data.dropdown_name + '</td><td>' + (data.is_active == 'Y' ? 'Yes' : 'No') + '</td>';
                            dropdownlist += '<td class="text-center"><a href="javascript:void(0)" id="edit_drop_down_list" data-id="' + data.id + '" class="btn  btn-sm btn-info  btn-flat add-dropdown_list" title="Edit">Edit</i></a> ';
                            dropdownlist += '<a href="javascript:void(0)" data-id="' + data.id + '" class ="btn btn-sm btn-danger btn-flat" title="Delete" id="delete_drop_down_list"><i class="fas fa-trash"></i></a></td></tr>';
                          $('#tablebodyId').append(dropdownlist);
			        }
		     });
	  });
      	//edit
    $('body').on('click', '#edit_drop_down_list', function () {
        var dropdownId = $(this).data('id');
        $.get('/master/drop-down-master/'+dropdownId+'/edit', function (data) {		  
            $('#edit_dropdown_list_modal').modal('show');
            $('#edit_drop_down_id').val(data.id);		
            $('#edit_dropdown_name').val(data.dropdown_name);		
            (data.is_active == 'Y'? $('#status1').prop("checked", true):$('#status2').prop("checked", true));
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
                slNo = $('#hidden_id_'+data.id).val();
                $('#edit_dropdown_list_modal').modal('hide');
                var dropdownlist = '<tr id="dropdown_id_' + data.id + '"><td class="text-center">'+ slNo +'<input type="hidden" id="hidden_id_' + data.id + '" value="'+slNo+'" /></td><td>' + data.dropdown_name + '</td><td>' + (data.is_active == 'Y' ? 'Yes' : 'No') + '</td>';
                    dropdownlist += '<td class="text-center"><a href="javascript:void(0)" id="edit_drop_down_list" data-id="' + data.id + '" class="btn  btn-sm btn-info  btn-flat add-dropdown_list" title="Edit">Edit</i></a> ';
                    dropdownlist += '<a href="javascript:void(0)" data-id="' + data.id + '" class ="btn btn-sm btn-danger btn-flat" title="Delete" id="delete_drop_down_list"><i class="fas fa-trash"></i></a></td></tr>';
                    $("#dropdown_id_" + data.id).replaceWith(dropdownlist);
			  }
		  });
	  });

    $("#deletedropdown").click(function(){
        var formData = $('#deletedropdown');
        var rowId=$("#drop_down_id").val();
		 $.ajax({
            type: formData.attr('method'),
            url: formData.attr('action'),
            data: formData.serialize(),
			dataType: 'json',
			  success: function (data) {
                if(data.status = 'true'){
                $("#dropdown_id_" + rowId).remove();
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
