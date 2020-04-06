<?php

namespace App\Models\Services;

use DB;
use Illuminate\Database\Eloquent\Model;

class CheckListArea extends Model
{
    public $table = "t_checklist_area";

    public static function getCheckListArea($id){
        $area = DB::table('t_checklist_area as t1')
            ->leftJoin('t_checklist_standard as t2', 't2.checklist_area_id', '=', 't1.checklist_area_id')
            ->select(DB::raw('count(t2.checklist_area_id) as total1'),'t1.checklist_area_id','t1.checklist_name')
            ->where('t1.checklist_ch_id', $id)
            ->groupBy('t1.checklist_area_id', 't1.checklist_name')
            ->get();
        return $area;
    }

}
