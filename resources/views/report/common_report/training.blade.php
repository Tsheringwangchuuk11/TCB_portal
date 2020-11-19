@extends('layouts.manager')
@section('page-title', '')
@section('buttons')
    <a href="{{	url('report/training?print=excel&'. Request::getQueryString()) }}" target="_blank" class="btn btn-sm btn-success btn-flat"><i class="fa fa-file-excel"></i></i> Export to Excel</a>
    <a href="{{	url('report/training?print=pdf&'. Request::getQueryString()) }}"  target="_blank"  class="btn btn-sm btn-danger btn-flat"><i class="fa fa-print"></i> Print PDF</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title">Training Report</h3>                                    
    </div>
    <div class="card-body">
        <form action="{{ url()->current() }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Course Type</label>
                        <select name="course_type_id" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($courseTypes as $courseType)
                                <option value="{{ $courseType->id }}" {{ Request::get('course_type_id') == $courseType->id ? 'selected' : '' }}>{{ $courseType->dropdown_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Location</label>
                        <select name="dzongkhag_id" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($dzongkhagLists as $dzongkhagList)
                                <option value="{{ $dzongkhagList->id }}" {{ Request::get('dzongkhag_id') == $dzongkhagList->id ? 'selected' : '' }}>{{ $dzongkhagList->dzongkhag_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>    
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach (config()->get('settings.gender') as $k => $v)
                             <option value="{{ $k  }}" {{ Request::get('gender') == $k  ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">To Date</label>
                        <div class="input-group date" id="to_date" data-target-input="nearest">
                            <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ Request::get('to_date') }}"/>
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
        <h3 class="card-title">Training Report List</h3>                                             
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="datatableId">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Citizen ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Contact No.</th>
                    <th>Location</th>
                    <th>Course Types</th>
                    <th>Course Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($traineelists as $traineelist)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$traineelist->applicant_cid_no}}</td>
                        <td>{{$traineelist->applicant_name}}</td>
                        <td>
                            @if ($traineelist->applicant_gender=='M')
                                Male
                            @else
                            Female 
                            @endif
                        </td>
                        <td>
                            {{$traineelist->applicant_contact_no}}
                        </td>
                        <td>
                            {{$traineelist->dzongkhag_name}}
                        </td>
                        <td>
                            {{$traineelist->dropdown_name}}
                        </td>
                        <td>
                            <td>{{ date_format(date_create($traineelist->course_start_date), "F jS Y") }} to {{ date_format(date_create($traineelist->course_end_date), "F jS Y") }}</td> 
                        </td>
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
            $('#from_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('#to_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
</script>
@endsection