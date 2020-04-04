<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class CheckListChapterModel extends Model
{
    protected $primaryKey = 'checklist_ch_id';
    public $table='t_checklist_chapter';
    public function checkListArea(){
       return $this->hasMany('App\Models\Services\CheckListAreaModel','checklist_ch_id','checklist_ch_id');
       }
}
