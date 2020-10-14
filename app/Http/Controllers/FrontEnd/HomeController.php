<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use Validator;
use App\Models\FileUpload;
use DB;
class HomeController extends Controller
{
    public function index()
    {
    	return view('frontend.index');
    }
    
    public function feedBack(){
        $status=WorkFlowDetails::getStatus('SUBMITTED')->id;
        $data['idInfos'] = Services::getIdInfo('services/new_application/grievance');
        $data['serviceproviders'] =Dropdown::getDropdownList("5");
        $data['applicantTypes'] =Dropdown::getDropdownList("2");

        return view('services.new_application.public_feed_back',$data,compact('status'));
    }
    public function saveGrievanceApplication(Request $request,Services $services){
        $application_no = $services->generateApplNo($request);
         DB::transaction(function () use ($request, $application_no,$services) {
            //insert into t_grievance_applications
            if(isset($_POST['applicant_type'])){
                if($request->complainant_name !=null){
                    $complainant_name=$request->complainant_name;
                }
                else
                {
                    $complainant_name=$request->representative_name;
                }
            $grievanceData[] = [
                    'application_no'  => $application_no,
                    'complainant_name'  => $complainant_name,
                    'complainant_address'  => $request->complainant_address,
                    'complainant_mobile_no'  => $request->complainant_mobile_no,
                    'complainant_telephone_no'  => $request->complainant_telephone_no,
                    'complainant_email'  => $request->complainant_email,
                    'applicant_type'  => $request->applicant_type,
                    'respondent_name'  => $request->respondent_name,
                    'respondent_address'  => $request->respondent_address,
                    'respondent_mobile_no'  => $request->respondent_mobile_no,
                    'respondent_telephone_no'  => $request->respondent_telephone_no,
                    'respondent_email'  => $request->respondent_email,
                    'service_provider_id'  => $request->service_provider_id,
                    'claim_summary'  => $request->claim_summary,
                    'remedy_sought'  => $request->remedy_sought,
                    'location_id'  => $request->location_id,
                    'date'  =>date('Y-m-d', strtotime($request->date)),
           ];
           $services->insertDetails('t_grievance_applications',$grievanceData);
          // update application_no in t_documents
           $documentId = $request->documentId;
           $services->updateDocumentDetails($documentId,$application_no);
          }
        });
        return redirect('/')->with('appl_info', 'Your application has been submitted successfully and your application number is :'.$application_no);
    }
}
