@extends('frontend/layouts/template')
@section('content')
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

        .table {
            border: 2px solid #5bc0de;
            width: 99%;
            margin: 0 auto;
        }

        .table thead > tr > th {
            border-bottom: none;
        }

        .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
            border: 1px solid #aadeee;
        }
    </style>
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">Reports</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-default bg-light p-2">
                                <form action="{{ url('report/reports') }}" method="GET" id="reportForm">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-md-12">
                                            <label class="text-success">SORT BY:</label>
                                            <select name="is_selected" class="form-control" onchange="getTable()">
                                                @foreach ($sort_type as $list)
                                                    <option value="{{ $list->sort_id }}">{{ $list->sort_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xs-12 col-md-12">
                                            <label class="text-success">FILTER BY:</label>
                                        </div>
                                        <div class="col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label>Region:</label>
                                                <select name="Region_Id[]" class="select2bs4" onchange="getTable()"
                                                        multiple="multiple" style="width: 100%;">
                                                    <!-- <option value="">All</option> -->
                                                    @foreach ($regions as $region)
                                                        <option
                                                            value="{{ $region->region_id }}">{{ $region->region }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="card card-default p-2">
                                <div class="card-header">
                                    <a class="btn btn-app btn-success" id=""> <i class="fa fa-table"
                                                                                 style="color:#009900"></i> Table </a>
                                    <a class="btn btn-app" id="submitBar" onclick="getName(this.id)"> <i
                                            class="fas fa-chart-bar" style="color:#ff9900"></i> Bar Graph </a>
                                    <a class="btn btn-app" id="submitLine" onclick="getName(this.id)"> <i
                                            class="fas fa-chart-line" style="color:#0033cc"></i> Line Graph </a>
                                    <div class="btn-group" style="float:right">
                                        <a href="{{ url('reports/graph?print=excel&' . Request::getQueryString()) }}"
                                           target="_blank" class="btn btn-sm btn-success"><i
                                                class="fas fa-file-excel"></i>
                                            Excel</a>
                                        <a href="{{ url('reports/graph?print=pdf&' . Request::getQueryString()) }}"
                                           class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i>
                                            PDF</a>
                                    </div>
                                </div>

                                <div class="overlay" id="loading" style="display:none"><i
                                        class="fa fa-spinner fa-spin"></i>
                                </div>
                                <!-- data here -->
                                <div class="col-md-12 col-xs-12">
                                    <div id="dataResult"></div>
                                    <div class="chart">
                                        <canvas id="barGraph"
                                                style="min-height: 316px; height: 356px; max-height: 356px; max-width: 1000px; display: block; width: 100%;"
                                                width="100%" height="356px" class="chartjs-render-monitor">
                                        </canvas>
                                    </div>
                                    <div class="chart">
                                        <canvas id="lineGraph"
                                                style="min-height: 316px; height: 356px; max-height: 356px; max-width: 1000px; display: block; width: 100%;"
                                                width="100%" height="356px" class="chartjs-render-monitor">
                                        </canvas>
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
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
            getTable();
        });

        function getTable() {
            $("#loading").show();
            var formData = $('#reportForm');
            $.ajax({
                type: formData.attr('method'),
                url: formData.attr('action'),
                data: formData.serialize(),
                success: function (data) {
                     alert(data);
                    $("#dataResult").html(data);
                    $("#loading").hide();
                }
            });
        }
    </script>
@endsection
