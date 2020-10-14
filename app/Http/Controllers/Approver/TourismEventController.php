<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
class TourismEventController extends Controller
{
    public function getApplicationDetails($applicationNo){
        $data['applicantInfos']=Services::getApplicantDetailsForTravelFairs($applicationNo);
        //dd($data['applicantInfos']);
        $serviceId= $data['applicantInfos']->service_id;
        $moduleId= $data['applicantInfos']->module_id; 
        if($serviceId==20){
            //Tourism Event Registration
            $data['countries'] =Dropdown::getDropdownList("3");
            $data['companyTypes']=Dropdown::getDropdownList("10");
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            return view('services.approve_application.approve_to_registration_travel_fairs',$data);
        }
     }

     //Approval function for travel fair application
     public function travelFairsApplication(Request $request,Services $service){
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
                 $eventdata[] = [
                    'event_id' =>  $request->event_id,
                    'name'   => $request->name,
                    'cid_no'   => $request->cid_no,
                    'contact_no'   => $request->contact_no,
                    'email'   => $request->email,
                    'company_name'   => $request->company_name,
                    'company_type'   => $request->company_type,
                    'passport_no'   => $request->passport_no,
                    'webpage_url'   => $request->webpage_url,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
             $service->insertDetails('t_travel_fair_dtls',$eventdata);

             $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
             $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                     ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
    
             $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
             $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['status_id' => $completedId->id]); 
         });
         return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
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
