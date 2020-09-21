@php
	$scorepointtotal=0;
	$ratingpointtotal=0;
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
											<td>5*Tented rating</td>
											<td>Assessor’s 5*Tented rating</td>
											<td>Check</td>
										</tr>
									</thead>
									<tbody>
										@php
										$area = '';
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
																@if ($checkListStandard->checklist_pts===null  && $checklistrecords[$i]->assessor_score_point==0)
																	<input type="hidden" name="assessor_score_point[]" value="0" class="form-control input-sm txt">
																@else
																	<input type="text" name="assessor_score_point[]" value="{{$checklistrecords[$i]->assessor_score_point}}" class="form-control input-sm txt">
																@endif
															</td>
															<td>{{ $checkListStandard->standard_code }}</td>
															<td>
																@if ($checkListStandard->standard_code===null  && $checklistrecords[$i]->assessor_rating==0)
																	<input type="hidden" name="assessor_rating[]" value="0" class="form-control input-sm bstxt">
																@else
																	<input type="text" name="assessor_rating[]" value="{{$checklistrecords[$i]->assessor_rating}}" class="form-control input-sm bstxt">
																@endif
															</td>
															<td>
																@if ($checkListStandard->standard_id===2)
																	<input type="checkbox" name="check" checked><span class="text-danger">*</span>
																	<input type="hidden" name="checkvalue[]" value="1" class="chk">
																@else 
																	<input type="checkbox" name="check" checked>
																	<input type="hidden" name="checkvalue[]" value="1" class="chk">
																@endif
															</td>
															
															@php 
																($scorepointtotal +=$checklistrecords[$i]->assessor_score_point);
																($ratingpointtotal +=$checklistrecords[$i]->assessor_rating);
																($i++) 
															@endphp 
															@else
																<td>
																	<input type="hidden" name="checklist_record_id[]" value="">	
																	@if ($checkListStandard->checklist_pts===null)
																			<input type="hidden" name="assessor_score_point[]" class="form-control input-sm txt" value="0"></td>
																		@else
																			<input type="text" name="assessor_score_point[]" class="form-control input-sm txt"></td>
																		@endif
																</td>
																<td>{{ $checkListStandard->standard_code }}</td>
																<td>
																	@if ($checkListStandard->standard_code===null)
																		<input type="hidden" name="assessor_rating[]" value="0" class="form-control input-sm bstxt">
																	@else
																		<input type="text" name="assessor_rating[]" class="form-control input-sm bstxt">
																	@endif
																</td>
																<td>
																	@if ($checkListStandard->standard_id===2)
																		<input type="checkbox" name="check"><span class="text-danger">*</span>
																		<input type="hidden" name="checkvalue[]" value="0" class="chk">
																	@else 
																		<input type="checkbox" name="check">
																		<input type="hidden" name="checkvalue[]" value="0" class="chk">
																	@endif
																</td>
															@endif
													@php
													$area = $chapterArea->checklist_area;
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
			<h4 class="card-title">Score Points and Basic Standards(B + B*) Details</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-5">
					<label for="">
                        Number of Score Points	(250-370)			
						<span id="scorepoint">: &nbsp;{{ $scorepointtotal }}</span>			
					</label>
				</div>
				<div class="form-group col-md-5 offset-md-2">
					<label for=""> 
                        Number of Bs (Basic standards 132/136)
						<span id="bspoints">:&nbsp;{{ $ratingpointtotal }}</span>
					</label>
				</div>
			</div>
		</div>
	</div>
@endif
