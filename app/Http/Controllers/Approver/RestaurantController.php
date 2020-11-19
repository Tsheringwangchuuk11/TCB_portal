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

class RestaurantController extends Controller
{
    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;

        if($serviceId==9){
            //Restuarant Checklist Details
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['staffInfos']=Services::getStaffDetails($applicationNo);
                if($status==9){
                    $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q){
                        $q->with(['checkListStandards'=> function($query){
                            $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->where('t_check_list_standard_mappings.is_active','=','1');
                        }]);
                        }])->where('module_id','=',$moduleId)
                        ->get();
                    $data['checklistrecords']=Services::getCheckedRecord($applicationNo);
                    $data['checklistrec']=Services::getCheckedRecord($applicationNo)->pluck('checklist_id')->toArray();   
                    return view('services.resubmit_application.resubmit_restaurant_assessment',$data,compact('status'));
                }
                else{
                    $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo){
                        $q->with(['checkListStandards'=> function($query) use($applicationNo){
                            $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                                ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                                ->where('t_checklist_applications.application_no','=',$applicationNo);
                        }]);
                    }])->where('module_id','=',$moduleId)
                    ->get();
                    $status= WorkFlowDetails::getStatus('APPROVED')->id;
                    return view('services.approve_application.approve_restaurant_assessment',$data,compact('status'));
                }
        }

        elseif($serviceId==10){
            //Restuarant name ownership change Details
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["28","29"]);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
            return view('services.resubmit_application.resubmit_restaurant_name_ownership_change',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_restuarant_name_ownership_change',$data,compact('status'));
            }
        }    
    }

    //Approval function for tourist stnadard restaurant assessment application
    public function restaurantAssessmentApplication(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();

        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
            // insert into t_techt_tourist_standard_dtlsnical_clearances
            \DB::transaction(function () use ($request,$service,$roleId) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
                $applicantdata[]= [    
                    'module_id'   => $request->module_id,
                    'cid_no'   => $request->cid_no,
                    'license_no'   => $request->license_no,
                    'license_date'   => date('Y-m-d', strtotime($request->license_date)),
                    'tourist_standard_name'   => $request->tourist_standard_name,
                    'owner_name'   => $request->owner_name,
                    'address'   => $request->address,
                    'contact_no'   => $request->contact_no,
                    'fax'   => $request->fax,
                    'email'   => $request->email,
                    'webpage_url'   => $request->webpage_url,
                    'village_id'   => $request->village_id,
                    'inspection_date'   =>date('Y-m-d', strtotime($request->inspection_date)),
                    'validaty_date'   =>now()->addYears(3),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);

            // insert into t_staff_dtls
            $staffInfoData = [];
            if(isset($_POST['staff_cid_no'])){
                foreach($request->staff_cid_no as $key => $value){
                $staffInfoData[] = [
                            'tourist_standard_id' =>  $id,
                            'staff_cid_no'   => $request->staff_cid_no[$key],
                            'staff_name'   => $request->staff_name[$key],
                            'staff_gender'   => $request->staff_gender[$key],
                            'designation'   => $request->designation[$key],
                            'qualification'   => $request->qualification[$key],
                            'experience'   => $request->experience[$key],
                            'salary'   => $request->salary[$key],
                            'hospitility_relating'   => $request->hospitility_relating[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                    ];
                }
                $service->insertDetails('t_staff_dtls',$staffInfoData);
            }

            // insert into t_checklist_dtls
            $checklistData = [];
            if(isset($_POST['checklist_id'])){
                foreach($request->checklist_id as $key => $value){
                $checklistData[] = [
                            'tourist_standard_id' =>  $id,
                            'checklist_id'   => $request->checklist_id[$key],
                            'checklist_pts'   => $request->checklist_pts[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                    ];
                }
                $service->insertDetails('t_checklist_dtls',$checklistData);
            }

            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) //Sending mail to trainer
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
                Notification::route('mail', $request->email) //Sending mail to trainer
                ->notify((new EndUserNotification($request->email, $request->owner_name, $$request->application_no, 'Resubmit',$request->service_name))->delay($when));
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
                Notification::route('mail', $request->email) //Sending mail to trainer
                ->notify((new EndUserNotification($request->email, $request->owner_name, $$request->application_no, 'Rejected',$request->service_name))->delay($when));
            }
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }
        }

    //Approval function for tourist standard restaurant name and ownership change application
    public function restaurantNameAndOwnershipChangeApplication(Request $request){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
           \DB::transaction(function () use ($request,$roleId) {
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
              
            // hotel name change
            if($request->application_type_id=="28"){
                $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
              $data = array(
                'tourist_standard_name' => $request->tourist_standard_name,
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
            }

            // hotel ownership change
            if($request->application_type_id=="29"){
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
            $data = array(
              'owner_name' => $request->new_owner_name,
              'cid_no' => $request->new_cid_no,
              'address' => $request->new_address, 
              'contact_no' => $request->new_contact_no,
              'email' => $request->new_email
           );
           $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
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
                Notification::route('mail', $request->email) //Sending mail to trainer
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
            Notification::route('mail', $request->email) //Sending mail to trainer
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
            Notification::route('mail', $request->email) //Sending mail to trainer
            ->notify((new EndUserNotification($request->email, $request->owner_name, $request->application_no, 'Reject',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }
       
}
