<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TSystemSubMenu extends Model
{
    protected $table = 't_system_sub_menus';
    protected $guarded = ['id'];

    //Relationships
    public function systemMenu()
    {
        return $this->belongsTo(TSystemMenu::class, 'system_menu_id');
    }

    public function systemDivision()
    {
        return $this->belongsTo(TService::class, 'division_id');
    }
}
