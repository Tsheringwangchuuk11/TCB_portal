@php use App\Http\Controllers\Services\ServiceController; @endphp
@if (count($chapterList) > 0)
    @foreach ($chapterList as $chapterList)
        <div class="card collapsed-card">
            <div class="card-header" data-card-widget="collapse">
                <span>{{$chapterList->checklist_ch_name}}</span>
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
                                <td>Point</td>
                                <td>Checklist</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $chapterarea =ServiceController::getChapterAreaList($chapterList->checklist_ch_id, $starCategoryId);?>
                            @if (count($chapterarea) > 0)
                                @foreach ($chapterarea as $chapterarea)
                                    @if($chapterList->checklist_ch_id === $chapterarea->checklist_ch_id)
                                        <?php $standard =ServiceController::getStandardList($starCategoryId,$chapterarea->checklist_area_id);?>
                                        @if (count($standard) > 0)
                                            @php($i=1)
                                            @foreach ($standard as $standard)
                                                @if($standard->checklist_area_id === $chapterarea->checklist_area_id)
                                                    <tr>
                                                        @if ($i==1)
                                                        <td rowspan="{{$chapterarea->count}}">{{$chapterarea->checklist_area}}</td>
                                                        @endif
                                                        <td>{{$standard->checklist_standard}}</td>
                                                        <td>{{$standard->checklist_pts}}</td>
                                                        <td>{{$standard->standard_code}}</td>
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