@if($checklistAreas)
    @forelse($checklistAreas as $checklistArea)
        <tr id="checklist_area_id_{{ $checklistArea->id }}">
            <input type="hidden" id="hidden_id_{{ $checklistArea->id }}" value="{{ $loop->iteration}}" />
            <td class="text-center">{{ $loop->iteration}}</td>
            <td>{{ $checklistArea->checklistChapter->serviceModule->module_name}}</td>
            <td>{{ $checklistArea->checklistChapter->checklist_ch_name}}</td>
            <td>{{ $checklistArea->checklist_area }}</td>
            <td class="text-center">{!! $checklistArea->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
            <td class="text-center">
                @if ($privileges["edit"] == 1)
                    <a href="javascript:void(0)" id="edit_checklist_area" data-id="{{ $checklistArea->id }}" class="btn btn-sm btn-info" title="Edit"> <i class="fas fa-edit"></i></a>
                @endif
                @if((int)$privileges->delete == 1)
                    <a href="javascript:void(0)" id="delete_checklist" data-id="{{ $checklistArea->id }}" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"></i></a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-danger text-center">No checklist area to be displayed</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="6" >
            <div class="float-right">
                {!! $checklistAreas->links() !!}
            </div>
        </td>
    </tr>
@endif
