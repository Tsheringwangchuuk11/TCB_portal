@extends('layouts.manager')
@section('page-title', 'List of Application Report')
@section('buttons')
    @component('layouts.components.download-button')
        <li><a href="{{	url('report/application-lists?print=excel&'. Request::getQueryString()) }}" class="text-success" target="_blank">&nbsp;&nbsp;<i class="fa fa-file-excel"></i></i> Excel </a></li>
        <li><a href="{{	url('report/application-lists?print=pdf&'. Request::getQueryString()) }}"  class="text-danger" target="_blank"> &nbsp;&nbsp;<i class="fas fa-print"></i> PDF</a></li>
    @endcomponent  
@endsection
@section('content')
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title">Application List</h3>                                    
    </div>
    <div class="card-body">
        <form action="{{ url()->current() }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Module</label>
                        <select name="module" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($serviceModules as $module)
                                <option value="{{ $module->id }}" {{ Request::get('module') == $module->id ? 'selected' : '' }}>{{ $module->module_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Service</label>
                        <select name="service" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ Request::get('service') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($statusTypes as $statusType)
                                <option value="{{ $statusType->id }}" {{ Request::get('statusType') == $statusType->id ? 'selected' : '' }}>{{ $statusType->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Application No.</label>
                        <input type="text" name="application_no" class="form-control" value="{{ Request::get('application_no') }}" placeholder="Application No."/>
                    </div>
                </div>    
             </div> 
             <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">From Date</label>
                        <div class="input-group date" id="from_date" data-target-input="nearest">
                            <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ Request::get('from_date') }}"/>
                            <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">To Date</label>
                        <div class="input-group date" id="to_date" data-target-input="nearest">
                            <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ Request::get('to_date') }}"/>
                            <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-1">
                    <div class="btn-group" style="margin-top:30px">
                        <button type="submit" class="btn btn-success" title="Search"><i class="fa fa-search"></i></button>
                        <a href="{{ url()->current() }}" class="btn btn-danger" title="Clear"><i class="fa fa-undo"></i></a>
                    </div>
                </div>
            </div>   
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title">Application List</h3>                                                        
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <figure class="highcharts-figure">
                    <div id="container" class="col-md-12"></div>
                </figure>
            </div>
        </div><br>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Application No.</th>
                        <th>Module Name</th>
                        <th>Services</th>
                        <th>Applicant Name</th>
                        <th>Applicant CID</th>
                        <th>Status</th>
                        <th>Submitted Date</th>                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><a href="#" onclick="viewApplicationDetails('{{ $application->application_no}}','{{ $application->service_id }}','{{ $application->id }}')">{{ $application->application_no }}</a></td>
                            <td>{{ $application->module_name }}</td> 
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->applicant_name }}</td>
                            <td>{{ $application->cid_no }}</td>                                                                            
                            <td>{{ $application->status_name }}</td>                                                                            
                            <td>{{ $application->created_at }}</td>                                                                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-danger text-center">No applications list to be displayed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer float-right">
        {{ $applications->links() }}
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#from_date').datetimepicker({
                format: 'DD/MM/YYYY'

            });
            $('#to_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
        var totalapplicationapprove = parseFloat({{$totalapproved}});
        var totalapplicationreject = parseFloat({{$totalrejected}});
        var totalsubmitted = parseFloat({{$totalsubmitted}});
        var totalapplication = parseFloat({{$totalapplication}});
                Highcharts.setOptions({
                    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                        return {
                            radialGradient: {
                                cx: 0.5,
                                cy: 0.3,
                                r: 0.7
                            },
                            stops: [
                                [0, color],
                                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                            ]
                        };
                    })
                });
                Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Application Summary'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y} '
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Application',
                    colorByPoint: true,
                    data: [{
                        name: 'Total Application',
                        y: totalapplication,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Total Application Approved',
                        y: totalapplicationapprove
                    }, {
                        name: 'Total Application Rejected',
                        y: totalapplicationreject
                    },
                    {
                        name: 'Total Application Submitted',
                        y: totalsubmitted
                    }]
                }]
            });

            function viewApplicationDetails(applicationNo, serviceId, moduleId)
            {
                var url = "{{ url('verification/viewApplication') }}"+"/"+applicationNo+"/"+serviceId+"/"+moduleId;
                window.location.href = url;
            }
</script>
@endsection