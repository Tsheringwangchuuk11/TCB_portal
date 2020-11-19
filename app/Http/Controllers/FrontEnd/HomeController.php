<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use Validator;
use App\Models\FileUpload;
use App\Models\TaskDetails;
use DB;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\EndUserNotification;

class HomeController extends Controller
{
    public function index()
    {
    	return view('frontend.index');
    }
    
    public function tourismGrievances(){
        $status=WorkFlowDetails::getStatus('SUBMITTED')->id;
        $data['idInfos'] = Services::getIdInfo('services/new_application/grievance');
        $data['serviceproviders'] =Dropdown::getDropdownList("5");
        $data['applicantTypes'] =Dropdown::getDropdownList("2");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('services.new_application.public_feed_back',$data,compact('status'));
    }

    public function saveGrievanceApplication(Request $request,Services $services){
        $application_no = $services->generateApplNo($request);
         DB::transaction(function () use ($request, $application_no,$services) {
            //insert into t_grievance_applications
            if(isset($_POST['applicant_type_id'])){
                if($request->complainant_name){
                    $complainant_name=$request->complainant_name;
                }
                else
                {
                    $complainant_name=$request->representative_name;
                }
            $grievanceData= [
                    'application_no'  => $application_no,
                    'service_id'  => $request->service_id,
                    'module_id'  => $request->module_id,
                    'complainant_name'  => $complainant_name,
                    'complainant_address'  => $request->complainant_address,
                    'complainant_mobile_no'  => $request->complainant_mobile_no,
                    'complainant_telephone_no'  => $request->complainant_telephone_no,
                    'complainant_email'  => $request->complainant_email,
                    'applicant_type'  => $request->applicant_type_id,
                    'respondent_name'  => $request->respondent_name,
                    'respondent_address'  => $request->respondent_address,
                    'respondent_mobile_no'  => $request->respondent_mobile_no,
                    'respondent_telephone_no'  => $request->respondent_telephone_no,
                    'respondent_email'  => $request->respondent_email,
                    'service_provider_id'  => $request->service_provider_id,
                    'claim_summary'  => $request->claim_summary,
                    'remedy_sought'  => $request->remedy_sought,
                    'location_id'  => $request->location_id,
           ];
           $services->insertDetails('t_grievance_applications',$grievanceData);
          // update application_no in t_documents
           $documentId = $request->documentId;
           $services->updateDocumentDetails($documentId,$application_no);
          }
            $update=new WorkFlowDetails;
            $update->application_no=$application_no;
            $update->status_id=WorkFlowDetails::getStatus('SUBMITTED')->id;
            //$update->user_id=auth()->user()->id;
            $update->save();

            //insert into t_task_dtls
            $update=new TaskDetails;
            $update->application_no=$application_no;
            $update->status_id=WorkFlowDetails::getStatus('INITIATED')->id;
            $update->assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id, 1)->id;
            $update->save();

            //Email send notifications
            if ($request->complainant_email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->complainant_email) //Sending mail to trainer
                ->notify((new EndUserNotification($request->complainant_email, $request->complainant_name, $application_no, 'Submitted',$request->service_name))->delay($when));
            }
        });
        return view('layouts.include.application_successful',compact('application_no'));
    }
}
