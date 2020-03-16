<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/home');

    }

    public function getServices(Request $request)
    {
        $moduleId = $request->moduleId;
        $servicelist=DB::table("t_module_service_mapping as t1")       
        ->join('t_service_master as t2', 't2.service_id', '=', 't1.service_id')
        ->select('t1.page_link', 't2.service_name')
        ->where('module_id', $moduleId)
        ->get()
        ->pluck("service_name","page_link");
        return json_encode(array('data'=>$servicelist));
    }

    public function getModules(){
        $servicemodule = DB::table("t_module_master as t1")
        ->select('t1.module_id','t1.module_name')
        ->get();
        return view('services/modules/module_services',compact('servicemodule'));

    }
}
