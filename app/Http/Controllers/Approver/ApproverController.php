<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
class ApproverController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);

    }

    public function openApplication($applicationNo,$serviceId,$moduleId){
        $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
         $data['appInfos']=Services::getApplicantDetails($applicationNo);
         $data['roomInfos']=Services::getRoomDetails($applicationNo);
         $data['staffInfos']=Services::getStaffDetails($applicationNo);
         $data['documentInfos']=Services::getDocumentDetails($applicationNo);
         return view('services.approver.hotels_assessment',$data);

    }

    public function approveNewApplication(Request $request){
        $approveId = WorkFlowDetails::getStatus('APPROVED');
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
    }
}
