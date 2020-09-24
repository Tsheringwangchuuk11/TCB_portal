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
        $data['purposes'] =Dropdown::getDropdownList("6");
        $data['accommodationtypes'] =Dropdown::getDropdownList("7");
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        return view('services.approve_application.approve_technical_clearance',$data);
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
        if($serviceId==4){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            return view('services.approve_application.approve_recommendation_letter_for_import_license',$data);
            }

        //Recommendation letter for work permit
        if($serviceId==5){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            return view('services.approve_application.approve_work_permit',$data);
            }

        //Tourism standard hotel license renew Details   
        elseif($serviceId==7){
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approve_application.approve_hotel_license_renew',$data);
        }

        //Tourism standard hotel license cancel Details
        elseif($serviceId==8){
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approve_application.approve_hotels_license_cancel',$data);
        }
            
        //Tourism standard hotel ownership change Details
        elseif($serviceId==9){
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approve_application.approve_hotel_ownership_change',$data);
        }

        //Tourism standard hotel name change Details
        elseif($serviceId==10){
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approve_application.approve_hotel_name_change',$data);
        }
    }

     //Approval function for technical clearance application
     public function hotelTechnicalClearanceApplication(Request $request,Services $service){
         dd($request->all());
        $assigned_priv_id=WorkFlowDetails::getAssignedRoleForApp($request->service_id)->role_id;
        if($request->status =='APPROVED'){
           // insert into t_technical_clearances
           \DB::transaction(function () use ($request,$assigned_priv_id,$service) {
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
               $lastsequence=substr($request->application_no,7);
               $divisioncode=Services::getDivisonCode($serviceId)->code;
               $tcb="TCB";
               $dispatchNo=$tcb.'/'.$divisioncode.date("Y.m.d").$lastsequence;
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

            // save new technicalclearance details
            elseif($request->purpose_id=="23"){
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->cid_no);
                $data = array(
                  'dispatch_no'   => $dispatchNo,
                  'application_no'   => $request->application_no,
                  'purpose_id'   => $request->purpose_id,
                  'tentative_com'   => DATE('Y-m-d', strtotime($request->tentative_com)),
                );
                $updatedata=Services::updateApplicantDtls('t_technical_clearances','cid_no',$request->cid_no,$data);

            }

            // save ownership change technicalclearance details
            elseif($request->purpose_id=="24"){
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->cid_no);
                $data = array(
                 'dispatch_no'   => $dispatchNo,
                 'application_no'   => $request->application_no,
                 'purpose_id'   => $request->purpose_id,
                 'name'   => $request->name,
                 );
                 $updatedata=Services::updateApplicantDtls('t_technical_clearances','cid_no',$request->cid_no,$data);
                }

            // save desigm change technicalclearance details
            else{
                $savedatatoaudit=Services::saveTechnicalClearanceDtlsAudit($request->cid_no);
                $data = array(
                 'dispatch_no'   => $dispatchNo,
                 'application_no'   => $request->application_no,
                 'purpose_id'   => $request->purpose_id,
                );
                $updatedata=Services::updateApplicantDtls('t_technical_clearances','cid_no',$request->cid_no,$data);
            }

            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $assigned_priv_id,'remarks' => $request->remarks]);

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
        ->update(['status_id' => $resubmitdId->id,'role_id'=>$assigned_priv_id,'remarks' => $request->remarks]);

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
        ->update(['status_id' => $rejectId->id,'role_id'=>$assigned_priv_id,'remarks' => $request->remarks]);

        $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
        $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                ->update(['status_id' => $completedId->id]);
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }
    
   //Approval function for tourist stnadard hotel assessment application
   public function standardHotelAssessmentApplication(Request $request,Services $service){
       $assigned_priv_id=WorkFlowDetails::getAssignedRoleForApp($request->service_id)->role_id;
        if($request->status =='APPROVED'){
            // insert into t_techt_tourist_standard_dtlsnical_clearances
            \DB::transaction(function () use ($request,$service,$assigned_priv_id) {
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
                    ->update(['status_id' => $approveId->id,'role_id'=> $assigned_priv_id,'remarks' => $request->remarks]);

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
            ->update(['status_id' => $resubmitdId->id,'role_id'=>$assigned_priv_id,'remarks' => $request->remarks]);

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
            ->update(['status_id' => $rejectId->id,'role_id'=>$assigned_priv_id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }
        }

     //Approval function for tourist standard hotel licexnse renew application
     public function hotelLicenseRenewApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'validaty_date'=>date('Y-m-d',strtotime($request->validaty_date .'+3 years'))


             );
            $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
           
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
   
    //Approval function for tourist standard hotel owner change application
     public function hotelOwnerShipChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'owner_name' => $request->owner_name,
                'cid_no' => $request->cid_no,
                'address' => $request->address, 
                'contact_no' => $request->contact_no,
				'email' => $request->email
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
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

     //Approval function for tourist standard hotel name change application
     public function hotelNameChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'tourist_standard_name' => $request->tourist_standard_name,
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);

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

      //Approval function for tourist standard hotel license Cancel application
      public function hotelLicenseCancelApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'is_active' => 'N',
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);

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
