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
												<td>{{ $checkListStandard->checklist_pts }}</td>
												<td><input type="text" name="assessor_score_point[]" class="form-control input-sm txt"></td>
												<td>
                                       <input type="hidden" name="checklist_id[]" class="checklist" value="{{$checkListStandard->checklist_id}}">
                                       <input type="checkbox" name="check">
													<input type="hidden" name="checkvalue[]" value="0" class="chk">
                                    </td>
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
					<input type="text" class="form-control" name="scorepoint" id="scorepoint" readonly>
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