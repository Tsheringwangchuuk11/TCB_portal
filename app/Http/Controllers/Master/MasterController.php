<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master;
class MasterController extends Controller
{
    public function getRoomTypesList(Request $request){
        $data['privileges'] = $request->instance();
        $data['roomtypeslists'] = Master::getRoomTypesList();
        return view('master.room_types',$data);
    }
}
