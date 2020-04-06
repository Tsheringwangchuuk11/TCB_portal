<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPrivilege extends Model
{
    protected $table = 't_privileges';
    protected $guarded = ['id'];

    //relationships
    public function systemSubMenu()
    {
        return $this->belongsTo(TSystemSubMenu::class, 'system_sub_menu_id');
    }
}
