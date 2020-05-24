<?php

namespace App\Http\Controllers\FeedBack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Dropdown;
class GrievanceRedressalController extends Controller
{
    
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    public function getGrievanceRedressalList(){
        $grievanceLists=Services::getGrievanceRedressalList();
        return view('services/feedback/grievance_list',compact('grievanceLists'));
    }

    public function openApplication($applicationNo){
        $data['applicantInfo']=Services::getGrievanceDetails($applicationNo);
        $data['documentInfos']=Services::getGrievanceDocumentDetails($applicationNo);
        // return response()->json($data);
        $data['serviceproviders'] = Dropdown::getDropdowns("t_service_providers","id","service_provider_name","0","0");
        return view('services/feedback/show_grievance_details',$data);
    }
}
