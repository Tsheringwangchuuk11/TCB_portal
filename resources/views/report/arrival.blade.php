@extends('layouts.manager')
{{-- @section('page-title', 'Overall Status - Total Registered') --}}
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header bg-light">
                <h3 class="card-title">Overall Report</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dzongkhag</label>
                            <select class="form-control select2bs4" style="width: 100%;">
                                <option>All</option>
                                <option>Thimphu</option>
                                <option>Paro</option>
                                <option>Wangdue Phodrang</option>
                                <option>Chhukha</option>
                                <option>Gasa</option>
                                <option>Punakha</option>
                                <option>Trashi Yangtse</option>
                                <option>Samdrup Jongkhar</option>
                            </select>

                            <label>Year</label>
                            <select class="form-control select2bs4" style="width: 100%;">
                                <option>All</option>
                                <option>2007</option>
                                <option>2008</option>
                                <option>2020</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Total Arrivals</label>
                        <div class="chart">
                            <canvas id="totalRegistered"
                                    style="min-height: 316px; height: 356px; max-height: 356px; max-width: 1000px; display: block; width: 100%;"
                                    width="100%" height="356px" class="chartjs-render-monitor">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <!-- SELECT2 EXAMPLE -->
        <table class="table table-bordered border shadow" style="border-color:black;">
            <thead class="bg-white">
            <tr>
                <th style="width: 10px">#</th>
                <th>Month</th>
                <th style="width: 40px">International</th>
                <th style="width: 40px">Regional</th>
                <th style="width: 40px">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1.</td>
                <td>January</td>
                <td>30</td>
                <td>10</td>
                <td>40</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>February</td>
                <td>8</td>
                <td>12</td>
                <td>20</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>March</td>
                <td>6</td>
                <td>5</td>
                <td>11</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>April</td>
                <td>5</td>
                <td>5</td>
                <td>10</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>May</td>
                <td>15</td>
                <td>12</td>
                <td>27</td>
            </tr>
            <tr class="bg-white">
                <th colspan="2" class="text-right">Total:</th>
                <th>300</th>
                <th>200</th>
                <th>500</th>
            </tr>
            </tbody>
        </table>
    </div>
@section('scripts')
    <script>
        $(function () {
            /* ChartJS totalRegistered */
            var totalRegistered = {
                labels: ['Automobile', 'Trekking Guide', 'Electrical', 'Mechanical',
                    'Plumbing', 'House Keeping', 'Patra', 'Construction', 'Computer Application Assist', 'Computer Hardware Technician'],
                datasets: [
                    {
                        backgroundColor: 'rgb(77,169,255)',
                        borderColor: 'rgb(0,53,102)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [34, 154, 340, 213, 86, 127, 34, 23, 3, 15, 12]
                    },
                ]
            }
            var barChartCanvas = $('#totalRegistered').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, totalRegistered)
            var temp0 = totalRegistered.datasets[0]
            barChartData.datasets[0] = temp0
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                legend: false
            }
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })
    </script>
    <!-- Page script -->

@endsection


@endsection
