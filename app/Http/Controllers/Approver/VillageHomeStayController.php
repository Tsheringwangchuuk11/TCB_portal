<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
use App\Models\TCheckListChapter;
class VillageHomeStayController extends Controller
{
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    public function getApplicationDetails($applicationNo){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
       // dd($data['applicantInfo']);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['relationTypes'] = Dropdown::getDropdowns("t_relation_types","id","relation_type","0","0");

        if($serviceId==4){
        //Village Home stay Checklist Details
        $data['membersDetls']=Services::getMembersDetails($applicationNo);
        $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo){
            $q->with(['checkListStandards'=> function($query) use($applicationNo){
                $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                    ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                    ->where('t_checklist_applications.application_no','=',$applicationNo);
            }]);
        }])->where('module_id','=',$moduleId)
        ->get();
        return view('services.approver.approve_home_stays_assessment',$data);
        }
    }

     //Approval function for village Home Stay assessment application
   public function villageHomeStayAssessmentApplication(Request $request){
    if($request->status =='APPROVED'){
        // insert into t_techt_tourist_standard_dtlsnical_clearances
        \DB::transaction(function () use ($request) {
            $approveId = WorkFlowDetails::getStatus('APPROVED');
            $completedId= WorkFlowDetails::getStatus('COMPLETED');

        $applicantdata[]= [    
            'module_id'   => $request->module_id,
            'cid_no'   => $request->cid_no,
            'owner_name'   => $request->owner_name,
            'house_no'   => $request->house_no,
            'contact_no'   => $request->contact_no,
            'thram_no'   => $request->thram_no,
            'email'   => $request->email,
            'town_distance'   => $request->town_distance,
            'road_distance'   => $request->road_distance,
            'condition'   => $request->condition,
            'village_id'   => $request->village_id,
            'chiwog_id'   => $request->chiwog_id,
            'inspection_date'   =>date('Y-m-d', strtotime($request->inspection_date)),
            'validaty_date'   =>now()->addYears(3),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
        $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);
        // insert into t_room_dtls
        $membersData = [];
        if(isset($_POST['member_name'])){
            foreach($request->member_name as $key => $value){
            $membersData[] = [
                         'tourist_standard_id' =>  $id,
                         'member_name'   => $request->member_name[$key],
                         'relation_type_id'   => $request->relation_type_id[$key],
                         'member_age'   => $request->member_age[$key],
                         'member_gender'   => $request->member_gender[$key],
                         'created_at'   => now(),
                         'updated_at'   => now(),
                ];
             }
            $this->services->insertDetails('t_member_dtls',$membersData);
        }
         
           // insert into t_checklist_dtls
           $checklistData = [];
           if(isset($_POST['checklist_id'])){
               foreach($request->checklist_id as $key => $value){
               $checklistData[] = [
                            'tourist_standard_id' =>  $id,
                            'checklist_id'   => $request->checklist_id[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                   ];
                }
               $this->services->insertDetails('t_checklist_dtls',$checklistData);
           }
           
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
    });
    return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

    }else{
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }
}
