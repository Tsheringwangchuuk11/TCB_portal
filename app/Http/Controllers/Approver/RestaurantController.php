<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
use App\Models\TCheckListChapter;
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

        elseif($serviceId==5){
            //Restuarant bar license Details
            return view('services.approve_application.approve_restaurant_assessment',$data);
        } 
        elseif($serviceId==7){
            //Restuarant bar license renew Details
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            return view('services.approve_application.approve_restuarant_license_renew',$data);
        } 
        elseif($serviceId==8){
            //Restuarant bar license cancel Details
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            return view('services.approve_application.approve_restuarant_license_cancel',$data);
        }

        elseif($serviceId==9){
            //Restuarant owner change Details
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            return view('services.approve_application.approve_restuarant_owner_change',$data);
        }  
        elseif($serviceId==10){
            //Restuarant name change Details
            $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
            return view('services.approve_application.approve_restuarant_name_change',$data);
        }     
    }

    //Approval function for tourist stnadard restaurant assessment application
    public function restaurantAssessmentApplication(Request $request,Services $service){
        $assigned_priv_id=WorkFlowDetails::getAssignedRoleForApp($request->service_id)->role_id;
        if($request->status =='APPROVED'){
            // insert into t_techt_tourist_standard_dtlsnical_clearances
            \DB::transaction(function () use ($request,$service,$assigned_priv_id) {
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

    //Approval function for tourist standard restaurant name change application
    public function restaurantNameChangeApplication(Request $request){
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

       //Approval function for tourist standard restaurant owner change application
       public function restaurantOwnerChangeApplication(Request $request){
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

      //Approval function for tourist standard restaurant license renew application
      public function restaurantLicenseRenewApplication(Request $request){
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

      //Approval function for tourist standard resturant license Cancel application
      public function restaurantLicenseCancelApplication(Request $request){
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
