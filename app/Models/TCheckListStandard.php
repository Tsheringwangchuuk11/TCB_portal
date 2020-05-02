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
    
}
