@extends('layouts.manager')
@section('page-title', 'List of Checklist Stanadard')
@section('buttons')
    @if ((int)$privileges["create"] == 1)
        <a href="{{ url('master/checklist-standards/create')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Add Checklist Standard</a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Checklist Standards</h3>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Checklist Area</th>
                                <th>Checklist Standard Name</th>
                                <th>Checklist Points</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="checklist_standard_body_id">
                        @if($checklistStandards)
                        @forelse($checklistStandards as $checklistStandard)
                            <tr id="checklist_standard_id_{{ $checklistStandard->id }}">
                                <input type="hidden" id="hidden_id_{{ $checklistStandard->id }}" value="{{ $loop->iteration}}" />
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td>{{ $checklistStandard->checklistArea->checklist_area}}</td>
                                <td>{{ $checklistStandard->checklist_standard }}</td>
                                <td>{{ $checklistStandard->checklist_pts }}</td>
                                <td class="text-center">{!! $checklistStandard->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
                                <td class="text-center">
                                    <a href="{{ url('master/checklist-standards/' . $checklistStandard->id) }}" class="btn btn-primary btn-xs btn-flat" title="Detail"><i class="fas fa-list"></i> Detail</a>
                                    @if ((int)$privileges->edit == 1)
                                    <a href="{{ url('master/checklist-standards/' . $checklistStandard->id . '/edit') }}" class="btn bg-purple btn-xs btn-flat" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                    @endif
                                    @if((int)$privileges->delete == 1)
                                    <a href="#" class="formConfirm btn btn-xs btn-flat btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i> Delete
                                        <a data-form="#frmDelete-{!! $checklistStandard->id !!}" data-title="Delete {!! $checklistStandard->checklist_standard !!}" data-message="Are you sure you want to delete this checklistStandard?"></a>
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
                        @endif
                        </tbody>
                    </table><br>
                    <div class="float-right">
                        {{ $checklistStandards->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/checklist.js') }}"></script>
@endsection