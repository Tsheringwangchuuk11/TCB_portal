<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\Services;
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
        $data['idInfos'] = Services::getIdInfo('services/grievance');
        $data['letterTypes'] = Dropdown::getDropdowns("t_recommandation_letter_masters","id","recommandation_letter_type","0","0");
        $data['serviceproviders'] = Dropdown::getDropdowns("t_service_providers","id","service_provider_name","0","0");
        $data['locations'] = Dropdown::getDropdowns("t_locations","id","location_name","0","0");
        return view('services/public_feed_back',$data);
    }

    public function addDocuments(Request $request,FileUpload $file_model)
	{
		$validation = Validator::make($request->all(), [
			'filename' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
		   ]);
		   if($validation->passes())
		   {
				$document = $file_model->getFileUploadDtls($request);
				return  response()->json(['status'=>'true','data'=>$document]);          
			}
			else{
			 return response()->json(['status'=>'false','message'   => $validation->errors()->all()]);   
			}
    	}
	public function deleteFile(Request $request,FileUpload $file_model){
		if($request->id){
			$file_model->deleteFile($request);
			$data = 'success';
			return response()->json($data);
		}
    }
    
    public function saveGrievanceApplication(Request $request,Services $services){
        dd($request->all());
        $application_no = $services->generateApplNo($request);
         DB::transaction(function () use ($request, $application_no,$services) {
            //insert into t_grievance_applications
            if(isset($_POST['applicant_type'])){
            $grievanceData[] = [
                    'application_no'  => $application_no,
                    'complainant_name'  => $request->complainant_name,
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
