@php
	$scorepointtotal=0;
@endphp
@if ($checklistDtls->count() > 0)
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Self Assessment Check List</h4>
		</div>
		<div class="card-body">
			@php
				$i = 0;
			@endphp
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
									<thead>
										<tr>
											<td>Area</td>
											<td>Standard</td>
											<td>Score points</td>
											<td>Assessor’s score point</td>
											<td>Check</td>
										</tr>
									</thead>
									<tbody>
										@php
                                        $area = '';
                                        $total=0;
										@endphp
										@foreach ($chapter->chapterAreas as $chapterArea)
											@foreach ($chapterArea->checkListStandards as $checkListStandard) 
												<tr>
													@if ($area != $chapterArea->checklist_area)
													<td rowspan="{{ sizeOf($chapterArea->checkListStandards) }}">{{ $chapterArea->checklist_area }}</td>
													@endif
													<td>{{ $checkListStandard->checklist_standard }}</td>
													<td>{{ $checkListStandard->checklist_pts }}
														<input type="hidden" name="checklist_id[]" class="checklist" value="{{$checkListStandard->checklist_id}}">
													</td>
													
														@if (in_array( $checkListStandard->checklist_id, $checklistrec))
															<td>
																<input type="hidden" name="checklist_record_id[]" value="{{ $checklistrecords[$i]->id }}">
																<input type="text" name="assessor_score_point[]" value="{{$checklistrecords[$i]->assessor_score_point}}" class="form-control input-sm txt">
															</td>
															<td>{{ $checkListStandard->standard_code }}</td>
															<td>
																	<input type="checkbox" name="check" checked>
																	<input type="hidden" name="checkvalue[]" value="1" class="chk">
															</td>
															
															@php 
																($scorepointtotal +=$checklistrecords[$i]->assessor_score_point);
																($i++) 
															@endphp 
															@else
																<td>
																	<input type="hidden" name="checklist_record_id[]" value="">	
																	<input type="text" name="assessor_score_point[]" class="form-control input-sm txt"></td>
																</td>
																<td>{{ $checkListStandard->standard_code }}</td>
																<td>
																	<input type="checkbox" name="check">
																	<input type="hidden" name="checkvalue[]" value="0" class="chk">
																</td>
															@endif
													@php
                                                    $area = $chapterArea->checklist_area;
                                                    ($total +=$checkListStandard->checklist_pts);
													@endphp 
												</tr>
											@endforeach  
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
    <div class="card">
        <div class="card-header">
             <h4 class="card-title">Score Points Details</h4>
        </div>
        <div class="card-body">
			<div class="row">
				<div class="form-group col-md-5">
					<label for="">
               Minimum Marks for Approval ({{$total}}/330)
					</label>
                <input type="text" class="form-control" name="scorepoint" value="{{$scorepointtotal}}" id="scorepoint" readonly>
				</div>
			</div>
        </div>
   </div>
@endif
