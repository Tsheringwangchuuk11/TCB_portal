@extends('layouts.manager')
@section('page-title', '')
@section('buttons')
@if ($privileges["create"] == 1)
<a href="javascript:void(0)" class="btn  btn-sm btn-success  btn-flat adddata"><i class="fa fa-plus" ></i> Add More</a>
@endif
@endsection
@section('content')
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title" id="headerId"></h3>                                    
    </div>
    <div class="card-body">
            @csrf
             <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Report Type</label>
                        <select name="report_type_id" id="report_type_id" class="form-control" onchange="getReportCategory(this.value)">
                            @foreach ($report_types as $report_type)
                                <option value="{{ $report_type->report_type_id }}">{{ $report_type->report_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Report Category</label>
                        <select name="report_category_id" class="form-control" id="report_category_id" onchange="changeReportCategory()">
                        </select>
                    </div>
                </div>  
            </div>   
    </div>
</div>
<div id="dataResult"></div>
<div class="modal fade" id="add_data_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="model_hearder_name"></span>,&nbsp;<small><span id="report_category_name"></span></small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body add_data_model_body">
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Page script -->
<script>
     $(document).ready(function(){
           $('#report_type_id').trigger("change");
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#headerId").html(report_type__name);
        });
        function  getReportCategory(report_type_id){
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#headerId").html(report_type__name);
               $("#report_category_id option").remove();
                $.ajax({
                url: '/json-dropdown',
                type: "GET",
                data: {
                    table_name: 't_report_categories',
                    id: 'report_category_id',
                    name: 'report_category',
                    parent_id: report_type_id,
                    parent_name_id: 'report_type_id'
                },
                success: function (data) {
                    $.each(data, function (key, value) {
                        $('select[name="report_category_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                    $('#report_category_id').trigger("change");
                    }
                });
             }

        function changeReportCategory(){	
                generateAjaxReports();
        }
        
         function generateAjaxReports() {
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#model_hearder_name").html(report_type__name);

            var report_category_name = $("#report_category_id  option:selected").text();
            $("#report_category_name").html(report_category_name);
            var report_type_id = $('#report_type_id').val();
            var report_category_id= $('#report_category_id').val();
            $('#dataResult').load('{{url("statistical/show-total-trip-exp/")}}/'+ report_type_id+'/'+report_category_id);
         } 

         $('.adddata').on('click',function(){
        var report_type_id = $('#report_type_id').val();
        var report_category_id= $('#report_category_id').val();
        var dataURL = '{{ url("statistical/create-total-trip-exp/") }}/'+ report_type_id+'/'+report_category_id;
        $('.add_data_model_body').load(dataURL,function(){
            $('#add_data_modal').modal({show:true});
        });
    });
</script>
@endsection