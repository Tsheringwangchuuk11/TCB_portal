@if($checklistChapters)
    @forelse($checklistChapters as $checklistChapter)
        <tr id="checklist_id_{{ $checklistChapter->id }}">
            <input type="hidden" id="hidden_id_{{ $checklistChapter->id }}" value="{{ $loop->iteration}}" />
            <td class="text-center">{{ $loop->iteration}}</td>
            <td>{{ $checklistChapter->serviceModule->module_name}}</td>
            <td>{{ $checklistChapter->checklist_ch_name }}</td>
            <td class="text-center">{!! $checklistChapter->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
            <td class="text-center">
                @if ($privileges["edit"] == 1)
                    <a href="javascript:void(0)" id="edit_checklist" data-id="{{ $checklistChapter->id }}" class="btn btn-sm btn-info" title="Edit"> <i class="fas fa-edit"></i></a>
                @endif
                @if((int)$privileges->delete == 1)
                    <a href="javascript:void(0)" id="delete_checklist" data-id="{{ $checklistChapter->id }}" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"></i></a>
                   {{-- <a href="#" class="form-confirm  btn btn-sm btn-danger" title="Delete">
                        <i class="fas fa-trash"></i>
                        <a data-form="#frmDelete-{!! $checklistChapter->id !!}" data-title="Delete {!! $checklistChapter->checklist_ch_name !!}" data-message="Are you sure you want to delete this checklist chapter?"></a>
                    </a>
                    <form action="{{ url('master/checklist-chapters/' . $checklistChapter->id) }}" method="POST" id="{{ 'frmDelete-'.$checklistChapter->id }}">
                        @csrf
                        @method('DELETE')
                    </form>--}}
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-danger text-center">No checklist chapter to be displayed</td>
        </tr>
    @endforelse
    <tr>
        <td colspan="5" >
            <div class="float-right">
                {!! $checklistChapters->links() !!}
            </div>
        </td>
    </tr>
@endif
