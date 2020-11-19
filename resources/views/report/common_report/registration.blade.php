@extends('layouts.manager')
@section('page-title', '')
@section('buttons')
    <a href="{{	url('report/registration?print=excel&'. Request::getQueryString()) }}" target="_blank" class="btn btn-sm btn-success btn-flat"><i class="fa fa-file-excel"></i></i> Export to Excel</a>
    <a href="{{	url('report/registration?print=pdf&'. Request::getQueryString()) }}"  target="_blank"  class="btn btn-sm btn-danger btn-flat"><i class="fa fa-print"></i> Print PDF</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header"> 
        <h3 class="card-title">Registration Report</h3>                                    
    </div>
    <div class="card-body">
        <form action="{{ url()->current() }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Module</label>
                        <select name="module_id" class="form-control select2bs4" id="module_id">
                            <option value="">-Select-</option>
                            @foreach ($modules as $module)
                                <option value="{{ $module->id }}" {{ Request::get('module_id') == $module->id ? 'selected' : '' }}>{{ $module->module_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-3" style="display: none" id="star_category_div">
                    <div class="form-group">
                        <label>Star Category</label>
                        <select name="star_category_id" class="form-control select2bs4">
                            <option value="">-Select-</option>
                            @foreach ($starCategoryLists as $starCategoryList)
                                <option value="{{ $starCategoryList->id }}" {{ Request::get('star_category_id') == $starCategoryList->id ? 'selected' : '' }}>{{ $starCategoryList->star_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>     
             </div> 
             <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Dzongkhag</label>
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
                        <label>Gewog</label>
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
                        <label>Village</label>
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
        <h3 class="card-title">Registration Report List</h3>                                             
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="datatableId">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Citizen ID</th>
                    <th>Name</th>
                    <th>License No.</th>
                    <th>Star Category</th>
                    <th>Hotel Name</th>
                    <th>Validity Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrationlists as $registrationlist)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$registrationlist->cid_no}}</td>
                    <td>{{$registrationlist->owner_name}}</td>
                    <td>{{$registrationlist->license_no}}</td>
                    <td>{{$registrationlist->star_category_name}}</td>
                    <td>{{$registrationlist->tourist_standard_name}}</td>
                    <td>{{$registrationlist->validaty_date}}</td>
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