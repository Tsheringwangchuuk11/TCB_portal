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
									<thead>
										<tr>
											<td>Area</td>
											<td>Standard</td>
											<td>Score points</td>
											<td>Assessor’s score point</td>
											<td>B/B* rating</td>
											<td>Assessor’s B/B* rating</td>
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
													<td>{{ $checkListStandard->checklist_pts }}</td>
													<td> 
														@if ($checkListStandard->checklist_pts===null)
														<input type="hidden" name="assessor_score_point[]" class="form-control input-sm txt" value="0"></td>
														@else
														<input type="text" name="assessor_score_point[]" class="form-control input-sm txt"></td>
														@endif
													<td>{{ $checkListStandard->standard_code }}</td>
													<td>
														@if ($checkListStandard->standard_code===null)
														<input type="hidden" name="assessor_rating[]" value="0" class="form-control input-sm bstxt">
														@else
														<input type="text" name="assessor_rating[]" class="form-control input-sm bstxt" id="assessor_rating" readonly="readonly">
														@endif
													</td>
													<td>
														<input type="hidden" name="checklist_id[]" class="checklist" value="{{$checkListStandard->checklist_id}}">
														@if ($checkListStandard->standard_id===2)
														<input type="checkbox" name="check"><span class="text-danger">*</span>
														<input type="hidden" name="checkvalue[]" value="0" class="chk">
														@else 
														<input type="checkbox" name="check">
														<input type="hidden" name="checkvalue[]" value="0" class="chk">
														@endif
													</td>
													@php
													$area = $chapterArea->checklist_area
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
						@if ($starCategoryId==1)
						     Total Assessor’s score point(160-199)
						@elseif($starCategoryId==2)
						     Total Assessor’s score point(200-279)
						@else
					    	Total Assessor’s score point(280 +)
						@endif
					</label>
					<input type="text" class="form-control" name="scorepoint" id="scorepoint" readonly>
				</div>
				<div class="form-group col-md-5 offset-md-2">
					<label for=""> 
						@if ($starCategoryId==1)
						     Total Assessor’s B/B* rating (117 out of 120)
						@elseif($starCategoryId==2)
					     	Total Assessor’s B/B* rating (145 out of 149)
						@else
					    	Total Assessor’s B/B* rating (162 out of 166)
						@endif
					</label>
					<input type="text" class="form-control" name="bspoints" id="bspoints" readonly>
				</div>
			</div>
        </div>
	</div>
@endif
<script>
	function calculateScorePoint() {
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".txt").each(function () {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				sum += parseFloat(this.value);
			}
		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
	 $("#scorepoint").val(sum);
	}
	$("table").on("keyup", ".txt", function () {
		calculateScorePoint();
	});
	
	function calculateBsPoint() {
		var sum = 0;
		//iterate through each textboxes and add the values
		$(".bstxt").each(function () {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				sum += parseFloat(this.value);
			}
		});
		//.toFixed() method will roundoff the final sum to 2 decimal places
	 $("#bspoints").val(sum);
	}
	
	$('input[type="checkbox"]').on('change', function(){
        if($(this).is(":checked")){ // checkbox checked
		currentRow = $(this).closest("tr");
        var currentVal=currentRow.find('.chk').val('1');
		$(this).parents("tr:eq(0)").find("#assessor_rating").prop("readonly",true);
		$(this).parents("tr:eq(0)").find("#assessor_rating").val('1');
		calculateBsPoint();
        }
		if($(this).is(":unchecked")){ // checkbox unchecked
		currentRow = $(this).closest("tr");
        var currentVal=currentRow.find('.chk').val('0');
		$(this).parents("tr:eq(0)").find("#assessor_rating").prop("readonly",false);
		$(this).parents("tr:eq(0)").find("#assessor_rating").val('');
		calculateBsPoint();
        }
    });
</script>
