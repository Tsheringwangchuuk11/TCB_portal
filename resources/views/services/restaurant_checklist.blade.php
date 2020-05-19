@if ($checklistDtls->count() > 0)
<h5>Self-assessment Check List</h5>
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
                                <td><input type="checkbox" name="checklist_id[]" value="{{$checkListStandard->checklist_id}}"></td>
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
   </div>
</div>
@endforeach
@endif