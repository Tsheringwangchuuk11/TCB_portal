<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TSystemMenu extends Model
{
    protected $table = 't_system_menus';
    protected $guarded = ['id'];

    //Relationships
    public function systemSubMenus()
    {
        return $this->hasMany(TSystemSubMenu::class, 'system_menu_id');
    }
}
