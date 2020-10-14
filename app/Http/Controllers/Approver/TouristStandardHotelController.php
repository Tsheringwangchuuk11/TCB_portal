<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;
use App\Models\TaskDetails;

class TouristStandardHotelController extends Controller
{
    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;
        $starCategoryId= $data['applicantInfo']->star_category_id;
        $data['countries'] = Dropdown::getDropdownList("3");
        
        //Technical clearance Details for hotel
        if($serviceId==1){
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['purposes'] =Dropdown::getDropdownList("6");
        $data['accommodationtypes'] =Dropdown::getDropdownList("7");
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
                // page redirect to application resubmit
                return view('services.resubmit_application.resubmit_technical_clearance',$data,compact('status'));
            }else{
                // page redirect to application approve
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_technical_clearance',$data,compact('status'));

            }
        }

        //Tourism standard hotel assesment Details
        elseif($serviceId==3){
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
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
                return view('services.resubmit_application.resubmit_hotels_assessment',$data,compact('status'));
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
                return view('services.approve_application.approve_hotels_assessment',$data,compact('status'));
            }
        }
                    
        //Recommendation letter for import license
        else if($serviceId==4){
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
                if($status==9){
                    // page redirect to resubmit application
                    return view('services.resubmit_application.resubmit_hotel_recommendation_letter_for_import_license',$data,compact('status'));
                }else{
                    // page redirect to application approve
                    $status= WorkFlowDetails::getStatus('APPROVED')->id;
                    return view('services.approve_application.approve_hotel_recommendation_letter_for_import_license',$data,compact('status'));
            }
        }

        //Recommendation letter for work permit
        else if($serviceId==5){
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['countries'] = Dropdown::getDropdownList("3");
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['workpermitTypes'] = Dropdown::getDropdownList("11");
            $data['workerdtls'] = Services::getForeignWorkerDtls($applicationNo);

            if($status==9){
                // page redirect to resubmit application
                return view('services.resubmit_application.resubmit_work_permit',$data,compact('status'));
            }else{
                // page redirect to application approve
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_work_permit',$data,compact('status'));
             }
        }

        //Tourism standard hotel license renew Details   
        else if($serviceId==6){
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["28","29","30"]);
            if($status==9){
                 // page redirect to resubmit application
                return view('services.resubmit_application.resubmit_name_ownership_cancellation_for_hotel',$data,compact('status'));
            }else{
                 // page redirect to application approve
                 $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_name_ownership_cancellation_for_hotel',$data,compact('status'));
            }
        }
    }

     //Approval function for technical clearance application
     public function hotelTechnicalClearanceApplication(Request $request,Services $service){
        // dd($request->all());
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
           // insert into t_technical_clearances
           \DB::transaction(function () use ($request,$roleId,$service) {
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
               $lastsequence=substr($request->application_no,7);
               $divisioncode=Services::getDivisonCode($request->service_id)->code;
               $tcb="TCB";
               $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
            // save new technical clearance details
            if($request->purpose_id=="20"){
                $data[]= [            
                    'dispatch_no'   => $dispatchNo,
                    'application_no'   => $request->application_no,
                    'purpose_id'   => $request->purpose_id,
                    'cid_no'   => $request->cid_no,
                    'name'   => $request->name,
                    'contact_no'   => $request->contact_no,
                    'village_id'   => $request->village_id,
                    'accomodation_type_id'   => $request->accomodation_type_id,
                    'proposed_rooms_no'   => $request->proposed_rooms_no,
                    'tentative_cons'   => DATE('Y-m-d', strtotime($request->tentative_cons)),
                    'tentative_com'   => DATE('Y-m-d', strtotime($request->tentative_com)),
                    'drawing_date'   => DATE('Y-m-d', strtotime($request->drawing_date)),
                    'validaty_date'   =>now()->addYears(2),
                    'email'   => $request->email,
                    'submitted_by'   => $request->applicant_id,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
                $service->insertDetails('t_technical_clearances',$data);
            }

            // save renew technicalclearance details
            if($request->purpose_id=="21"){
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->dispatch_no);
                $data = array(
                  'dispatch_no'   => $dispatchNo,
                  'application_no'   => $request->application_no,
                  'purpose_id'   => $request->purpose_id,
                  'validaty_date'   =>now()->addYears(2),
                  'updated_at'   => now(),
                );
                $updatedata=Services::updateApplicantDtls('t_technical_clearances','dispatch_no',$request->dispatch_no,$data);
            }

            // save design change technicalclearance details
              if($request->purpose_id=="22"){
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->dispatch_no);
                $data = array(
                  'dispatch_no'   => $dispatchNo,
                  'application_no'   => $request->application_no,
                  'purpose_id'   => $request->purpose_id,
                  'updated_at'   => now(),
                );
                $updatedata=Services::updateApplicantDtls('t_technical_clearances','dispatch_no',$request->dispatch_no,$data);
            }
            // save ownership change technicalclearance details
            if($request->purpose_id=="23"){
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->dispatch_no);
                $data = array(
                 'dispatch_no'   => $dispatchNo,
                 'application_no'   => $request->application_no,
                 'purpose_id'   => $request->purpose_id,
                 'name'   => $request->name,
                 'updated_at'   => now(),
                 );
                 $updatedata=Services::updateApplicantDtls('t_technical_clearances','dispatch_no',$request->dispatch_no,$data);
                }
            //update application_no in t_documents
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
       });
       return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
       }
       elseif($request->status =='RESUBMIT'){
        $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
        $completedId= WorkFlowDetails::getStatus('COMPLETED');
        $documentId = $request->documentId;
        $service->updateDocumentDetails($documentId,$request->application_no);
        $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
        $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
        ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
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
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }
    
   //Approval function for tourist stnadard hotel assessment application
   public function standardHotelAssessmentApplication(Request $request,Services $service){
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
                    'star_category_id'   => $request->star_category_id,
                    'license_no'   => $request->license_no,
                    'license_date'   => date('Y-m-d', strtotime($request->license_date)),
                    'tourist_standard_name'   => $request->tourist_standard_name,
                    'owner_name'   => $request->owner_name,
                    'address'   => $request->address,
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
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }
        }

     //Approval function for tourist standard name,ownership change and cancellation application
     public function hotelNameOwnershipCancellationApplication(Request $request){
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
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }

     }   

     public function importLicenseApplication(Request $request){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
            
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
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
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');

     }
    }

    // work permit application
    public function workPermitApplication(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
         if($request->status =='APPROVED'){
             // insert into t_operator_clearances
             \DB::transaction(function () use ($request,$service,$roleId) {
                 $approveId = WorkFlowDetails::getStatus('APPROVED');
                 $completedId= WorkFlowDetails::getStatus('COMPLETED');
                 $lastsequence=substr($request->application_no,7);
               $divisioncode=Services::getDivisonCode($request->service_id)->code;
               $tcb="TCB";
               $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
               if($request->application_type_id==38){
                $data[]= [    
                    'application_type_id'   => $request->application_type_id,
                    'license_no'   => $request->license_no,
                    'company_name'   => $request->company_name,
                    'cid_no'   => $request->cid_no,
                    'email'   => $request->email,
                    'total_worker'   => $request->total_worker,
                    'country_id'   => $request->country_id,
                    'from_date'   =>date('Y-m-d', strtotime($request->from_date)),
                    'to_date'   =>date('Y-m-d', strtotime($request->to_date)),
                    'village_id'   => $request->village_id,
                    'dispatch_no'   =>$dispatchNo,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
                 $id=Services::getLastInsertedId('t_work_permit_dtls',$data);
                }
                else if($request->application_type_id==39){
                 $data[]= [    
                    'application_type_id'   => $request->application_type_id,
                    'license_no'   => $request->license_no,
                    'company_name'   => $request->company_name,
                    'cid_no'   => $request->cid_no,
                    'email'   => $request->email,
                    'village_id'   => $request->village_id,
                    'dispatch_no'   =>$dispatchNo,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
                $id=Services::getLastInsertedId('t_work_permit_dtls',$data);
                //insert into t_foreign worker dtls
                $workerdtls = [];
                if(isset($_POST['passport_no'])){
                        foreach($request->passport_no as $key => $value)
                        {
                            $workerdtls[] = [
                            'work_permit_id' =>  $id,
                            'passport_no'  => $request->passport_no[$key],
                            'name'  => $request->name[$key],
                            'start_date'  => date('Y-m-d', strtotime($request->start_date[$key])),
                            'end_date'  =>  date('Y-m-d', strtotime($request->end_date[$key])),
                            'nationality'  => $request->nationality[$key],
                            'created_at'  => now(),
                            'updated_at'  => now(),
                            ];
                        }
                        $service->insertDetails('t_foreign_worker_dtls',$workerdtls);
                    }
                }
                else if($request->application_type_id==40){
                    $savedatatoaudit=Services::saveWorkPermitDtlsAudit($request->dispatch_no);
                    $data = array(
                    'dispatch_no' => $dispatchNo,
                    'total_worker'   => $request->total_worker,
                    'from_date'   => $request->from_date,
                    'to_date'   => $request->to_date,
                    'updated_at'  => now(),
                     );
                     $updatedata=Services::updateApplicantDtls('t_work_permit_dtls','dispatch_no',$request->dispatch_no,$data);
                }else{
                    $savedatatoaudit=Services::saveWorkPermitDtlsAudit($request->dispatch_no);
                    $data = array(
                    'dispatch_no' => $dispatchNo,
                    'updated_at'  => now(),
                     );
                     $updatedata=Services::updateApplicantDtls('t_work_permit_dtls','dispatch_no',$request->dispatch_no,$data);
                     if(isset($_POST['passport_no'])){
                        foreach($request->passport_no as $key => $value)
                        {

                            $savedatatoaudit=Services::saveForeignWorkerDtlsAudit($request->passport_no[$key]);
                            $workerdtls = [
                            'start_date'  => date('Y-m-d', strtotime($request->start_date[$key])),
                            'end_date'  =>  date('Y-m-d', strtotime($request->end_date[$key])),
                            'updated_at'  => now(),
                            ];
                        $satus=Services::updateOrSaveDetails('t_foreign_worker_dtls',$workerdtls, ['passport_no'=>$request->passport_no[$key]] );
                        }
                    }
                }

             $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
             $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                     ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
    
             $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
             $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['status_id' => $completedId->id]); 
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
             return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
             }
    }
   
}
