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
                           <td>Mandatory</td>
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
                                    <td>{{ $checkListStandard->standard_code }}</td>
                                    <td>
                                          @if ($checkListStandard->mandatory==='1')
                                          <input type="checkbox" name="checklist_id[]" value="{{$checkListStandard->checklist_id}}"><span class="text-danger">*</span>
                                          @else 
                                          <input type="checkbox" name="checklist_id[]" value="{{$checkListStandard->checklist_id}}">
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
@endif