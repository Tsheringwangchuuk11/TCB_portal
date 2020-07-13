@extends('layouts.manager')
@section('page-title', 'List of Arrival Report')
@section('buttons')
    @component('layouts.components.download-button')
        <li><a href="{{	url('statistics/arrival?print=excel&'. Request::getQueryString()) }}" target="_blank"> <i class="fas fa-file-excel"></i> <font color= "green"> Export to Excel </font></a></li>
        <li><a href="{{	url('statistics/arrival?print=pdf&'. Request::getQueryString()) }}"  target="_blank"> <i class="fas fa-print"></i> <font color= "red"> Print PDF</font></a></li>
    @endcomponent
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            @component('layouts.components.filter')
                <div class="col-md-3 form-group">
                    <select name="reportType" class="form-control select2bs4">
                        <option value="" {{ Request::get('reportType') == "" ? 'selected' : '' }}>---Select Report Type---</option>
                        <option value="1" {{ Request::get('reportType') == "1" ? 'selected' : '' }}>Overall Arrivals</option>
                        <option value="2" {{ Request::get('reportType') == "2" ? 'selected' : '' }}>Arrival By Nationality</option>
                        <option value="3" {{ Request::get('reportType') == "3" ? 'selected' : '' }}>Arrival By Activity</option>
                        <option value="4" {{ Request::get('reportType') == "4"? 'selected' : '' }}>Arrival By Dzongkhag</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <select name="groupType" class="form-control">
                        <option value="" {{ Request::get('groupType') == "" ? 'selected' : '' }}>---All Group Types---</option>
                        <option value="0" {{ Request::get('groupType') == "0" ? 'selected' : '' }}>International</option>
                        <option value="1" {{ Request::get('groupType') == "1" ? 'selected' : '' }}>Regional</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control datepicker" value="{{ Request::get('start_date') }}" placeholder="Start Date">

                            <input type="date" name="end_date" class="form-control datepicker" value="{{ Request::get('end_date') }}" placeholder="End Date">
                        </div>
                    </div>
                </div>
            @endcomponent
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="statisticalTable">
                    @if(Request::get('reportType') == 1)
                        <thead>
                            <tr>
                                <th class="text-center">Sl No.</th>
                                <th>Air</th>
                                <th>Land</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statisticReportDtls as $statisticReportDtl)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $statisticReportDtl->air }}</td>
                                    <td>{{ $statisticReportDtl->land }}</td>
                                    <td>{{ $statisticReportDtl->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @elseif(Request::get('reportType') == 2 || Request::get('reportType') == 3 || Request::get('reportType') == 4)
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No.</th>
                                    @if(Request::get('reportType') == 2)
                                        <th>Nationality</th>
                                    @elseif(Request::get('reportType') == 3)
                                        <th>Activity</th>
                                    @else
                                        <th>Dzongkhag</th>
                                    @endif
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($statisticReportDtls as $statisticReportDtl)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $statisticReportDtl->name }}</td>
                                    <td>{{ $statisticReportDtl->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                    @else
                        <tr>
                            <td colspan="4" class="text-danger text-center text-bold">No data to be displayed</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="card-footer float-right">

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#statisticalTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
