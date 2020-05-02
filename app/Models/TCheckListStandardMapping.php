<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TCheckListStandardMapping extends Model
{
    const IS_ACTIVE = 1;

    protected $table = 't_check_list_standard_mappings';
    protected $guarded = ['id'];

    public function starCategory()
    {
        return $this->belongsTo(TStarCategory::class, 'star_category_id');
    }

    public function checklistStandard()
    {
        return $this->belongsTo(TCheckListStandard::class, 'checklist_id');
    }

    public function basicStandard()
    {
        return $this->belongsTo(TBasicStandard::class, 'standard_id');
    }

    public function isActive()
    {
        return $this->is_active == self::IS_ACTIVE;
    }
   
}
