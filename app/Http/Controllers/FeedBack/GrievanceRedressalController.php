<?php

namespace App\Http\Controllers\FeedBack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\TaskDetails;
class GrievanceRedressalController extends Controller
{
    
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    // Open the feedback application
    public function getApplicationDetails($applicationNo,$status=null){
        $status= WorkFlowDetails::getStatus('APPROVED')->id;
        $roles = auth()->user()->roles->pluck('id')->toArray();
        $data['applicantInfo']=Services::getGrievanceDetails($applicationNo);
        $data['documentInfos']=Services::getGrievanceDocumentDetails($applicationNo);
        $data['serviceproviders'] =Dropdown::getDropdownList("5");
        $data['applicantTypes'] =Dropdown::getDropdownList("2");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['emailLists'] = Dropdown::getDropdowns("t_users","id","email","0","0");
        return view('services/feedback/show_grievance_details',$data,compact('status','roles'));
    }

    // Approve or forward the feed abck application
    public function approvedGrievanceRedressalApplication(Request $request){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
         if($request->status =='APPROVED'){
             \DB::transaction(function () use ($request,$roleId) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
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
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['remarks' => $request->remarks]);
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['user_id'=>$request->userId]);
             return redirect('tasklist/tasklist')->with('msg_success', 'Application forward successfully');
             }
     }
    
}
