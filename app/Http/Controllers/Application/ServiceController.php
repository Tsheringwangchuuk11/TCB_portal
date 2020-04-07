<?php

namespace App\Http\Controllers\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Services;
use App\Models\Dropdown;
class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
    }
    
    public function getModules()
    {
        $servicemodules = Dropdown::getDropdowns("t_module_master","module_id","module_name","0","0");
        return view('services/modules/module_services',compact('servicemodules'));  
    }

    public function getServices(Request $request)
    {
        $servicelist = Services::getServiceLists($request);
        return json_encode(array('data'=>$servicelist));
    }
    
    public function getServiceForm($page_link)
    {
        $page_link=str_replace("-", '/',$page_link);
        $idInfos = Services::getIdInfo($page_link);
        $starCategoryLists = Dropdown::getDropdowns("t_star_category","star_category_id","star_category_name","0","0");
        return view($page_link, compact('idInfos','starCategoryLists'));
    }
}
