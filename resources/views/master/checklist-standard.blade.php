@extends('layouts.manager')
@section('page-title', 'List of Checklist Standards')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
        {{--<a href="{{ url('master/checklist-standards/create')}}" class="btn btn-sm btn-success"> <i class="fas fa-plus"></i> Add Checklist Standard</a>--}}
        <a href="javascript:void(0)" class="btn btn-success mb-2 float-right" id="create_new_checklist_standard"> <i class="fas fa-plus"></i> Add Checklist Standard</a>
    @endif
@endsection
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Checklist Standard's Details</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible" id="success_msg_id" style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            </div>
            <div class="alert alert-danger alert-dismissible" id="valid_msg_id" style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <label for="" >Module </label>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="" class="form-control required select2bs4 module" id="module">
                            <option value="">---SELECT---</option>
                            @foreach ($serviceModules as $serviceModule)
                                <option value="{{ $serviceModule->id }}" {{ old('service_module') == $serviceModule->id ? 'selected' : '' }}>{{ $serviceModule->module_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="" >Checklist Chapter </label>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="chapter_id" class="form-control chapter_id required select2bs4" id="chapter_id" disabled>
                            <option value="">---SELECT MODULE FIRST---</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-inline ml-3 float-right">
                        <input class="form-control" type="search" name="search" placeholder="Search" id="searchId" aria-label="Search">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="2%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer"># <span id="id_icon"></span></th>
                        <th width="10%" class="sorting" data-sorting_type="asc" data-column_name="checklist_area" style="cursor: pointer">Checklist Area <span id="checklist_area_icon"></span></th>
                        <th width="40%" class="sorting" data-sorting_type="asc" data-column_name="checklist_standard" style="cursor: pointer">Checklist Standard <span id="checklist_standard_icon"></span></th>
                        <th width="5%">Checklist Points</th>
                        <th width="5%">Status</th>
                        <th width="8%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_id">
                        @include('master.includes.checklist_standard_data')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="alert alert-danger" id="error_msg_id" style="display:none" >
                    <ul></ul>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="checklistCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('master/checklist-areas') }}" method="POST" id="checklistForm">
                        @csrf
                        <div class="modal-body" id="frm_body">
                            <input type="hidden" name="checklist_standard_id" id="checklist_standard_id" />
                            <input type="hidden" name="standard_mapping_id" id="standard_mapping_id" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" >Checklist Area <code>*</code></label>
                                        <select name="checklist_area" class="form-control required checklistArea select2bs4" id="checklistArea">
                                            <option value="">---SELECT---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Checklist Standard <code>*</code></label>
                                        <textarea name="checklist_standard" rows="3" class="form-control required" id="checklist_standard"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="row_id">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Checklist Point</label>
                                        <input type="text" id= "checklist_point" name="checklist_point" class="form-control numeric-only">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" >Basic Standard <code>*</code></label>
                                        <select name="basic_standard" class="form-control required baseStandard select2bs4" id="basic_standard_id">
                                            <option value="">---SELECT---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" id="col_id">
                                    <div class="form-group">
                                        <label for="" >Basic Standard <code>*</code></label>
                                        <select name="basic_standard1" class="form-control required baseStandard select2bs4" id="basic_standard_id1">
                                            <option value="">---SELECT---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="col_id1">
                                    <div class="form-group">
                                        <label for="">Checklist Point</label>
                                        <input type="text" id= "checklist_point1" name="checklist_point1" class="form-control numeric-only">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Status</label><br>
                                        <label>
                                            <input type="radio" id="status1" name="status" value="yes" class="flat-red" {{ old('status') == null || old('status') == 'yes' ? 'checked' : '' }}/>
                                            Yes
                                        </label>
                                        <label>
                                            <input type="radio" id="status2" name="status" value="no" class="flat-red" {{ old('status') == 'no' ? 'checked' : '' }} />
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="row_table_id">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Basic Standard's Details</h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-bordered table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Star Category *</th>
                                                        <th>Basic Standard *</th>
                                                        <th>Mandatory</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_id1">
                                                    @include('master.includes.basic_standard_data')
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-bottom:-14px;">
                            <input type="button" id="btn-save" class="btn btn-outline-success btn-flat margin-r-5" value="create-checklist-area"/>
                            <button type="button" class="btn btn-flat btn-close btn-outline-danger float-left" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var basic_standard_id = '';
            var checklist_pts_id = '';
            //select a module and accordingly get the chapter associated with it using ajax request
            $('select.module').on('change', function(e){
                var selectedModule = $('option:selected', this).val();
                var condition = '';
                basic_standard_id = '';
                //check if module is selected or not
                if (selectedModule.length > 0) {
                    if(selectedModule == 1){
                        $('#row_table_id').show();
                        $('#row_id').hide();
                        $('#col_id').hide();
                        $('#col_id1').show();
                        checklist_pts_id = 'checklist_point1';
                        getBasicStandardDtls();
                    }else if(selectedModule == 2){
                        $('#row_table_id').hide();
                        $('#row_id').hide();
                        $('#col_id').show();
                        $('#col_id1').hide();
                        $('#tbody_id1').html('');
                        condition = 'in';
                        basic_standard_id = 'basic_standard_id1';
                        $("#basic_standard_id option:gt(0)").remove();
                    }else if(selectedModule == 3 || selectedModule == 9){
                        $('#row_table_id').hide();
                        $('#row_id').show();
                        $('#col_id').hide();
                        $('#col_id1').hide();
                        $('#tbody_id1').html('');
                        condition = 'in';
                        if (selectedModule == 9){
                            condition = 'notIn';
                        }
                        basic_standard_id = 'basic_standard_id';
                        checklist_pts_id = 'checklist_point';
                        $("#basic_standard_id1 option:gt(0)").remove();
                    }else if(selectedModule == 4){
                        $('#row_table_id').hide();
                        $('#row_id').hide();
                        $('#col_id').hide();
                        $('#col_id1').hide();
                        $('#tbody_id1').html('');
                    }
                    if(condition != ''){
                        getBasicStandardLists(condition, basic_standard_id);
                    }

                    $.ajax({
                        type: 'GET',
                        url:"{{ url('master/checklist-areas/module') }}",
                        dataType: 'JSON',
                        data: { moduleId: selectedModule },

                        beforeSend: function(){
                            $('#ajax-loading-container').removeClass('hide');
                        },
                        complete: function() {
                            $('#ajax-loading-container').addClass('hide');
                        },

                        success: function(data) {
                            $('select.chapter_id').empty().removeAttr('disabled', false);
                            $('select.chapter_id').append('<option value="">---SELECT ONE---</option>');
                            for (i = 0; i < data.length; i++) {
                                $('select.chapter_id').append('<option value="' + data[i].id + '" data-name="' + data[i].checklist_ch_name + '" >' + data[i].checklist_ch_name + '</option>');
                            }
                        }
                    });
                } else {
                    $('select.chapter_id').empty().attr('disabled', true);
                    $('select.chapter_id').append('<option value="">---SELECT MODULE FIRST---</option>');
                }
            });
            $('select.chapter_id').on('change', function(e){
                var selectedChapterId = $('option:selected', this).val();

                if (selectedChapterId.length > 0) {
                    $.ajax({
                        type: 'GET',
                        url:"{{ url('master/checklist-standards/chapter') }}",
                        dataType: 'JSON',
                        data: { checklistId: selectedChapterId },

                        beforeSend: function(){
                            $('#ajax-loading-container').removeClass('hide');
                        },
                        complete: function() {
                            $('#ajax-loading-container').addClass('hide');
                        },

                        success: function(data) {
                            $('select.checklistArea').empty();
                            $('select.checklistArea').append('<option value="">---SELECT ONE---</option>');
                            for (i = 0; i < data.length; i++) {
                                $('select.checklistArea').append('<option value="' + data[i].id + '" >' + data[i].checklist_area + '</option>');
                            }
                        }
                    });
                    var query = $('#searchId').val();
                    var column_name = $('#hidden_column_name').val();
                    var sort_type = $('#hidden_sort_type').val();
                    var page = $('#hidden_page').val();
                    fetch_data(page, sort_type, column_name, selectedChapterId, query);
                }else {
                    $('select.checklistArea').empty();
                    $('select.checklistArea').append('<option value="">---SELECT---</option>');
                }
            });
            function clear_icon()
            {
                $('#id_icon').html('');
                $('#checklist_area_icon').html('');
                $('#checklist_standard_icon').html('');
            }
            function fetch_data(page, sort_type, sort_by, chapter_id, query)
            {
                $.ajax({
                    url:"/master/checklist-standards?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&chapterid="+chapter_id+"&search_text="+query,
                    success:function(data)
                    {
                        $('#tbody_id').html('');
                        $('#tbody_id').html(data);
                    }
                })
            }
            $(document).on('keyup', '#searchId', function(){
                var query = $('#searchId').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                var chapter_id = $('#chapter_id').val();
                fetch_data(page, sort_type, column_name, chapter_id, query);
            });
            $(document).on('click', '.sorting', function(){
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sorting_type');
                var reverse_order = '';
                if(order_type == 'asc')
                {
                    $(this).data('sorting_type', 'desc');
                    reverse_order = 'desc';
                    clear_icon();
                    $('#'+column_name+'_icon').html('<span class="fas fa-long-arrow-alt-down"></span>');
                }
                if(order_type == 'desc')
                {
                    $(this).data('sorting_type', 'asc');
                    reverse_order = 'asc';
                    clear_icon
                    $('#'+column_name+'_icon').html('<span class="fas fa-long-arrow-alt-up"></span>');
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(reverse_order);
                var page = $('#hidden_page').val();
                var query = $('#searchId').val();
                var chapter_id = $('#chapter_id').val();
                fetch_data(page, reverse_order, column_name, chapter_id, query);
            });
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var chapter_id = $('#chapter_id').val();
                var query = $('#searchId').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, chapter_id, query);
            });
            $('#btn-save').click(function(e){
                e.preventDefault();
                //create
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');

                $.ajax({
                    data: $('#checklistForm').serialize(),
                    url: "{{ route('checklist-standards.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.error){
                            printErrorMsg(data.error);
                        }else{

                            $('#checklistForm').trigger("reset");
                            $('#error_msg_id').hide();
                            $("#checklistArea").val(null).trigger("change");
                            $('#ajax-crud-modal').modal('hide');
                            $('#btn-save').html('Save Changes');
                            $('#success_msg_id').html('');
                            $('#success_msg_id').show();
                            $('#success_msg_id').html('Checklist Standard: '+data+' has been successfully saved!');
                            $("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                                $("#success_msg_id").slideUp(500);
                            });

                            var query = $('#searchId').val();
                            var column_name = $('#hidden_column_name').val();
                            var sort_type = $('#hidden_sort_type').val();
                            var page = $('#hidden_page').val();
                            var checklist_chapter_id = $('#chapter_id').val();
                            fetch_data(page, sort_type, column_name, checklist_chapter_id, query);
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save Changes');
                    }
                });
            });
            function printErrorMsg(msg){
                $('#error_msg_id').find('ul').html('');
                $('#error_msg_id').show();
                $.each( msg, function( key, value ) {
                    $("#error_msg_id").find("ul").append('<li>'+value+'</li>');
                });
                $('#btn-save').html('Save Changes');
            }
            $('body').on('click', '#delete_standard', function () {
                var checklist_standard_id = $(this).data("id");

                if(confirm("Are You sure want to delete !")){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('master/checklist-standards')}}"+'/'+checklist_standard_id,
                        success: function (data) {
                            if(data.flag){
                                $("#checklist_standard_id_" +checklist_standard_id).remove();
                                $('#success_msg_id').html('');
                                $('#success_msg_id').show();
                                $('#success_msg_id').html('Checklist Standard: '+data.checklist_standard+' has been successfully deleted!');
                                $("#success_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#success_msg_id").slideUp(500);
                                });
                            }else {
                                $('#valid_msg_id').html('');
                                $('#valid_msg_id').show();
                                $('#valid_msg_id').html('Checklist Standard: '+data.checklist_standard+' cannot be deleted! It has already used in the Application.');
                                $("#valid_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#valid_msg_id").slideUp(500);
                                });
                            }

                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }

            });
            $('#create_new_checklist_standard').click(function () {
                var error_msg = '';
                $('#btn-save').removeAttr("disabled");
                $('#btn-save').val("Create Checklist Standard");
                $('#checklistForm').trigger("reset");
                $('#basic_standard_id').val('').trigger('change');
                $('#basic_standard_id').val('').trigger('change');
                $('#checklistCrudModal').html("Add New Checklist Standard");
                if($('#module').val() == ''){
                    error_msg = 'Please select the Module!';
                }else if($('#chapter_id').val() == ''){
                    error_msg = 'Please select the checklist chapter!';
                }
                if(error_msg == ''){
                    $('#ajax-crud-modal').modal('show');
                }else {
                    $('#valid_msg_id').html('');
                    $('#valid_msg_id').show();
                    $('#valid_msg_id').html(error_msg);
                    $("#valid_msg_id").fadeTo(2000, 500).slideUp(500, function(){
                        $("#valid_msg_id").slideUp(500);
                    });
                }

            });
            $('body').on('click', '#edit_checklist_standard', function () {
                var checklist_standard_id = $(this).data('id');
                $('#btn-save').removeAttr("disabled");
                $.get('/master/checklist-standards/'+checklist_standard_id+'/edit', function (data) {
                    $('#checklistCrudModal').html("Edit Checklist Standard");
                    $('#btn-save').val("Edit Checklist Standard");
                    $('#ajax-crud-modal').modal('show');
                    $('#checklist_standard_id').val(data.id);
                    $('#checklistArea').val(data.checklist_area_id).trigger('change');
                    $('#checklist_standard').val(data.checklist_standard);
                    $('#'+checklist_pts_id).val(data.checklist_pts);
                    (data.is_active == 0? $('#status2').prop("checked", true):$('#status1').prop("checked", true));

                    if (data.checklist_standard_mapping.length == 1 && basic_standard_id != ''){
                        $.each(data.checklist_standard_mapping, function(key, val) {
                            $('#standard_mapping_id').val(val.id);
                            $('#'+basic_standard_id).val(val.standard_id).trigger('change');
                        });
                    }else if(data.checklist_standard_mapping.length > 1){
                        $.each(data.checklist_standard_mapping, function(key, val) {
                            $('#standard_mapping_id_'+(key+1)).val(val.id);
                            $('#standard_id_'+(key+1)).val(val.standard_id);
                            $('#mandatory_id_'+(key+1)).val(val.mandatory);
                            $('#status_id_'+(key+1)).val(val.is_active);
                        });
                    }


                })
            });
            function getBasicStandardLists(condition, basic_standard_id) {
                $("#"+basic_standard_id+" option:gt(0)").remove();
                $.ajax({
                    url:'/json-basicstandard',
                    type:"GET",
                    data: {
                        condition: condition
                    },
                    success:function (data) {
                        $.each(data, function(key, value) {
                            $('#'+basic_standard_id).append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }
            function getBasicStandardDtls() {
                $.ajax({
                    url:"/master/basic-standard",
                    success:function(data)
                    {
                        $('#tbody_id1').html('');
                        $('#tbody_id1').html(data);
                    }
                })
            }
        });
    </script>
@endsection

