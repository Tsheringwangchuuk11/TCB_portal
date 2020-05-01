@extends('layouts.manager')
@section('page-title', 'Checklist Stanadard')
@section('buttons')
<div class="card-tools pull-right">
    <a href="{{url('master/checklist-standards')}}" class="btn bg-olive btn-sm btn-flat"><i class="fa fa-reply"></i> Back to List</a>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">checklist Standard Info.</h3>
            </div>
            <div class="card-body card-profile">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Checklist Area</b> <a class="float-right">{{ $checklistStandard->checklistArea->checklist_area  }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Checklist Standard Name</b> <a class="float-right">{{ $checklistStandard->checklist_standard }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Checklist Points</b> <a class="float-right">{{ $checklistStandard->checklist_pts }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Status</b><a class="float-right text-capitalize">{!! $checklistStandard->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!} </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Checklist Standard Mapping</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Star Category</th>
                                <th>Basic Standaard Code</th>
                                <th>Mandatory</th>
                                <th>Staus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checklistStandard->standardMapping as $key => $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $detail->star_category_name }}</td>
                                    <td>{{ $detail->code }}</td>
                                    <td>{{ $detail->pivot->mandatory == 1 ? 'Yes' :'No' }}</td>
                                    <td>{{ $detail->pivot->is_active == 1 ? 'Yes' :'No' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No  standard mapping to be displayed</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection