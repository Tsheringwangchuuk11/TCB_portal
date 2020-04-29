@php use App\Http\Controllers\Application\ServiceController; @endphp
@if ($chapters->count() > 0)
<h5>Checklist</h5>
    @foreach ($chapters as $chapter)
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
                                <td colspan="2">Points</td>
                                <td colspan="2">Rating</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $chapterareas =ServiceController::getChapterAreaList($chapter->id,$starCategoryId);?>
                            @if ($chapterareas->count() > 0)
                                    @foreach ($chapterareas as $chapterarea)
                                        @if($chapter->id === $chapterarea->checklist_ch_id)
                                            <?php $standards =ServiceController::getStandardList($starCategoryId,$chapterarea->checklist_area_id);?>
                                            @if ($standards->count() > 0)
                                                @php($i=1)
                                                @foreach ($standards as $standard)
                                                    @if($standard->checklist_area_id === $chapterarea->checklist_area_id)
                                                        <tr>
                                                            @if ($i==1)
                                                            <td rowspan="{{$chapterarea->count}}">{{$chapterarea->checklist_area}}</td>
                                                            @endif
                                                        <td>{{$standard->checklist_standard}}</td>
                                                            <td>{{$standard->checklist_pts}}</td>
                                                            <td><input type="checkbox" name="checklist_id[]" value="{{$standard->checklist_id}}" id="points"></td>
                                                            <td>{{$standard->standard_code}}</td>
                                                            @if ($standard->id===1)
                                                            <td><input type="checkbox" name="rates[]" value="{{$standard->checklist_pts}}" id="rates"><span class="text-danger">*</span></td>
                                                            @else
                                                            <td><input type="checkbox" name="rates[]" value="{{$standard->checklist_pts}}" id="rates"></td>
                                                            @endif
                                                            @php($i++)
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif