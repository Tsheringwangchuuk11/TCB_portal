<?php

namespace App\Http\Controllers\EndUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
class EnduserController extends Controller
{
   

    public function getApplicationDetails()
    {
        return view('dashboards.public');
    }
    public function getModules()
    {
        $servicemodules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");
        return view('services/modules/enduser_module_services',compact('servicemodules'));
    }
}
