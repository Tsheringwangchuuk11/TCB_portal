<?php

namespace App\Http\Controllers\SystemSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TSystemMenu;
use App\TRole;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:system/roles,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:system/roles,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:system/roles,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:system/roles,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $roles = TRole::orderBy('id')->select('id','name')->get();
        return view('system-settings.roles.index', compact('roles', 'privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = TSystemMenu::with(['systemSubMenus' => function($q){
            $q->orderBy('display_order')->select('id', 'name', 'route', 'system_menu_id')->get();
        }])->orderBy('display_order')->select('id', 'name', 'icon')->get();


        return view('system-settings.roles.create')->with('modules', $modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['role_name' => 'required']);

        \DB::transaction(function () use ($request) {

            $role = new TRole;

            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->created_by = auth()->user()->id;
            $role->save();

            if ($request->permission_role) {
                $rolePermissions = $this->rolePermissionData($request->permission_role);
                $role->rolePermissions()->createMany($rolePermissions);
            }

        });

        return redirect('system/roles')->with('msg_success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = TRole::findOrFail($id);
        $modules = \DB::select("select `a`.`flag`, `a`.`top_menu`, `a`.`sub_menu_id`,`a`.`sub_menu`,`a`.`view`,`a`.`create`,`a`.`edit`,`a`.`delete`
            FROM (SELECT
                'M' flag,
                t1.`name` AS top_menu,
                t2.`id` AS sub_menu_id,
                t2.`name` AS sub_menu,
                t3.`view`,
                t3.`create`,
                t3.`edit`,
                t3.`delete`,
                t1.id
            FROM
            (
            t_system_menus AS t1
            JOIN t_system_sub_menus AS t2
                ON t1.`id` = t2.`system_menu_id`
            )
            LEFT JOIN t_role_privileges AS t3
            ON t2.`id` = t3.`system_sub_menu_id` AND `t3`.`role_id` = ?
        -- order by t1.display_order
            UNION
            SELECT
                'S' flag,
                t1.`name` AS top_menu,
                t2.`id` AS sub_menu_id,
                t2.`name` AS sub_menu,
                t3.`view`,
                t3.`create`,
                t3.`edit`,
                t3.`delete`,
                t1.id
            FROM
            (
                t_services AS t1
                JOIN t_system_sub_menus AS t2
                ON t1.`id` = t2.`service_id`
            )
            LEFT JOIN t_role_privileges AS t3
                ON t2.`id` = t3.`system_sub_menu_id` AND `t3`.`role_id` = ? ) a ORDER BY a.flag, a.id", array($id, $id));

        return view('system-settings.roles.show', compact('role', 'modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = TRole::findOrFail($id);
        $modules = \DB::select("select `a`.`flag`, `a`.`top_menu`, `a`.`sub_menu_id`,`a`.`sub_menu`,`a`.`view`,`a`.`create`,`a`.`edit`,`a`.`delete`
            FROM (SELECT
                'M' flag,
                t1.`name` AS top_menu,
                t2.`id` AS sub_menu_id,
                t2.`name` AS sub_menu,
                t3.`view`,
                t3.`create`,
                t3.`edit`,
                t3.`delete`,
                t1.id
            FROM
                (
                t_system_menus AS t1
                JOIN t_system_sub_menus AS t2
                    ON t1.`id` = t2.`system_menu_id`
                )
                LEFT JOIN t_role_privileges AS t3
                ON t2.`id` = t3.`system_sub_menu_id` AND `t3`.`role_id` = ?
            -- order by t1.display_order
                UNION
                SELECT
                'S' flag,
                t1.`name` AS top_menu,
                t2.`id` AS sub_menu_id,
                t2.`name` AS sub_menu,
                t3.`view`,
                t3.`create`,
                t3.`edit`,
                t3.`delete`,
                t1.id
                FROM
                (
                    t_services AS t1
                    JOIN t_system_sub_menus AS t2
                    ON t1.`id` = t2.`service_id`
                )
                LEFT JOIN t_role_privileges AS t3
                    ON t2.`id` = t3.`system_sub_menu_id` AND `t3`.`role_id` = ? ) a ORDER BY a.flag, a.id", array($id, $id));


        return view('system-settings.roles.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['role_name' => 'required']);

        \DB::transaction(function () use ($request, $id) {

            $role = TRole::findOrFail($id);

            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->updated_by = auth()->user()->id;
            $role->save();

            $rolePermissions = [];

            if ($request->permission_role) {
                $rolePermissions = $this->rolePermissionData($request->permission_role);
            }

            $role->rolePermissions()->delete();
            $role->rolePermissions()->createMany($rolePermissions);
        });

        return redirect('system/roles')->with('msg_success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = TRole::findOrFail($id);

        if ($role->rolePermissions()->count() > 0) {
            return redirect()->back()->with('msg_error', 'Error deleting role. Please remove all the permissions assigned to it by editing System Administration > Role > ' . $role->name);
        }

        if ($role->users()->count() > 0) {
            return redirect()->back()->with('msg_error', 'Error deleting role. Please remove all the users assigned to it by editing System Administration > Users');
        }

        $role->delete();

        return redirect('system/roles')->with('msg_success', 'Role delete successfully');
    }

    private function rolePermissionData(array $permissions)
    {
        $rolePermissions = [];

        foreach ($permissions as $key => $value) {
            $rolePermissions[] = [
                'system_sub_menu_id' => $value['sub_menu_id'],
                'view' => array_key_exists('view', $value) ? $value['view'] : 0,
                'create' => array_key_exists('create', $value) ? $value['create'] : 0,
                'edit' => array_key_exists('edit', $value) ? $value['edit'] : 0,
                'delete' => array_key_exists('delete', $value) ? $value['delete'] : 0,
                'created_by' => auth()->user()->id
            ];
        }

        return $rolePermissions;
    }
}
