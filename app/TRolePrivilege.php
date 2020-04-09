<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TRolePrivilege extends Model
{
    //t_role_privileges
    protected $table = 't_role_privileges';
    protected $guarded = ['id'];

    //relationships
    public function systemSubMenu()
    {
        return $this->belongsTo(TSystemSubMenu::class, 'system_sub_menu_id');
    }

    public function systemSubMenuDivision()
    {
        return $this->belongsTo(TSystemSubMenu::class, 'service_id');
    }
}
