@extends('frontend/layouts/template')
@section('content')
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px;
            max-width: 9000px;
            margin:auto;

        }

        #container {
           min-height: 650px;
            border: 1px solid #161b161c;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #161b161c;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 9000px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 18px;
            text-align: center;
            caption-side: top;
            color: #333333;
        }
        .highcharts-data-table th {
            font-weight: 600;
            font-size: .8em;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
    <div class="container pt-3">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="text-center h3">
                    Reports
                   </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-default bg-light p-2">
                                <form action="{{ url('report/reports') }}" method="GET" id="reportForm">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-md-12">
                                            <label class="text-success">Report Type:</label>
                                            <select name="report_type_id" id="report_type_id" class="form-control" onchange="getReportCategory(this.value)">
                                                @foreach ($report_types as $report_type)
                                                    <option value="{{ $report_type->report_type_id }}">{{ $report_type->report_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 col-md-12" style="display:none" id="report_category_display"> 
                                            <label class="text-success">Report Category:</label>
                                            <select name="report_category_id" class="form-control" id="report_category_id" onchange="getReportName(this.value)">
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 col-md-12">
                                            <label class="text-success">Report Name:</label>
                                            <select name="report_name_id" class="form-control" id="report_name_id" onchange="changeReportName()">
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <label class="text-success">FILTER BY:</label>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label>Year:</label>
                                                <input type="text" name="year" class="form-control datetimepicker-input" id="year" data-toggle="datetimepicker" data-target="#year"  onchange="changeYear()"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="overlay" id="loading" style="display:none"><i
                                    class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="row"  id="message" style="display:none">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <i class="fa fa-check"></i> No data available for current year <span id="current_year"></span>
                                    </div>
                                </div>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container" style="display:none" ></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
<!-- high charts -->
@section('scripts')
<script src="{{ asset('plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('plugins/highcharts/exporting.js') }}"></script>
<script src="{{ asset('plugins/highcharts/export-data.js') }}"></script>
<script src="{{ asset('plugins/highcharts/accessibility.js') }}"></script> 
    <script>
        $(document).ready(function () {
            $('#year').datetimepicker({
                viewMode: 'years',
                    format: 'YYYY',
                    useCurrent: false
                }); 
            var previous_year = new Date().getFullYear()-1 ;
            $('#year').val(previous_year);
            $report_type_id= "{!! $id !!}" ;
            $('#report_type_id').val($report_type_id).trigger("change");
        }); 
        function  getReportCategory(report_type_id){
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
            $report_name_id=$("#report_name_id").val();
            $year=$("#year").val();
            $("#loading").show();
            var formData = $('#reportForm');
            $.ajax({
                type: formData.attr('method'),
                url: formData.attr('action'),
                data: formData.serialize(),
                success: function (data) {
                    console.log(data);
                    if(data!=false){
                        $('#container').highcharts(data);
                        $("#container").show();
                        $("#loading").hide();
                        $("#message").hide();
                    }else{
                        $("#loading").hide();
                        $("#container").hide();
                        $("#message").show();
                        $("#current_year").html($year);
                    }
                }
            });
        }
    </script>
@endsection
