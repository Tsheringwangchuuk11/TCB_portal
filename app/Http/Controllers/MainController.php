<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Models\WorkFlowDetails;

class MainController extends Controller
{
    function user_login()
    {
     return view('public_login');
    }

    public function register(Request $request) {
        User::create([
            'user_name' => $request->user_name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'user_id' => $request->user_id,
            'password' => bcrypt($request->password),
            'is_verified' => 1,
            'user_status' => 1
          ]);
        
        return response()->json(['success'=>'Form is successfully submitted!']);
  
      }

      
    function checklogin(Request $request)
    {

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
        $userId = $request->get('email');
        
        $data = DB::table('t_users')->where('email',$userId)->first('id');
        $roleCount = \DB::table('t_user_roles')->where('user_id', '=', $data->id)
            ->count();
            
        $roles = DB::table('t_user_roles')->where('user_id',$data->id)->get();

        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        } 
        if($roleCount > 0)
        {
          return redirect('/tasklist/tasklist');
        }
        else
        {
          $endUserApplicantDtls = WorkFlowDetails::getEndUserApplicationDtls($userId);
          return view('dashboards.public',compact('endUserApplicantDtls'));
        }
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }

    function successlogin()
    {
     return view('dashboards.public');
    }

    function logout()
    {
     Auth::logout();
     return redirect('/');
    }
}
