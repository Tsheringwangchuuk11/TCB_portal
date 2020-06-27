@extends('layouts.manager')
@section('page-title', 'Upload example')
@section('buttons')
    <button type="button" class="btn btn-primary btn-flat btn-sm add" data-toggle="modal" data-target="#uploadExcel"><i class="fa fa-upload"></i> UPLOAD FILE</button>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">                              
                <h3 class="card-title">List of Revenue Reversals</h3>
            </div>
            <div class="card-body no-padding">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>                                                                
                                <th>Mobile No.</th>
                                <th class="text-right">Amount</th>                                                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($uploads as $upload)
                                <tr>
                                    <td class="text-center">{{ $uploads->firstItem() + ($loop->iteration - 1) }}</td>                                                                        
                                    <td>{{ $upload->mobile_number }}</td>
                                    <td class="text-right">{{ $upload->amount }}</td>
                                    <td class="text-center">{!! $upload->bank_status !!}</td>                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">Nothing to display</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{ $uploads->appends(['transaction_date' => Request::get('transaction_date'), 'transaction_to' => Request::get('transaction_to'), 'mobile_number' => Request::get('mobile_number'), 'amount' => Request::get('amount'), 'status' => Request::get('status')])->render() }}
            </div>
        </div>
    </div>
</div>
@include('layouts.include.uploads')
@endsection