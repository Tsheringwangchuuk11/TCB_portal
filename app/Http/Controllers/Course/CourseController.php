<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRegistration;
use App\Models\Dropdown;
use DB;

class CourseController extends Controller
{
    // show course details
    public function getCourseDtlsList(){
        $data['coursedtllists'] = TrainingRegistration::getCourseDtlList();
        return view('course.course_dtl_lists',$data);
    }

    //redirect to create blade 
    public function createNewCourse(){
        $data['courseTypes'] =Dropdown::getDropdownList("13");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('course.create_new_course',$data); 
    }

    // save course details
    public function storeNewCourse(Request $request,TrainingRegistration $training){
        DB::transaction(function () use ($request,$training) {
            if(isset($_POST['course_type_id'])){
                $courseData[] = [
                    'dzongkhag_id'=>$request->dzongkhag_id,
                    'course_type_id'=>$request->course_type_id,
                    'contact_person'=>$request->contact_person,
                    'mobile_no'=>$request->mobile_no,
                    'total_slot'=>$request->total_slot,
                    'email'=>$request->email,
                    'app_start_date'=>date('Y-m-d', strtotime($request->app_start_date)),
                    'app_end_date'=>date('Y-m-d', strtotime($request->app_end_date)),
                    'course_start_date'=>date('Y-m-d', strtotime($request->course_start_date)),
                    'course_end_date'=>date('Y-m-d', strtotime($request->course_end_date)),
                    'created_at'=>now(),
                    'created_by'=>auth()->user()->id,
                    ];
                $training->insertDetails('t_course_dtls',$courseData);
            }
        });
        return redirect('course/course-details')->with('msg_success', 'New course added successfully');
    }

    // get course details for edit
    public function editCourseDtls($id){
        $data['courseTypes'] =Dropdown::getDropdownList("13");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['coursedtl']=TrainingRegistration::getCourseDtlsToEdit($id);
        return view('course.edit_course_dtls',$data);
    }

    // update course details 
    public function updateCourseDtls(Request $request){
         $data = array(
            'dzongkhag_id'=>$request->dzongkhag_id,
            'course_type_id'=>$request->course_type_id,
            'contact_person'=>$request->contact_person,
            'mobile_no'=>$request->mobile_no,
            'email'=>$request->email,
            'total_slot'=>$request->total_slot,
            'app_start_date'=>date('Y-m-d', strtotime($request->app_start_date)),
            'app_end_date'=>date('Y-m-d', strtotime($request->app_end_date)),
            'course_start_date'=>date('Y-m-d', strtotime($request->course_start_date)),
            'course_end_date'=>date('Y-m-d', strtotime($request->course_end_date)),
            'updated_at'=>now(),
            'updated_by'=>auth()->user()->id,
        );
        $status=TrainingRegistration::updateDtls('t_course_dtls','id',$request->record_id,$data);
        return redirect('course/course-details')->with('msg_success', 'New course updated successfully');
    }

    // delete course details 
    public function deleteCourseDtls($id){
        try {
            $status=TrainingRegistration::deleteRecord('t_course_dtls','id',$id);
            return redirect('course/course-details')->with('msg_success', 'Course details deleted successfully');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This course dtls cannot be deleted as it is link in other data.');
        } 
    }

    // get tranee list
    public function getTraineeDtlsList(){
        $data['coursedtllists'] = TrainingRegistration::getCourseDtlList();
        return view('course.trainee_lists',$data);
    }

    //get Trainee registration list
    public function getTraineeRegistrationList($course_dtl_id){
        $data['coursetitle'] = TrainingRegistration::getCourseTitle($course_dtl_id);
        $data['registeredTraineeLists']=TrainingRegistration::getRegisteredTraineeList($course_dtl_id);
        $data['selectedTraineeLists']=TrainingRegistration::getSelectedTraineeList($course_dtl_id);
        return view('course.trainnee_submitted_list',$data);
    }
    //select the trainee
    public function selectedStatusUpdate($application_no,$course_dtl_id){
        $select_status=TrainingRegistration::getStatus('Selected')->id;
        $data = array(
            'status'=>$select_status,
            'updated_at'=>now(),
            'updated_by'=>auth()->user()->id,
         );
        $updatedata=TrainingRegistration::updateDtls('t_trainee_application','application_no',$application_no,$data);
        return redirect('course/trainee-apply-list/'.$course_dtl_id)->with('msg_success', ' Data Update successfully.');
    }

    //view the submittted trainee list
    public function viewSubmittedTraineeList($application_no,$status){
        $course_status=TrainingRegistration::getStatus($status)->id;
        if($course_status==1){
            $data['submittedTraineeLists']=TrainingRegistration::getViewSelectedTraineeList($application_no,$course_status);
            $data['course_status_type'] = Dropdown::getCourseStatus($dropdownId[]=["2","3","4"]);
        }{
            $data['submittedTraineeLists']=TrainingRegistration::getViewSelectedTraineeList($application_no,$course_status);
        }
        $application_no= $data['submittedTraineeLists']->application_no;
        $data['documents']=TrainingRegistration::getViewSubmittedDocuments($application_no);
        return view('course.trainee_individual_dtls',$data);
    }

    public function updateStatus(Request $request){
        $data=null;
        if($request->status==4){
                $data = array(
                    'status'=>$request->status,
                    'updated_at'=>now(),
                    'completed_year'=>now(),
                    'updated_by'=>auth()->user()->id,
                );
        }else{
            $data = array(
                'status'=>$request->status,
                'updated_at'=>now(),
                'updated_by'=>auth()->user()->id,
             );
        }
        $updatedata=TrainingRegistration::updateDtls('t_trainee_application','application_no',$request->application_no,$data);
        return redirect('course/trainee-apply-list/'.$request->course_dtl_id)->with('msg_success', ' Data Update successfully.');
    }
}
