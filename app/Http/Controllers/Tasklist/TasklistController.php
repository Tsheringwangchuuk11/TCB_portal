<?php

namespace App\Http\Controllers\Tasklist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasklistController extends Controller
{
    //
    public function index()
    {
        //
        $roles  = auth()->user()->roles()->pluck('role_id')->toArray();
        return view('services.tasklist.tasklist');
    }
    public function claimApplication(Request $request){
        return response()->json('claimApplication'.$request->id);
    }
    public function releaseApplication(){
        return response()->json('releaseApplication');

    }
    public function openApplication(){
        return response()->json('openApplication');
    }
}
