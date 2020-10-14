<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class TrainingRegistration extends Model
{
    public static function getCourseDtlList(){
		$query=\DB::table('t_course_dtls as t1')
			->leftjoin('t_dropdown_lists as t2','t2.id','=','t1.course_type_id')
            ->select('t1.*','t2.dropdown_name')
            ->where('t1.is_active','Y')
			->get();
			return $query;
    }

    // common method to insert data
    public function insertDetails($tableName,$data){
        $flag=DB::table($tableName)->insert($data);	
        return $flag;
    }

        
    // common method to update data
    public static function updateDtls($tableName,$filedName,$para,$data){
        $status=\DB::table($tableName)
                ->where($filedName,$para)
                ->update($data);
         return $status;
    }
    // common  method for delete
    public static function deleteRecord($tableName,$filedName,$para){
        $status= DB::table($tableName)->where($filedName, $para)->delete();
        return  $status;
    }
    //generate application_no
	public function generateApplNo($request)
	{
		$serviceId=$request->service_id;
		$lastApplNo = $this->getSequenceNo($serviceId);
		$applNo=$lastApplNo->last_application_no;
		$serviceIdLength=strlen($serviceId);
		$application_no = "";
		$newApplNo=$applNo+1;
		$sql=DB::table('t_application_last_serial_number as t1')
				->where('t1.service_id',$serviceId)
				->update(['t1.last_application_no' =>$newApplNo ]);
		$newApplNo=str_pad($newApplNo,7,0,STR_PAD_LEFT);
			if($serviceIdLength!=2){
				$application_no .= "0";
				$application_no.= $serviceId;
			}else{
				$application_no.= $serviceId;
			}
		$application_no .= $newApplNo;
		return $application_no;
	}

	private function getSequenceNo($serviceId){
        $lastapplNo=DB::table('t_application_last_serial_number as t1')
						->select('t1.last_application_no','t1.id')
						->where('t1.service_id',$serviceId)
						->orderBy('id', 'DESC')->first();
        return $lastapplNo;
    }
    
    public static function getCourseDtlsToEdit($id){
        $query=DB::table('t_course_dtls as t1')
                  ->select('t1.*')
                  ->where('t1.id',$id)
                  ->first();
        return $query;
    }

    public static function getNewCreatedCourseDtlList(){
        $query=\DB::select('
                        SELECT 
                        a.*,
                        b.dropdown_name,
                        c.dzongkhag_name,
                        CASE WHEN a.total_slot + 10 = COUNT(d.application_no) THEN "1" ELSE "0" END 
                        AS course_status
                        FROM t_course_dtls a
                        LEFT JOIN t_dropdown_lists b ON a.course_type_id=b.id
                        LEFT JOIN t_dzongkhag_masters c ON a.dzongkhag_id=c.id
                        LEFT JOIN t_trainee_application d ON a.id=d.course_dtl_id
                        WHERE CURDATE() BETWEEN a.app_start_date AND a.app_end_date
            ');
        return $query;
    }

    //get registered trainee list
    public static function getRegisteredTraineeList($course_dtl_id){
        $query=DB::table('t_trainee_application as t1')
            ->select('t1.*')
            ->where('t1.course_dtl_id',$course_dtl_id)
            ->where('t1.status','2')
            ->get();
        return $query;
    }

     //get registered trainee list
     public static function getSelectedTraineeList($course_dtl_id){
        $query=DB::table('t_trainee_application as t1')
            ->select('t1.*')
            ->where('t1.course_dtl_id',$course_dtl_id)
            ->where('t1.status','1')
            ->get();
        return $query;
    }

    public static function getCourseTitle($course_dtl_id){
        $query=\DB::table('t_course_dtls as t1')
             ->leftjoin('t_dropdown_lists as t2','t2.id','=','t1.course_type_id')
            ->select('t2.dropdown_name')
            ->where('t1.is_active','Y')
            ->where('t1.id',$course_dtl_id)
			->first();
			return $query;
    }

    //get course status types
    public static function getStatus($status_name)
    {
       $query=\DB::table('t_course_status_type as t1')
                 ->select('id')
                 ->where('course_status_name',$status_name)
                 ->first();
        return $query;
    }

    public static function getViewSelectedTraineeList($application_no,$course_status){
        $query=\DB::table('t_trainee_application as a')
            ->leftjoin('t_village_masters as b','b.id','=','a.applicant_village_id')
            ->leftjoin('t_gewog_masters as c','c.id','=','b.gewog_id')
            ->leftjoin('t_dzongkhag_masters as d','d.id','=','c.dzongkhag_id')
            ->select('a.*','b.village_name','c.gewog_name','d.dzongkhag_name')
            ->where('a.status', $course_status)
            ->where('a.application_no', $application_no)
            ->first();
         return $query;
    }
    
    //get the submitted documents
    public static function getViewSubmittedDocuments($application_no){
        $query=\DB::table('t_documents as a')
            ->leftjoin('t_trainee_application as b','b.applicant_cid_no','=','a.application_no')
            ->select('a.document_name','a.upload_url')
            ->where('a.application_no', $application_no)
            ->get();
         return $query;
    }
}

