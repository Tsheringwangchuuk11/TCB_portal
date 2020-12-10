@extends('layouts.manager')
@section('page-title', '')
@section('buttons')
<a id="excellinkId" target="_blank" class="btn btn-sm btn-success btn-flat"><i class="fa fa-file-excel"></i></i> Export to Excel</a>
<a id="pdflinkId" class="btn btn-sm btn-danger btn-flat" target="_blank" ><i class="fa fa-print"></i> Print PDF</a>
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
                <div class="col-md-3" style="display:none" id="report_category_display">
                    <div class="form-group">
                        <label>Report Category</label>
                        <select name="report_category_id" class="form-control" id="report_category_id" onchange="getReportName(this.value)">
                        </select>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Report Name</label>
                        <select name="report_name_id" class="form-control" id="report_name_id" onchange="changeReportName()">
                        </select>
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Year</label>
                        <input type="text" name="year" class="form-control datetimepicker-input" id="year" data-toggle="datetimepicker" data-target="#year"  onchange="changeYear()"/>
                    </div>
                </div> 
            </div>   
    </div>
</div>
<div id="dataResult"></div>
@endsection
@section('scripts')
<!-- Page script -->
<script>
     $(document).ready(function(){
            $('#year').datetimepicker({
                viewMode: 'years',
                    format: 'YYYY',
                    useCurrent: false
                }); 
            var previous_year = new Date().getFullYear()-1 ;
            $('#year').val(previous_year);
            $('#report_type_id').trigger("change");
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#headerId").html(report_type__name);
        });
        function  getReportCategory(report_type_id){
            var report_type__name = $("#report_type_id  option:selected").text();
            $("#headerId").html(report_type__name);
                if(report_type_id == 1) {
                        $("#report_category_id option").remove();
                        $("#report_category_display").hide();	
                        $("#report_name_id option").remove();
                        $.ajax({
                        url: '/report-dropdown',
                        type: "GET",
                        data: {
                            table_name: 't_report_names',
                            id: 'report_name_id',
                            name: 'report_name',
                            parent_type_value: 'T',
                            parent_type_name: 'parent_type',
                            parent_id: report_type_id,
                            parent_name_id: 'report_parent_id'
                        },
                        success: function (data) {
                            $.each(data, function (key, value) {
                                $('select[name="report_name_id"]').append('<option value="' + key + '">' + value + '</option>');
                             });
                            generateAjaxReports();
                            }
                        });
                } else {
                       $("#report_category_id option").remove();;
                        $("#report_category_display").show();
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
                }
            
        function getReportName(report_category_id) {
            if(report_category_id){
                        $("#report_name_id option").remove();
                        $.ajax({
                        url: '/report-dropdown',
                        type: "GET",
                        data: {
                            table_name: 't_report_names',
                            id: 'report_name_id',
                            name: 'report_name',
                            parent_type_value: 'C',
                            parent_type_name: 'parent_type',
                            parent_id: report_category_id,
                            parent_name_id: 'report_parent_id'
                        },
                        success: function (data) {
                            $.each(data, function (key, value) {
                                $('select[name="report_name_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                         generateAjaxReports();
                        }
                    });
                }else{
                    $("#report_name_id option").remove();
                }
            }
        function changeReportName(){
            generateAjaxReports();
         } 

        function changeYear(){
            generateAjaxReports();
         } 
         
         function generateAjaxReports() {
            var report_type_id = $('#report_type_id').val();
            var report_category_id= $('#report_category_id').val();
            var report_name_id= $('#report_name_id').val();
            var year= $('#year').val();
            var pdf = document.getElementById('pdflinkId');
            var urlforpdf = '{{ url("report/get-report-content")}}/'+report_type_id +'/'+report_category_id+'/'+report_name_id+'/'+year+'/'+ 'pdf' ;
            pdf.href = urlforpdf;
            var excel = document.getElementById('excellinkId');
            var urlforexcel = '{{ url("report/get-report-content")}}/'+report_type_id +'/'+report_category_id+'/'+report_name_id+'/'+year+'/'+ 'excel' ;
            excel.href = urlforexcel;
            $('#dataResult').load('{{url("report/get-report-content/")}}/'+ report_type_id+'/'+report_category_id+'/'+report_name_id+'/'+year);
         } 
</script>
@endsection