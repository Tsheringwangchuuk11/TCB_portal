@extends('layouts.manager')
@section('page-title', 'List of Hotel Assement Report')
@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Assement List</h3>
        <a href="{{ url('master/checklist-standards/create')}}" class="btn btn-sm btn-success float-right"> Download Report</a>    
        {{-- @component('layouts.components.download_button')
            <li><a href="{{	url('reports/sale-registers?print=excel&'. Request::getQueryString()) }}" class="text-green" target="_blank"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
            <li><a href="{{	url('reports/sale-registers?print=pdf&'. Request::getQueryString()) }}" class="text-red" target="_blank"><i class="fa fa-print"></i> Print PDF</a></li>
        @endcomponent --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Application No.</th>
                        <th>License No.</th>
                        <th>Owner Name</th>
                        <th>Submitted Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTasklists as $task)
                        <tr>
                            <td class="text-center">{{ $loop->iteration}}</td>
                            <td>{{$task->application_no}}</td>
                            <td></td>
                            <td></td>
                            <td></td>                           
                            <td>
                                <a href="{{ url('master/checklist-standards/' . $task->id) }}" class="btn btn-outline-primary btn-sm" title="Detail"><i class="fas fa-list"></i></a>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">No tasklist to be displayed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer float-right">
        {{ $myTasklists->links() }}
    </div>
</div>
@include('layouts.include.confirm-delete')
@endsection