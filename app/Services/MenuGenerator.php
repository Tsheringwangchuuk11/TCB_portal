<?php

namespace App\Services;

use App\TSystemMenu;
use Carbon\Carbon;

class MenuGenerator
{
    private $user;
    private $userRoles;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->userRoles = $this->user->roles();
    }

    private function userRolesCastedToArray()
    {
        //pull users role_id's and convert it into array.
        return $this->userRoles->pluck('role_id')->toArray();
    }

    /**
     * links / pages accessible by the role
     *
     * @return \Illuminate\Http\Response
     */

    public function menuAccessibleByRole()
    {
        $userRoles = $this->userRolesCastedToArray();

        $menus = TSystemMenu::with(['systemSubMenus' => function ($query) use ($userRoles) {
            $query->whereIn('id', function ($q) use ($userRoles){
                $q->select('system_sub_menu_id')->from('t_privileges')->where('view', 1)->whereIn('role_id', $userRoles);
            })->orderBy('display_order');
        }])->orderBy('display_order')->get();
        return $menus;
    }

    /**
     * return menus in array format
     *
     * @return \Illuminate\Http\Response
     */
    public function menuCastedToArray()
    {
        return $this->menuAccessibleByRole()->toArray();
    }
}