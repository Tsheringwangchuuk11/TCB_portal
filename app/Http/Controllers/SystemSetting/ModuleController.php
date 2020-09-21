<?php

namespace App\Http\Controllers\SystemSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dropdown;
use App\TSystemMenu;
use App\TService;
use App\TSystemSubMenu;
use App\TRolePrivilege;

class ModuleController extends Controller
{
    private $rules = [
        'main_module_name' => 'required_if:module_display,module',
        'module_icon' => 'required_if:module_display,module',
        'module_display_order' => 'required_if:module_display,module',
        'service_id' => 'required_if:module_display,service',
        'service_id' => 'nullable|unique:t_system_sub_menus,service_id',        
        'submodules.*.sub_module_name' => 'required',
        'submodules.*.route' => 'required',
        'submodules.*.display_order' => 'required|integer',
    ];
    
    private $messages = [
        'submodules.*.sub_module_name.required' => 'Sub Module Name field is required',
        'submodules.*.route.required' => 'Route field is required',
        'submodules.*.display_order.required' => 'Display Order field is required',
        'submodules.*.display_order.integer' => 'Display Order field must be a valid number'
    ];

    public function __construct()
    {
        $this->middleware('permission:system/modules,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:system/modules,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:system/modules,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:system/modules,delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $modules = TSystemMenu::select('id', 'name', 'icon')->paginate(50);
        return view('system-settings.modules.index', compact('modules', 'privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Dropdown::getDropdowns("t_services","id","name","0","0");
        return view('system-settings.modules.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // dd($request->all());
        $this->validate($request, $this->rules, $this->messages);

        \DB::transaction(function () use ($request) {
            if($request->module_display == 'module'){

            $module = new TSystemMenu;

            $module->name = $request->main_module_name;
            $module->icon = $request->module_icon;
            $module->display_order = $request->module_display_order;
            $module->save();

            $subModules = [];

            foreach($request->submodules as $key => $value){
                $subModules[] = [
                    'name' => $value['sub_module_name'],
                    'route' => $value['route'],
                    'display_order' => $value['display_order']
                ];
            }
            $module->systemSubMenus()->createMany($subModules);
            }else{

            // $subMenuModel = new TSystemSubMenu;
            foreach($request->submodules as $key => $value){
                $subModules[] = [
                    'name' => $value['sub_module_name'],
                    'route' => $value['route'],
                    'display_order' => $value['display_order'],
                    'service_id' => $request->service_id,
                ];
            }
            TSystemSubMenu::insert($subModules);
            }
        });
        return redirect('system/modules')->with('msg_success', 'Module successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = TSystemMenu::with('systemSubMenus')->findOrFail($id);        
        // $services = Dropdown::getDropdowns("t_services","id","name","0","0");

        return view('system-settings.modules.edit', compact('module'));
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
        $this->validate($request, $this->rules, $this->messages);

        \DB::transaction(function () use ($request, $id) {
            $module = TSystemMenu::findOrFail($id);

            $module->name = $request->main_module_name;
            $module->icon = $request->module_icon;
            $module->display_order = $request->module_display_order;
            $module->save();

            //collect the ids of the SystemSubMenu table into an array from the database
            $subModuleIdsFromTheDatabase = TSystemSubMenu::where('system_menu_id', $module->id)->pluck('id')->toArray();
            $subModuleIdsFromTheDatabaseCount = sizeof($subModuleIdsFromTheDatabase);

            //count the total number of values in the array
            $subModuleIdsFromRequestCount = sizeof($request->submodules);

            //store the incoming form values in an array but only the sub modules/menus id
            foreach ($request->submodules as $value) {
                $subModuleIdsFromRequest [] = (int) $value['sub_module_id'];
            }

            //get the unique ids by comparing the above two arrays [subModuleIdsFromTheDatabase, subModuleIdsFromRequest]
            $uniqueSubModuleIds = array_merge(array_diff($subModuleIdsFromTheDatabase, $subModuleIdsFromRequest), array_diff($subModuleIdsFromRequest, $subModuleIdsFromTheDatabase));

            //before deleting the sub module, first we need to remove the role allocated to the particular module from the role permission table
            TRolePrivilege::whereIn('system_sub_menu_id', $uniqueSubModuleIds)->delete();

            //after that remove the deleted sub module from the system_sub_menus table
            TSystemSubMenu::whereIn('id', $uniqueSubModuleIds)->delete();

            //if the count is equal or the count from the form request is greater than that of the database count then just do the normal updateOrCreate
            foreach($request->submodules as $key => $value){
                TSystemSubMenu::updateOrCreate(
                    ['id' => $value['sub_module_id'], 'system_menu_id' => $id],
                    [
                        'name' => $value['sub_module_name'],
                        'route' => $value['route'],
                        'display_order' => $value['display_order'],
                    ]
                );
            }
        });
        return back()->with('msg_success', 'Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('system/modules')->with('msg_error', 'Delete is prohibited');
    }
}
