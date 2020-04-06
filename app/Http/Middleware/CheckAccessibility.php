<?php

namespace App\Http\Middleware;

use App\TSystemSubMenu;
use App\TPrivilege;
use Closure;

class CheckAccessibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $route
     * @param  $verb
     * @return mixed
     */
    public function handle($request, Closure $next, $route, $verb)
    {
        if (!$route && !$verb) {
            abort(403);
        }

        $userRoles = auth()->user()->roles()->pluck('role_id')->toArray();
        $menuId = TSystemSubMenu::where('route', $route)->pluck('id')->first();
        $accessibilities = TPrivilege::where('system_sub_menu_id', $menuId)->whereIn('role_id', $userRoles)->select('view', 'create', 'edit', 'delete')->first();

        if (!$accessibilities) {
            abort(403);
        }

        $accessibilities = $accessibilities->toArray();

        //Pushing the roles access levels into the request instance. Can be globally accessed the action from the request instance
        $request->merge( array (
            "create" => $accessibilities['create'],
            'edit' => $accessibilities['edit'],
            'delete' => $accessibilities['delete']
        ));
        //forward the request only if the role is granted access.
        if ($accessibilities[$verb] == 1)
        {
            return $next($request);
        }
        abort(403);
    }
}
