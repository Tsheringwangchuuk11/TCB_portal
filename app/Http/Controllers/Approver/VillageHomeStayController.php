<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
use App\Models\TCheckListChapter;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\EndUserNotification;
class VillageHomeStayController extends Controller
{

    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;

        if($serviceId==7){
        //Village Home stay Checklist Details
        $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["26","27"]);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['relationTypes'] =  Dropdown::getDropdownList("4");
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['membersDetls']=Services::getMembersDetails($applicationNo);

            if($status==9){
                // page redirect to application resubmit and draft
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q){
                    $q->with(['checkListStandards'=> function($query){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->where('t_check_list_standard_mappings.is_active','=','1');
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $data['checklistrecords']=Services::getCheckedRecord($applicationNo);
                $data['checklistrec']=Services::getCheckedRecord($applicationNo)->pluck('checklist_id')->toArray();
                return view('services.resubmit_application.resubmit_home_stay_assessment',$data,compact('status'));
            }else{
                // page redirect to application approve
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo){
                    $q->with(['checkListStandards'=> function($query) use($applicationNo){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                            ->where('t_checklist_applications.application_no','=',$applicationNo);
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_home_stays_assessment',$data,compact('status'));
            }
        }

        elseif($serviceId==8){
           $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
           $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
            return view('services.resubmit_application.resubmit_home_stays_license_cancel',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_home_stays_license_cancel',$data,compact('status'));
 
            }
        }

    }

    public function viewApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;

        if($serviceId==7){
        //Village Home stay Checklist Details
        $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["26","27"]);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['relationTypes'] =  Dropdown::getDropdownList("4");
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['membersDetls']=Services::getMembersDetails($applicationNo);

            if($status==9){
                // page redirect to application resubmit and draft
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q){
                    $q->with(['checkListStandards'=> function($query){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->where('t_check_list_standard_mappings.is_active','=','1');
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $data['checklistrecords']=Services::getCheckedRecord($applicationNo);
                $data['checklistrec']=Services::getCheckedRecord($applicationNo)->pluck('checklist_id')->toArray();
                return view('services.resubmit_application.resubmit_home_stay_assessment',$data,compact('status'));
            }else{
                // page redirect to application approve
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo){
                    $q->with(['checkListStandards'=> function($query) use($applicationNo){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                            ->where('t_checklist_applications.application_no','=',$applicationNo);
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('report.application_details.view_home_stays_assessment',$data,compact('status'));
            }
        }

        elseif($serviceId==8){
           $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
           $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
            return view('services.resubmit_application.resubmit_home_stays_license_cancel',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('report.application_details.view_home_stays_license_cancel',$data,compact('status'));
 
            }
        }

    }

     //Approval function for village Home Stay assessment application
   public function villageHomeStayAssessmentApplication(Request $request,Services $service){
       $roles = auth()->user()->roles()->get();

       $roleId = 0;
       foreach ($roles as $role){
           $roleId = $role->id;
       }

    if($request->status =='VERIFIED'){
        $verifiedId = WorkFlowDetails::getStatus('VERIFIED');
        $releaseId= WorkFlowDetails::getStatus('INITIATED');
        $assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id, 2);
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $verifiedId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updateworkflow=TaskDetails::where('application_no',$request->application_no)
            ->update([
                        'status_id' => $releaseId->id,
                        'assigned_priv_id' => $assigned_priv_id->id
                    ]);
        return redirect('tasklist/tasklist')->with('msg_success', 'Application has been verified successfully.');
    } elseif($request->status =='APPROVED'){
        // insert into t_techt_tourist_standard_dtlsnical_clearances
        \DB::transaction(function () use ($request,$service,$roleId) {
            $approveId = WorkFlowDetails::getStatus('APPROVED');
            $completedId= WorkFlowDetails::getStatus('COMPLETED');

        $applicantdata[]= [
            'application_no'   => $request->application_no,  
            'module_id'   => $request->module_id,
            'service_id'   => $request->service_id,
            'application_type_id'   => $request->application_type_id,
            'cid_no'   => $request->cid_no,
            'owner_name'   => $request->owner_name,
            'tourist_standard_name'   => $request->tourist_standard_name,
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

        // insert into member application dtls
        $membersData = [];
        if(isset($_POST['member_name'])){
            foreach($request->member_name as $key => $value){
            $membersData[] = [
                         'tourist_standard_id' =>  $id,
                         'member_name'   => $request->member_name[$key],
                         'relation_type_id'   => $request->relation_type_id[$key],
                         'member_dob'   => $request->member_dob[$key],
                         'member_gender'   => $request->member_gender[$key],
                         'created_at'   => now(),
                         'updated_at'   => now(),
                ];
             }
            $service->insertDetails('t_member_dtls',$membersData);
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
               $service->insertDetails('t_checklist_dtls',$checklistData);
           }

           $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
           $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                   ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

           $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
           $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                   ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Approved',$request->service_name))->delay($when));
        }
    });
    return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

    } elseif($request->status =='RESUBMIT'){
        $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
        $completedId= WorkFlowDetails::getStatus('COMPLETED');
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application resend successfully');
    }
    else{

        $completedId= WorkFlowDetails::getStatus('COMPLETED');
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $rejectId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }

     //Approval function for village Home stays license cancel application
     public function villageHomeStayLicenseCancelApplication(Request $request){

        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
           \DB::transaction(function () use ($request,$roleId) {
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
            // hotel license cancellation
                $savedatatoaudit=Services::saveHomeStayDtlsAudit($request->cid_no);
                $data = array(
                  'is_active' => 'N',
               );
            $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','cid_no',$request->cid_no,$data);
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Approved',$request->service_name))->delay($when));
            }
       });
       return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
       }
       elseif($request->status =='RESUBMIT'){
        $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
        $completedId= WorkFlowDetails::getStatus('COMPLETED');
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application resend successfully');
    }
    else{

        $completedId= WorkFlowDetails::getStatus('COMPLETED');
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $rejectId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
     }
}
