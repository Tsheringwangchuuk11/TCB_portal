<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\PublicMenuGenerator;

class EnduserMenuComposer
{
    private $menus;

    public function __construct(PublicMenuGenerator $menu)
    {
        $this->menus = $menu->menuAccessibleByStaticRole();
    }

    public function compose(View $view)
    {
        $view->with('menus', $this->menus);
    }
}