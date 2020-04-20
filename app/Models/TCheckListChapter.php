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
}
