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
        elseif($moduleId==8){
            //Tourism Event Details
            return redirect()->route('tourismevent',[$applicationNo]);
        }
        elseif($moduleId==9){
            //Media familiarization tour Details
            return redirect()->route('tendedaccommodation',[$applicationNo]);
        }
    }

    public function viewApplication($applicationNo,$serviceId,$moduleId){
        if($moduleId==1){
             //Tourist Standard Details             
             return redirect()->route('touriststandardhoteldetails',[$applicationNo]);
         }
        if($moduleId==2){
            //Village Home Stay Details
            return redirect()->route('villagehomestaydetails',[$applicationNo]);
        }
       if($moduleId==3){
        //Restaurant Details
        return redirect()->route('restaurantdetails',[$applicationNo]);
        }
        elseif($moduleId==4){
            //Tour Operator Details
             return redirect()->route('touropertordetails',[$applicationNo]);
        }
        elseif($moduleId==5){
            //Tourism product development
            return redirect()->route('tourismproductdevelopmentdetails',[$applicationNo]);
        }
        elseif($moduleId==6){
            // Grievances Redressal
            return redirect()->route('grievancesredressaldetails',[$applicationNo]);
        }
        elseif($moduleId==7){
            //Media familiarization tour Details
            return redirect()->route('mediadetails',[$applicationNo]);
        }
        elseif($moduleId==8){
            //Tourism Event Details
            return redirect()->route('tourismeventdetails',[$applicationNo]);
        }
        elseif($moduleId==9){
            //Media familiarization tour Details
            return redirect()->route('tendedaccommodationdetails',[$applicationNo]);
        }
    }
}
