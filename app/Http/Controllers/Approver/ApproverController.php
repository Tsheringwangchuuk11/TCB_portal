<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;

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
         $starCategoryIdId=Services::getApplicantDetails($applicationNo)->star_category_id;

         $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo,$starCategoryIdId){
            $q->with(['checkListStandards'=> function($query) use($applicationNo,$starCategoryIdId){
                $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                    ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                    ->where('t_checklist_applications.application_no','=',$applicationNo)
                    ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryIdId);
            }]);
        }])->where('module_id','=',$moduleId)
        ->get();
        return view('services.approver.hotels_assessment',$data);

    }

    public function approveNewApplication(Request $request){
        $approveId = WorkFlowDetails::getStatus('APPROVED');
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
    }
}
