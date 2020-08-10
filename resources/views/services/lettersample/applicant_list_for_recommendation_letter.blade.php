@extends('layouts.manager')
@section('content')
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
            <table class="table table-bordered table-hover" id="datatableId">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Application No.</th>
                        <th>Module Name</th>
                        <th>Services</th>
                        <th>Applicant Name</th>
                        <th>Applicant CID</th>
                        <th>Status</th>
                        <th  class="text-center">Action</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @forelse ($data as $key=> $item)
                             <td>{{++$key}}</td>
                            <td>{{$item->application_no}}</td>
                            <td>{{$item->module_name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->owner_name}}</td>
                            <td>{{$item->cid_no}}</td>
                            <td>{{$item->status_name}}</td>
                            <td class="text-center">
                             <a href="{{ url('verification/view-recommendation-letter', ['applicationNo'=>$item->application_no]) }}" class="btn bg-info btn-xs btn-flat" title="View"><i class="fa fa-eye"></i></a>
                            </td>
                        @empty
                        <td colspan="8" class="text-danger text-center"> No data available</td>
                        @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
                $('#datatableId').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                });
            });
    </script>
@endsection
