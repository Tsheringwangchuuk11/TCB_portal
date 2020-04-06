<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HotelChapter extends Model
{
    public static function getChapter($starCategoryId,$chapterId){
        $value = DB::table('t_checklist_standard_mapping as t1')
        ->leftjoin('t_checklist_standard as t2','t1.checklist_id','=','t2.checklist_id')
        ->leftjoin('t_checklist_area as t3','t2.checklist_area_id','=','t3.checklist_area_id')
        ->select(DB::raw('count(t2.checklist_area_id) as count'),'t2.checklist_area_id','t3.checklist_area','t3.checklist_ch_id')
        ->where('t1.star_category_id', $starCategoryId AND 't3.checklist_ch_id',$chapterId)
        ->groupBy('t2.checklist_area_id','t3.checklist_area','t3.checklist_ch_id')
        ->get();
        return $value;
    }
}
