@extends('layouts.manager')
@section('page-title', 'List of Checklist Standards')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
        <a href="{{ url('master/checklist-standards/create')}}" class="btn btn-sm btn-success"> <i class="fas fa-plus"></i> Add Checklist Standard</a>
    @endif
@endsection
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Checklist Standard's Details</h3>
        </div>
        <div class="card-body">
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
                        <select name="" class="form-control checklist required select2bs4" id="checklist" disabled>
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
                    <tbody>
                        @include('master.includes.checklist_standard_data')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            //select a module and accordingly get the chapter associated with it using ajax request
            $('select.module').on('change', function(e){
                var selectedModule = $('option:selected', this).val();

                //check if module is selected or not
                if (selectedModule.length > 0) {
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
                            $('select.checklist').empty().removeAttr('disabled', false);
                            $('select.checklist').append('<option value="">---SELECT ONE---</option>');
                            for (i = 0; i < data.length; i++) {
                                $('select.checklist').append('<option value="' + data[i].id + '" data-name="' + data[i].checklist_ch_name + '" >' + data[i].checklist_ch_name + '</option>');
                            }
                        }
                    });
                } else {
                    $('select.checklist').empty().attr('disabled', true);
                    $('select.checklist').append('<option value="">---SELECT MODULE FIRST---</option>');
                }
            });
            $('select.checklist').on('change', function(e){
                var selectedChapterId = $('option:selected', this).val();
                
                if (selectedChapterId.length > 0) {
                    var query = $('#searchId').val();
                    var column_name = $('#hidden_column_name').val();
                    var sort_type = $('#hidden_sort_type').val();
                    var page = $('#hidden_page').val();
                    fetch_data(page, sort_type, column_name, selectedChapterId, query);
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
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }
            $(document).on('keyup', '#searchId', function(){
                var query = $('#searchId').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                var chapter_id = $('#checklist').val();
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
                var chapter_id = $('#checklist').val();
                fetch_data(page, reverse_order, column_name, chapter_id, query);
            });
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var chapter_id = $('#checklist').val();
                var query = $('#searchId').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, chapter_id, query);
            });
        });
    </script>
@endsection

