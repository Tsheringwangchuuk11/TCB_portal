<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    public static function getAssessmentReportList(){
        $query=\DB::table('t_workflow_dtls')
                ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                ->select('t_workflow_dtls.application_no','t_module_masters.module_name','t_applications.cid_no', 't_applications.owner_name','t_applications.module_id','t_applications.applicant_name','t_services.name','t_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks')
                ->whereIn('t_applications.module_id', array('1', '2', '3', '4'))
                ->where('t_services.id', '4')
                ->where('t_workflow_dtls.status_id','=', '1')
                ->orderBy('t_workflow_dtls.created_at', 'asc');
        return $query;
    }

    public static function getDetailAssessment($application_no){
        $query=\DB::table('t_applications as t1')
                   ->leftJoin('t_star_categories as t2','t2.module_id', '=', 't1.module_id')
                   ->leftJoin('t_locations as t3','t3.id', '=', 't1.location_id')
                   ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                   ->select('t1.*','t2.star_category_name','t3.location_name') 
                   ->where('t1.application_no','=', $application_no)
                   ->where('t4.status_id','=', '1')
                   ->first();  
        return $query;                                                           
    }

    public static function getRoomDetailAssessment($application_no){
        $query=\DB::table('t_applications as t1')
                   ->leftJoin('t_room_applications as t2','t2.application_no', '=', 't1.application_no')
                   ->leftJoin('t_room_types as t3','t3.id', '=', 't2.room_type_id')
                   ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                   ->select('t3.room_name','t2.room_no') 
                   ->where('t2.application_no','=', $application_no)
                   ->where('t4.status_id','=', '1')
                   ->get();  
        return $query;                                                           
    }

    public static function getstaffDetailAssessment($application_no){
        $query=\DB::table('t_applications as t1')
                   ->leftJoin('t_staff_applications as t2','t2.application_no', '=', 't1.application_no')
                   ->leftJoin('t_staff_areas as t3','t3.id', '=', 't2.staff_area_id')
                   ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                   ->leftJoin('t_hotel_divisions as t5','t5.id', '=', 't2.hotel_div_id')
                   ->select('t2.staff_name','t2.staff_gender','t3.staff_area_name','t5.hotel_div_name') 
                   ->where('t2.application_no','=', $application_no)
                   ->where('t4.status_id','=', '1')
                   ->get();  
        return $query;                                                           
    }
}
