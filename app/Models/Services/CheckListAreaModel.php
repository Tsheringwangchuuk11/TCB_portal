<?php

namespace App\Models\Services;
use Illuminate\Database\Eloquent\Model;

class CheckListAreaModel extends Model
{
    protected $primaryKey = 'checklist_area_id';
    public $table='t_checklist_area';
    public function checkListArea(){
        return $this->hasMany('App\Models\Services\CheckListStandardModel','checklist_ch_id','checklist_id');
        }
}
