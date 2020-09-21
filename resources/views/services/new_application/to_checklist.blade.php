@if ($checklistDtls->count() > 0)
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Self Assessment Check List</h4>
		</div>
		<div class="card-body">
			@foreach ($checklistDtls as $chapter)
				<div class="card collapsed-card">
					<div class="card-header" data-card-widget="collapse">
						<span>{{$chapter->checklist_ch_name}}</span>
						<div class="card-tools">
							<button type="button" class="btn btn-tool"><i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table table order-list table-bordered" id="">
									<tbody>
										@php
										$area = '';
										@endphp
                                        @foreach ($chapter->chapterAreas as $chapterArea)
                                        <tr>
                                            <input type="hidden" name="area[]" value="{{$chapterArea->id}}">
											@foreach ($chapterArea->checkListStandards as $checkListStandard) 
													@if ($area != $chapterArea->checklist_area)
													<td>{{ $chapterArea->checklist_area }}</td>
													@endif
                                                    <td>{{ $checkListStandard->checklist_standard }}
                                                    <input type="radio" name="check{{$chapterArea->id}}" value="{{$checkListStandard->checklist_id}}">
													</td>
													@php
													$area = $chapterArea->checklist_area
													@endphp 
												
                                            @endforeach  
                                        </tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer clearfix" style="display: block;">
							<button type="button" class="btn btn-tool float-right" data-card-widget="collapse">
							<i class="fas fa-arrow-up"></i>
							</button>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif
<script>
	$('input[type="checkbox"]').on('change', function(){
        if($(this).is(":checked")){ // checkbox checked
		currentRow = $(this).closest("tr");
        var currentVal=currentRow.find('.chk').val('1');
        }
		if($(this).is(":unchecked")){ // checkbox unchecked
		currentRow = $(this).closest("tr");
        var currentVal=currentRow.find('.chk').val('0');
        }
    });
</script>