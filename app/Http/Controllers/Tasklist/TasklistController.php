<?php

namespace App\Http\Controllers\Tasklist;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\WorkFlowDetails;
use App\TRolePrivilege;
use App\Models\TaskDetails;

class TasklistController extends Controller
{
    //
    public function index()
    {
        //
        $user_id = auth()->user()->id;
        $releaseId = WorkFlowDetails::getStatus('INITIATED');
        $claimId = WorkFlowDetails::getStatus('CLAIMED');
        $roles  = auth()->user()->roles()->pluck('role_id')->toArray();
        //dd(sizeof($roles));
        $privilegeIds = TRolePrivilege::whereIn('role_id', $roles)->orderBy('system_sub_menu_id', 'asc')->select('system_sub_menu_id')->get();
        $groupTasklists = TaskDetails::getTasklists($privilegeIds, $releaseId->id, 0);
        $myTasklists = TaskDetails::getTasklists($privilegeIds,$claimId->id, $user_id);

        return view('services.tasklist.tasklist',compact('groupTasklists','myTasklists'));
    }
    public function claimApplication(Request $request){
        $releaseId = WorkFlowDetails::getStatus('INITIATED');
        $claimId = WorkFlowDetails::getStatus('CLAIMED');
        $data = [
            'user_id' => auth()->user()->id,
            'status_id' => $claimId->id
        ];
        // to check application already used by somebody
        $checkAppUsed = TaskDetails::where('application_no', '=', $request->application_no)
                                    ->whereNull('user_id')
                                    ->where('status_id', '=', $releaseId->id)
                                    ->exists();
        if ($checkAppUsed){
            if(TaskDetails::savedTaskDtlsAudit($request->application_no)){
                TaskDetails::where('application_no', $request->application_no)->update($data);
                return \response()->json(['status' => 'true', 'msg' => ' Application number: '.$request->application_no.' has been assigned to you']);
            }
        }else {
            return response()->json(['status'=>'false', 'msg' => ' Application number: '.$request->application_no.' has been already assigned to someone']);
        }

        return response()->json(['status'=>'false', 'msg' => ' Application number: '.$request->application_no.' has not been assigned to you']);
    }
    public function releaseApplication(Request $request){
        $releaseId = WorkFlowDetails::getStatus('INITIATED');
        $data = [
            'user_id' => null,
            'status_id' => $releaseId->id
        ];
        if(TaskDetails::savedTaskDtlsAudit($request->application_no)){
            TaskDetails::where('application_no', $request->application_no)->update($data);
            return \response()->json(['status' => 'true', 'msg' => ' Application number: '.$request->application_no.' has been unassigned and sent to the group task']);
        }
        return response()->json(['status'=>'false', 'msg' => ' Application number: '.$request->application_no.' has not been unassigned']);

    }
    public function openApplication(){
        return response()->json('openApplication');
    }
}