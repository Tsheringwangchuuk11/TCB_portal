<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\Services;
use DB;

class TrainingRegistrationController extends Controller
{
     // display the training dtls to end user
     public function displayCourseDtlsToEndUser(){
        $data['coursedtllists'] = TrainingRegistration::getNewCreatedCourseDtlList();
        return view('training_registration.course_detail_list',$data);
    }

    //Registration form
    public function registrationForTraining($id){
        $status=WorkFlowDetails::getStatus('SUBMITTED')->id;
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('training_registration.registration_form',$data,compact('status','id'));
    }

    //save trainee dtls
    public function saveTraineeDtls(Request $request,TrainingRegistration $training,Services $service){
        $application_no = $training->generateApplNo($request);
        DB::transaction(function() use($request,$training,$service,$application_no){
             // insert into t_trainee_application
             $traineeInfo = [];
             if(isset($_POST['applicant_cid_no'])){
                    $traineeInfo[] = [
                       'application_no'   => $application_no,
                       'course_dtl_id'=> $request->course_dtl_id,
                       'applicant_cid_no'   => $request->applicant_cid_no,
                       'applicant_name'   => $request->applicant_name,
                       'applicant_dob'   =>date('Y-m-d', strtotime($request->applicant_dob)),
                       'applicant_contact_no'   => $request->applicant_contact_no,
                       'applicant_email'   => $request->applicant_email,
                       'applicant_gender'   => $request->applicant_gender,
                       'applicant_village_id'   => $request->establishment_village_id,
                       'present_working_address'   => $request->present_working_address,
                       'created_at'   => now(),
                    ];
                $training->insertDetails('t_trainee_application',$traineeInfo);
            }

             //update application_no in t_documents
             $service->updateDocumentDetails($request->documentId,$application_no);
        });
        return redirect('/')->with('appl_info', 'Your application has been submitted successfully');
    }
}
