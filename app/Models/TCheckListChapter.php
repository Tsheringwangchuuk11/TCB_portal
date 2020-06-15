<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TCheckListChapter extends Model
{

    const IS_ACTIVE = 1;
    protected $table = 't_check_list_chapters';
    protected $guarded = ['id'];

    public function serviceModule()
    {
        return $this->belongsTo(TModuleMaster::class, 'module_id');
    }

    public function isActive()
    {
        return $this->is_active == self::IS_ACTIVE;
    }

    public function chapterAreas()
    {
        return $this->hasMany(TCheckListArea::class, 'checklist_ch_id');
    }

     //Scopes and filters
     public function scopeActiveChecklistChapter($query)
     {
         return $query->where('is_active', self::STATUS_ACTIVE);
     }
 
     public function scopeFilter($query, $request)
     {
         if ($request->has('search_text') && $request->query('search_text') != '') {
             $query->where('checklist_ch_name', 'LIKE', '%' . $request->query('search_text') . '%')
             ->orWhereHas('serviceModule', function ($query1) use($request){
                $query1->where('module_name', 'LIKE', '%' . $request->query('search_text') . '%');
            });
         }
     }
}
