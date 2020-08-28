<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TCheckListStandard extends Model
{
    const IS_ACTIVE = 1;
    protected $table = 't_check_list_standards';
    protected $guarded = ['id'];

    public function checklistArea()
    {
        return $this->belongsTo(TCheckListArea::class, 'checklist_area_id');
    }

    public function isActive()
    {
        return $this->is_active == self::IS_ACTIVE;
    }

    public function checklistStandardMapping()
    {
        return $this->hasMany(TCheckListStandardMapping::class, 'checklist_id');
    }

    //Relationships
    public function standardMapping()
    {
        return $this->belongsToMany(TStarCategory::class, 't_check_list_standard_mappings', 'checklist_id', 'star_category_id')
            ->withPivot('standard_id', 'is_active', 'mandatory', 'created_by', 'updated_by')
            ->leftJoin('t_basic_standards', 't_check_list_standard_mappings.standard_id', 't_basic_standards.id')//to display measurement uint as name
            ->select('t_star_categories.star_category_name', 't_basic_standards.standard_code as code', 't_check_list_standard_mappings.is_active', 't_check_list_standard_mappings.mandatory')
            ->withTimestamps();
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('search_text') && $request->query('search_text') != '') {
            $query->where('checklist_standard', 'LIKE', '%' . $request->query('search_text') . '%')
             ->orWhereHas('checklistArea', function ($query1) use($request){
            $query1->where('checklist_area', 'LIKE', '%' . $request->query('search_text') . '%');
            if($request->get('chapterid') != ''){
                $query1->where('checklist_ch_id',  $request->query('chapterid'));
            }
             if ($request->get('sortby') == 'checklist_area'){
                 $query1->orderBy($request->get('sortby'), $request->get('sorttype'));
             }
         });
            if($request->get('sortby') == 'id' || $request->get('sortby') == 'checklist_standard'){
                $query->orderBy($request->get('sortby'), $request->get('sorttype'));
            }
        }else {
            $query->orWhereHas('checklistArea', function ($query1) use($request){
                if($request->get('chapterid') != ''){
                    $query1->where('checklist_ch_id',  $request->query('chapterid'));
                }
                if ($request->get('sortby') == 'checklist_area'){
                    $query1->orderBy($request->get('sortby'), $request->get('sorttype'));
                }
                });
            if($request->get('sortby') == 'id' || $request->get('sortby') == 'checklist_standard'){
                $query->orderBy($request->get('sortby'), $request->get('sorttype'));
            }
        }
    }
}
