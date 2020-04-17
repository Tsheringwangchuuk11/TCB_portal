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
}
