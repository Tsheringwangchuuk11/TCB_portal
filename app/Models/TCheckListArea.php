<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TCheckListArea extends Model
{
    const IS_ACTIVE = 1;

    protected $table = 't_check_list_areas';
    protected $guarded = ['id'];

    public function checklistChapter()
    {
        return $this->belongsTo(TCheckListChapter::class, 'checklist_ch_id');
    }

    public function isActive()
    {
        return $this->is_active == self::IS_ACTIVE;
    }

    public function checkListStandards(){
        return $this->hasMany(TCheckListStandard::class,'checklist_area_id');

    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('search_text') && $request->query('search_text') != '') {
            $query->where('checklist_area', 'LIKE', '%' . $request->query('search_text') . '%')
             ->orWhereHas('checklistChapter', function ($query1) use($request){
            $query1->where('checklist_ch_name', 'LIKE', '%' . $request->query('search_text') . '%');
         })
         ->orWhereHas('checklistChapter.serviceModule', function ($query1) use($request){
            $query1->where('module_name', 'LIKE', '%' . $request->query('search_text') . '%');
          });
        }
    }
}
