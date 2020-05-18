<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OpenApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);

    }
    public function openApplication($applicationNo,$serviceId,$moduleId){
        if($moduleId==1){
             //Tourist Standard Details             
             return redirect()->route('touriststandardhotel',[$applicationNo]);
         }
        if($moduleId==2){
            //Village Home Stay Details
            return redirect()->route('villagehomestay',[$applicationNo]);
        }
       if($moduleId==3){
        //Restaurant Details
        return redirect()->route('restaurant',[$applicationNo]);
        }
        elseif($moduleId==4){
            //Tour Operator Details
             return redirect()->route('touropertor',[$applicationNo]);
        }
        elseif($moduleId==5){
            //Tourism product development
            return redirect()->route('tourismproductdevelopment',[$applicationNo]);
        }
        elseif($moduleId==6){
            // Grievances Redressal
            return redirect()->route('grievancesredressal',[$applicationNo]);
        }
        elseif($moduleId==7){
            //Media familiarization tour Details
            return redirect()->route('media',[$applicationNo]);
        }
    }
}
