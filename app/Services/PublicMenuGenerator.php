<?php

namespace App\Services;

use App\TSystemMenu;
use Carbon\Carbon;

class PublicMenuGenerator
{

   
    /**
     * links / pages accessible by the role
     *
     * @return \Illuminate\Http\Response
     */

    public function menuAccessibleByStaticRole()
    {
        $userRoles[] =2;

        $menus = TSystemMenu::with(['systemSubMenus' => function ($query) use ($userRoles) {
            $query->whereIn('id', function ($q) use ($userRoles){
                $q->select('system_sub_menu_id')->from('t_role_privileges')->where('view', 1)->whereIn('role_id', $userRoles);
            })->orderBy('display_order');
        }])->orderBy('display_order')->get();
        return $menus;
    }

    /**
     * return menus in array format
     *
     * @return \Illuminate\Http\Response
     */
}