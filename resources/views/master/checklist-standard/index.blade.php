@extends('layouts.manager')
@section('page-title', 'List of Checklist Stanadard')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
        <a href="{{ url('master/checklist-standards/create')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Add Checklist Standard</a>
    @endif
@endsection
@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Checklist Standards</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%" class="text-center">#</th>
                        <th width="10%">Checklist Area</th>
                        <th width="30%">Checklist Standard Name</th>
                        <th width="5%">Checklist Points</th>
                        <th width="5%">Status</th>
                        <th width="18%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checklistStandards as $checklistStandard)
                        <tr>
                            <td width="2%" class="text-center">{{ $loop->iteration}}</td>
                            <td width="10%">{{ $checklistStandard->checklistArea->checklist_area}}</td>
                            <td style="word-break:break-all">{!! nl2br($checklistStandard->checklist_standard) !!}</td>
                            <td width="5%">{{ $checklistStandard->checklist_pts }}</td>
                            <td class="text-center">{!! $checklistStandard->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                            <td width="18%" class="text-center">
                                <a href="{{ url('master/checklist-standards/' . $checklistStandard->id) }}" class="btn btn-primary btn-sm" title="Detail"><i class="fas fa-list"></i> Detail</a>
                                @if ((int)$privileges->edit == 1)
                                <a href="{{ url('master/checklist-standards/' . $checklistStandard->id . '/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                @endif
                                @if((int)$privileges->delete == 1)
                                <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i> Delete
                                    <a data-form="#frmDelete-{!! $checklistStandard->id !!}" data-title="Delete {!! $checklistStandard->checklist_standard !!}" data-message="Are you sure you want to delete this checklist?"></a>
                                </a>
                                <form action="{{ url('master/checklist-standards/' . $checklistStandard->id) }}" method="POST" id="{{ 'frmDelete-'.$checklistStandard->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">No checklist standard to be displayed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer float-right">
        {{ $checklistStandards->links() }}
    </div>
</div>
@include('layouts.include.confirm-delete')
@endsection