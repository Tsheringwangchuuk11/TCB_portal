<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;
use App\Models\TaskDetails;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\EndUserNotification;

class TentedAccommodationController extends Controller
{
    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;
        
        //Tented Accommodation assesment Details
        if($serviceId==3){
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['roomTypeLists'] = Dropdown::getDropdownList("1");
        $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["26","27"]);        
        $data['roomInfos']=Services::getRoomDetails($applicationNo);
        $data['staffInfos']=Services::getStaffDetails($applicationNo);
        $starCategoryId=Services::getApplicantDetails($applicationNo)->star_category_id;

            if($status==9 || $status==10){
                // page redirect to application resubmit and draft
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($starCategoryId){
                    $q->with(['checkListStandards'=> function($query) use($starCategoryId){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId)
                            ->where('t_check_list_standard_mappings.is_active','=','1');
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $data['checklistrecords']=Services::getCheckedRecord($applicationNo);
                $data['checklistrec']=Services::getCheckedRecord($applicationNo)->pluck('checklist_id')->toArray();
                return view('services.resubmit_application.resubmit_tented_accomm_assessment',$data,compact('status'));
            }else{
                // page redirect to application approve
                $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo,$starCategoryId){
                    $q->with(['checkListStandards'=> function($query) use($applicationNo,$starCategoryId){
                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                            ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                            ->where('t_checklist_applications.application_no','=',$applicationNo)
                            ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId);
                    }]);
                }])->where('module_id','=',$moduleId)
                ->get();
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_tented_accommodation_assessment',$data,compact('status'));
            }
        }

        //Name change Ownership change Cancllation for Tented Accommodation
        else if($serviceId==6){
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["28","29","30"]);
            if($status==9){
                 // page redirect to resubmit application
                return view('services.resubmit_application.resubmit_name_ownership_cancellation_for_tented_accom',$data,compact('status'));
            }else{
                 // page redirect to application approve
                 $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_name_ownership_cancellation_for_tented_accom',$data,compact('status'));
            }
        }
    }

  //Approval function tented accommodation assessment application
   public function tentedAccommAssessmentApplication(Request $request,Services $service){
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
                 'contact_no'   => $request->contact_no,
                 'manager_name'   => $request->manager_name,
                 'manager_mobile_no'   => $request->manager_mobile_no,
                 'fax'   => $request->fax,
                 'email'   => $request->email,
                 'webpage_url'   => $request->webpage_url,
                 'bed_no'   => $request->bed_no,
                 'village_id'   => $request->village_id,
                 'inspection_date'   =>date('Y-m-d', strtotime($request->inspection_date)),
                 'validaty_date'   =>now()->addYears(3),
                 'created_at'   => now(),
                 'updated_at'   => now(),
             ];
         $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);
         // insert into t_room_dtls
         $roomInfoData = [];
         if(isset($_POST['room_type_id'])){
             foreach($request->room_type_id as $key => $value){
             $roomInfoData[] = [
                          'tourist_standard_id' =>  $id,
                          'room_type_id'   => $request->room_type_id[$key],
                          'room_no'   => $request->room_no[$key],
                          'created_at'   => now(),
                          'updated_at'   => now(),
                 ];
              }
             $service->insertDetails('t_room_dtls',$roomInfoData);
         }
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
                             'ratingpoint'   => $request->ratingpoint[$key],
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

     }
     elseif($request->status =='RESUBMIT'){
         $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
         $completedId= WorkFlowDetails::getStatus('COMPLETED');
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
         ->update(['status_id' => $resubmitdId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

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

     //Approval function for tented accommodation name,ownership change and cancellation application
     public function tentedAccommodationNameOwnershipCancellationApplication(Request $request){
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
                'updated_at'   => now(),
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
              'email' => $request->new_email,
              'updated_at'   => now(),
           );
           $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
            }

            // hotel license cancellation
              if($request->application_type_id=="30"){
                $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
                $data = array(
                  'is_active' => 'N',
                  'updated_at'   => now(),
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
