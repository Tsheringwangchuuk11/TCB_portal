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
use PDF;
class TourOperatorController extends Controller
{
    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;

        if($serviceId==2){
            //Tour operator recommendation letter for new license
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['partnerInfo']=Services::getPartnerInfoDetails($applicationNo);
            if($status==9){ 
                    return view('services.resubmit_application.resubmit_to_new_license_clearance',$data,compact('status'));
                }
                else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_to_new_license_clearance',$data,compact('status'));
            }
        }
        else if($serviceId==4){
            //Tour operator recommendation letter for import license
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            if($status==9){ 
                    return view('services.resubmit_application.resubmit_to_recommendation_letter_for_import_license',$data,compact('status'));
                }
                else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_to_recommendation_letter_for_import_license',$data,compact('status'));
            }
        }
        else if($serviceId==9){
            //Tour operator Assessment Details
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q){
                $q->with(['checkListStandards'=> function($query){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->where('t_check_list_standard_mappings.is_active','=','1');
                }]);
                }])->where('module_id','=',$moduleId)
                ->get();
            $data['checklistrecords']=Services::getCheckedRecord($applicationNo);
            $data['checklistrec']=Services::getCheckedRecord($applicationNo)->pluck('checklist_id')->toArray();

            if($status==9){ 
                    return view('services.resubmit_application.resubmit_to_assessment',$data,compact('status'));
                }
                else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_to_assessment',$data,compact('status'));
            }
        }
        elseif($serviceId==11){
            //Tour Operator Owner name location Change Details
            $data['applicantInfo']=Services::getTONameOwnerLocationChangeDetails($applicationNo);
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["28","29","31"]);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            if($status==9){ 
                return view('services.resubmit_application.resubmit_to_name_ownership_location_change',$data,compact('status'));
            }
            else{
            $status= WorkFlowDetails::getStatus('APPROVED')->id;
            return view('services.approve_application.approve_to_name_ownership_location_change',$data,compact('status'));
           }
        }

        elseif($serviceId==12){
            //Tour propriater card Details
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            if($status==9){ 
                return view('services.resubmit_application.resubmit_propreiter_card',$data,compact('status'));
            }
            else{
            $status= WorkFlowDetails::getStatus('APPROVED')->id;
            return view('services.approve_application.approve_propreiter_card',$data,compact('status'));
           }
        }
        elseif($serviceId==13){
            //Recommendation letter for tourism industry partner
            $data['applicationTypes'] = Dropdown::getApplicationType("9",$dropdownId[]=["32","33"]);
            $data['eventFairDetails'] = Services::getTravelEventFairDetails();
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['partnerInfo']=Services::getTourismIndustryPartnerDtls($applicationNo);
            if($status==9){ 
                return view('services.resubmit_application.resubmit_recommandation_letter_for_tourism_industry_partner',$data,compact('status'));
            }
            else{
            $status= WorkFlowDetails::getStatus('APPROVED')->id;
            return view('services.approve_application.approve_recommandation_letter_for_tourism_industry_partner',$data,compact('status'));
           }
        }
        elseif($serviceId==14){
            //Tour Operator License Renew Details
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            if($status==9){ 
                return view('services.resubmit_application.resubmit_to_license_renew_clearance',$data,compact('status'));
            }
            else{
            $status= WorkFlowDetails::getStatus('APPROVED')->id;
            return view('services.approve_application.approve_to_license_renew_clearance',$data,compact('status'));
           }
        }
    }

     //Approval function for tour operator technical clearance application
     public function tourOperatorTechnicalClearanceApplication(Request $request,Services $service){
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
                 $data[]= [ 
                    'application_type_id'   => $request->application_type_id, 
                    'application_no'=> $request->application_no,  
                    'cid_no'   => $request->cid_no,
                    'name'   => $request->name,
                    'gender'   => $request->gender,
                    'dob'   => $service->setDateAttribute($request->dob),
                    'applicant_location'   => $request->applicant_location,
                    'email'   => $request->email,
                    'company_name'   => $request->company_name,
                    'company_name_one'   => $request->company_name_one,
                    'company_name_two'   => $request->company_name_two,
                    'village_id'   => $request->village_id,
                    'postal_address'   => $request->postal_address,
                    'contact_no'   => $request->contact_no,
                    'reference_no'   => $request->reference_no,
                    'validity_date'   =>now()->addMonths(1),
                    'remarks'   => $request->remarks,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
             $id=Services::getLastInsertedId('t_operator_clearances',$data);
                // insert into t_partner_dtls
                if(isset($_POST['partner_cid_no'])){
                $partnerData[]= [ 
                    'operator_id' =>  $id,
                    'partner_name'   => $request->partner_name,
                    'partner_cid_no'   => $request->partner_cid_no,
                    'partner_gender'   => $request->partner_gender,
                    'partner_email'   => $request->partner_email,
                    'partner_dob'   => $service->setDateAttribute($request->partner_dob),
                    'village_id'   => $request->village_id,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]; 
            $service->insertDetails('t_partner_dtls',$partnerData); 
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
            }
             return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
             }
   }

    //Approval function for tour operator assessment application
    public function tourOperatorAssessmentApplication(Request $request,Services $service){
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
                    'service_id'   => $request->service_id,
                    'application_no'   => $request->application_no,
                    'cid_no'   => $request->cid_no,
                    'license_no'   => $request->license_no,
                    'license_date'   =>$service->setDateAttribute($request->license_date),
                    'tourist_standard_name'   => $request->tourist_standard_name,
                    'owner_name'   => $request->owner_name,
                    'contact_no'   => $request->contact_no,
                    'email'   => $request->email,
                    'webpage_url'   => $request->webpage_url,
                    'village_id'   => $request->village_id,
                    'inspection_date'   =>$service->setDateAttribute($request->inspection_date),
                    'validaty_date'   =>now()->addYears(3),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
                $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);
                // insert into t_checklist_dtls
                $tocheckdata = [];
                if(isset($_POST['area'])){
                    foreach($request->area as $key => $value){
                    $index = $_POST['area'][$key];
                    $tocheckdata[] = [
                        'tourist_standard_id' =>  $id,
                        'checklist_id'   =>$_POST['check'.$index],
                        ];
                     }
                    $service->insertDetails('t_checklist_dtls',$tocheckdata);
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

    public function proprieterCardApplication(Request $request){
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
                 $data[]= [    
                    'name'   => $request->name,
                    'validity_date'   => date('Y-m-d', strtotime($request->validity_date)),
                    'license_no'   => $request->license_no,
                    'email'   => $request->email,
                    'company_name'   => $request->company_name,
                    'location'   => $request->location,
                    'contact_no'   => $request->contact_no,
                    'verified_by'   => auth()->user()->id,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                    ];
              $id=Services::getLastInsertedId('t_proprietor_card_dtls',$data);
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
            }
             return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
             }
        }

    //Approval function for tour operator name location owner change application
    public function tourOperatorOwnerNameLocationChangeApplication(Request $request){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
           \DB::transaction(function () use ($request,$roleId) {
               $approveId = WorkFlowDetails::getStatus('APPROVED');
               $completedId= WorkFlowDetails::getStatus('COMPLETED');
               $printedId=WorkFlowDetails::getStatus('PRINTED');

            // Tour oprator name change
            if($request->application_type_id=="28"){
                $old_application_no= Services::getDataForUpdateOrEdit('t_tourist_standard_dtls','dispatch_no',$request->dispatch_no)->application_no;
                if($old_application_no){
                    $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($old_application_no);
                    $updateworkflow=WorkFlowDetails::where('application_no', $old_application_no)
                        ->update(['status_id' => $printedId->id,'remarks' => "PRINTED"]);
                }
                $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
                $lastsequence=substr($request->application_no,7);
                $divisioncode=Services::getDivisonCode($request->service_id)->code;
                $tcb="TCB";
                $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
              $data = array(
                'application_no' => $request->application_no,
                'tourist_standard_name' => $request->tourist_standard_name,
                'application_type_id' => $request->application_type_id,
                'dispatch_no'=>  $dispatchNo
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
            }

            // tour operator ownership change
            if($request->application_type_id=="29"){
            $old_application_no= Services::getDataForUpdateOrEdit('t_tourist_standard_dtls','dispatch_no',$request->dispatch_no)->application_no;
            if($old_application_no){
                $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($old_application_no);
                $updateworkflow=WorkFlowDetails::where('application_no', $old_application_no)
                    ->update(['status_id' => $printedId->id,'remarks' => "PRINTED"]);
            }
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
            $lastsequence=substr($request->application_no,7);
            $divisioncode=Services::getDivisonCode($request->service_id)->code;
            $tcb="TCB";
            $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
            $data = array(
              'application_no' => $request->application_no,
              'owner_name' => $request->new_owner_name,
              'cid_no' => $request->new_cid_no,
              'address' => $request->new_address, 
              'contact_no' => $request->new_contact_no,
              'application_type_id' => $request->application_type_id,
              'email' => $request->new_email,
              'dispatch_no'=>  $dispatchNo

           );
           $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
            }

            // tour operator office location change
              if($request->application_type_id=="31"){
                $old_application_no= Services::getDataForUpdateOrEdit('t_tourist_standard_dtls','dispatch_no',$request->dispatch_no)->application_no;
                if($old_application_no){
                    $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($old_application_no);
                    $updateworkflow=WorkFlowDetails::where('application_no', $old_application_no)
                        ->update(['status_id' => $printedId->id,'remarks' => "PRINTED"]);
                }
                $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);
                $lastsequence=substr($request->application_no,7);
                $divisioncode=Services::getDivisonCode($request->service_id)->code;
                $tcb="TCB";
                $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
                $data = array(
                    'application_no' => $request->application_no,
                    'village_id' => $request->new_village_id,
                    'application_type_id' => $request->application_type_id,
                    'dispatch_no'=>  $dispatchNo
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

     public function recommendationLetterImportLicense(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request,$service,$roleId) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
                $lastsequence=substr($request->application_no,7);
                $divisioncode=Services::getDivisonCode($request->service_id)->code;
                $tcb="TCB";
                $dispatchNo=$tcb.'-'.$divisioncode.date("Y.m.d").$lastsequence;
                $applicantdata[]= [  
                 'application_no'   => $request->application_no,  
                 'cid_no'   => $request->cid_no,
                 'license_no'   => $request->license_no,
                 'license_date'   => $service->setDateAttribute($request->license_date),
                 'owner_name'   => $request->owner_name,
                 'company_name'   => $request->company_name,
                 'contact_no'   => $request->contact_no,
                 'email'   => $request->email,
                 'village_id'   => $request->village_id,
                 'dispatch_no'=>$dispatchNo
                 ];
                Services::getLastInsertedId('t_import_license_dtls',$applicantdata);
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
     //Approval function for tour operator license renew clearance
      public function tourOperatorLicenseRenewClearance(Request $request,Services $service){
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
                 $savedatatoaudit=Services::saveTourOperatorClearancesDtlsAudit($request->license_no);
                 $data= [  
                    'application_no'   => $request->application_no,  
                    'name'   => $request->name,
                    'cid_no'   => $request->cid_no,
                    'email'   => $request->email,
                    'company_name'   => $request->company_name,
                    'village_id'   => $request->village_id,
                    'contact_no'   => $request->contact_no,
                    'remarks'   => $request->remarks,
                    'application_type_id'   => $request->application_type_id,
                    'validity_date'   =>now()->addMonths(1),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                    ];
             $satus=Services::updateOrSaveDetails('t_operator_clearances',$data, ['license_no'=>$request->license_no]);
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
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
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
            }
             return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
             }

     }   

      //Rec letter for tourism industry partner
      public function tourismIndustryPartner(Request $request){
    
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
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
            }
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
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
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
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');

        }
     } 
     
     
        public function getAppListForRecoomendationLetter(){
            $data=Services::getAppListForRecoomendationLetter();
            return view('services.lettersample.applicant_list_for_recommendation_letter',compact('data'));
        }

        public function viewRecoomendationLetter($applicationNo){
            $data=Services::printRecoomendationLetter($applicationNo);
            return view('services.lettersample.lettersample',compact('data'));
        }

        public function printRecoomendationLetter($applicationNo){
            $data=Services::printRecoomendationLetter($applicationNo);
            $pdf = PDF::loadView('services.lettersample.printlettersample',compact('data'));
            return $pdf->stream('Recommendation Letter-'.str_random(4).'.pdf');
        }

        public function updatePrintStatus($applicationNo){
            $printStatusId = WorkFlowDetails::getStatus('PRINTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($applicationNo);
            $updateworkflow=WorkFlowDetails::where('application_no',$applicationNo)
            ->update(['status_id' => $printStatusId->id]);
            return redirect('verification/recommendation-letter')->with('msg_success', 'Application status updated successfully');
        }
}
