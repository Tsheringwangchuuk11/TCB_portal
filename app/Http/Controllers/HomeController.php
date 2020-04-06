<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function getDashboard()
    {
        return view('dashboard');
    }


    public function getProfile(Request $request)
    {
        $user = auth()->user();
        $userLogs = $user->userLogs()->orderBy('created_at', 'desc')->paginate(5);

        return view('profile', compact('user', 'userLogs'));
    }

    public function getChangePassword()
    {
        return view('system-settings.change-password');
    }

    public function postChangePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
        $this->validate($request, $rules);
    	if(\Hash::check($request->input('old_password'), $request->user()->password)){
			$request->user()->update([
                'password' => bcrypt($request->input('new_password'))
            ]);
            return redirect('change-password')->with('msg_success', 'Password Successfully updated');
		}
		return redirect('change-password')->with('msg_error', 'Your old password did not match our records');
    }

	public function getDropdownLists(Request $request){
		$table_name = $request->table_name;
		$id = $request->id;
		$name = $request->name;
		$parent_id = $request->parent_id;
		$parent_name_id = $request->parent_name_id;
		$cities = Dropdown::getDropdownLists($table_name, $id, $name, $parent_id, $parent_name_id);
		return response()->json($cities);
	}

    // public function getServices(Request $request)
    // {
    //     $moduleId = $request->moduleId;
    //     $servicelist=DB::table("t_module_service_mapping as t1")
    //     ->join('t_service_master as t2', 't2.service_id', '=', 't1.service_id')
    //     ->select('t1.page_link', 't2.service_name')
    //     ->where('module_id', $moduleId)
    //     ->get()
    //     ->pluck("service_name","page_link");
    //     return json_encode(array('data'=>$servicelist));
    // }

    // public function getModules(){
    //     $servicemodule = DB::table("t_module_master as t1")
    //     ->select('t1.module_id','t1.module_name')
    //     ->get();
    //     return view('services/modules/module_services',compact('servicemodule'));

    // }
}
