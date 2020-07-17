@extends('frontend/layouts/template')
@section('content')
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px; 
            max-width: 9000px;
            margin:auto;
           
        }

        #container {
            height: 550px;
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
                                            <label class="text-success">Report Name:</label>
                                            <select name="report_type_id" class="form-control" onchange="generateReports()">
                                                @foreach ($report_types as $report_type)
                                                    <option value="{{ $report_type->id }}">{{ $report_type->report_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xs-12 col-md-12">
                                            <label class="text-success">FILTER BY:</label>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label>Year:</label>
                                                <select name="year" class="select2bs4" onchange="generateReports()" style="width: 100%;">
                                                        <option value="2019"> 2019</option>
                                                </select>
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
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            generateReports();
        });

        function generateReports() {
            $("#loading").show();
            var formData = $('#reportForm');
            $.ajax({
                type: formData.attr('method'),
                url: formData.attr('action'),
                data: formData.serialize(),
                success: function (data) {
                    plotGraph(data);
                    $("#loading").hide();
                }
            });
        }
        function plotGraph(data){
            $('#container').highcharts(data);
        }
    </script>
@endsection
