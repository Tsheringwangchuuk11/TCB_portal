@extends('layouts.manager')
@section('page-title', '')
@section('buttons')
    <a href="{{	url('report/assessment-reports?print=excel&'. Request::getQueryString()) }}" target="_blank" class="btn btn-sm btn-success btn-flat"><i class="fa fa-file-excel"></i></i> Export to Excel</a>
    <a href="{{	url('report/assessment-reports?print=pdf&'. Request::getQueryString()) }}"  target="_blank"  class="btn btn-sm btn-danger btn-flat"><i class="fa fa-print"></i> Print PDF</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title">Hotel Assessment Report</h3>                                    
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
                        <label for="">From Date</label>
                        <div class="input-group date" id="from_date" data-target-input="nearest">
                            <input type="text" name="application_from" class="form-control datetimepicker-input" data-target="#from_date" value="{{ Request::get('application_from') }}"/>
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
                            <input type="text" name="application_to" class="form-control datetimepicker-input" data-target="#to_date" value="{{ Request::get('application_to') }}"/>
                            <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Application No.</label>
                        <input type="text" name="application_no" class="form-control" value="{{ Request::get('application_no') }}">
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
        <h3 class="card-title">Hotel Assessment Report List</h3>                                             
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="datatableId">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Module Name</th>
                    <th>Application No.</th>
                    <th>Citizen ID</th>
                    <th>Applicant Name</th>
                    <th>Submitted Date</th>   
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $application->module_name }}</td>
                        <td><a href="{{ url('report/assessment-reports',['application_no'=>$application->application_no,'moduleId'=>$application->module_id]) }}" title="See Detail">{{ $application->application_no}}</a></td>
                        <td>{{ $application->cid_no }}</td>
                        @if ($application->module_id===2)
                        <td>{{ $application->applicant_name }}</td>
                        @else
                        <td>{{ $application->owner_name }}</td>
                        @endif
                        <td>{{ $application->created_at }}</td>                                                                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<!-- Page script -->
<script>
     $(document).ready(function(){
            $('#datatableId').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            $('#module_id').on('change',function(e){
                var module_id=e.target.value;
                if(module_id=="1"){
                    $("#star_category_div").show();
                }else{
                    $("#star_category_div").hide();
                }
            });

            $('#from_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('#to_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
</script>
@endsection