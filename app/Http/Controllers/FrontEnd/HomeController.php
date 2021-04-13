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
use App\PublicReport;
class HomeController extends Controller
{
    public function index()
    {
        $data['reporttypes']=PublicReport::getReportTypes();
        return view('frontend.index',$data);
    }

    public function getVisitorsCountryWise(Request $request) {
        $visitors=PublicReport::getVisitorsCountryWise($request->year);
        $totalvisitors=PublicReport::getTotalVisitors($request->year);
        $keyhighlights=PublicReport::getKeyHighLightsData($request->year);
        $is_publish= $keyhighlights->where('year',$request->year)->pluck('is_publish')->first();
        $current_year=$request->year;
        $previous_year= $current_year-1;
        $p_prev_year= $previous_year-1;
        $cur_year_percent=PublicReport::getTotalVisitorsPerYear($current_year, $previous_year);
        $prev_year_percent=PublicReport::getTotalVisitorsPerYear($previous_year, $p_prev_year);
        $percentage_status=""; 
        if($cur_year_percent[0]->total_percentage > $prev_year_percent[0]->total_percentage){
            $percentage_status="increase";
        }else{
            $percentage_status="decrease";
        }
        $msg="";
        if(!$keyhighlights->isEmpty()){
            if($is_publish=='Y'){
                $msg="Final data";
            }else{
                $msg="Provisional data";
            }
        }
        return response()->json(['visitors'=>$visitors,'totalvisitors'=>$totalvisitors,'keyhighlights'=>$keyhighlights,'msg'=> $msg,'current_percentage'=>$cur_year_percent[0]->total_percentage,'percentage_status'=>$percentage_status]);
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

    public function contactPost(Request $request){
        \Mail::send('frontend.layouts.contact_email',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('sender_email'),
            'subject' => $request->get('subject'),
            'phone_number' => $request->get('contact_no'),
            'user_message' => $request->get('content'),
        ), function($message) use ($request)
          {
             $message->from($request->sender_email);
             $message->to('info@tourism.gov.bt');
             $message->subject($request->subject);
          });
        return redirect()->back()->with('msg_success', 'Thanks for contacting me, I will get back to you soon!');
    }

    public function aboutUsContent(){
        $content=Services::getAboutUsContent();
        return view('frontend.layouts.about_us',compact('content'));
    }
}
