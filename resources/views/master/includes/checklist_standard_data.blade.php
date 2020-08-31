@forelse($checklistStandards as $checklistStandard)
    <tr id="checklist_standard_id_{{$checklistStandard->id}}">
        <td width="2%" class="text-center">{{ $loop->iteration}}</td>
        <td width="10%">{{ $checklistStandard->checklistArea->checklist_area}}</td>
        <td style="word-break:break-all">{!! nl2br($checklistStandard->checklist_standard) !!}</td>
        <td width="5%">{{ $checklistStandard->checklist_pts }}</td>
        <td class="text-center">{!! $checklistStandard->isActive() == 1 ? '<i class="fas fa-check text-green"></i>' : '<i class="fas fa-times text-red"></i>' !!}</td>
        <td width="8%" class="text-center">
            @if ((int)$privileges->edit == 1)
                <a href="{{ url('master/checklist-standards/' . $checklistStandard->id . '/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></a>
            @endif
            @if((int)$privileges->delete == 1)
                <a href="javascript:void(0)" id="delete_standard" data-id="{{ $checklistStandard->id }}" class="btn btn-sm btn-danger" title="Delete"> <i class="fas fa-trash"></i></a>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-danger text-center">No checklist standard to be displayed</td>
    </tr>
@endforelse
<tr>
    <td colspan="6" >
        <div class="float-right">
            {!! $checklistStandards->links() !!}
        </div>
    </td>
</tr>
