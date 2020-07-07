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

     public static function getVillageHomeStayDetailAssessment($application_no){
        $query=\DB::table('t_applications as t1')
                ->leftJoin('t_village_masters as t2','t2.id', '=', 't1.village_id')
                ->leftJoin('t_chiwog_masters as t3','t3.id', '=', 't1.chiwog_id')
                ->leftJoin('t_gewog_masters as t5','t5.id', '=', 't1.gewog_id')
                ->leftJoin('t_dzongkhag_masters as t6','t6.id', '=', 't5.dzongkhag_id')
                ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                ->select('t1.*','t2.village_name','t3.chiwog_name','t5.gewog_name','t6.dzongkhag_name') 
                ->where('t1.application_no','=', $application_no)
                ->where('t4.status_id','=', '1')
                ->first();  
        return $query; 
     }
    public static function getFamilyDetailAssessment($application_no){
        $query=\DB::table('t_applications as t1')
                    ->leftJoin('t_member_applications as t2','t2.application_no', '=', 't1.application_no')
                    ->leftJoin('t_relation_types as t3','t3.id', '=', 't2.relation_type_id')
                    ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                    ->select('t2.member_name','t2.member_age','t2.member_gender','t3.relation_type') 
                    ->where('t2.application_no','=', $application_no)
                    ->where('t4.status_id','=', '1')
                    ->get();  
        return $query;  

    }

    public static function getRestuarantDetailAssessment ($application_no){
        $query=\DB::table('t_applications as t1')
                    ->leftJoin('t_locations as t3','t3.id', '=', 't1.location_id')
                    ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                    ->select('t1.*','t3.location_name') 
                    ->where('t1.application_no','=', $application_no)
                    ->where('t4.status_id','=', '1')
                    ->first();  
        return $query;   

    } 
    public static function getTourOperatorDetailAssessment ($application_no){
        $query=\DB::table('t_applications as t1')
                    ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                    ->select('t1.*') 
                    ->where('t1.application_no','=', $application_no)
                    ->where('t4.status_id','=', '1')
                    ->first();  
        return $query;   

    } 

    public static function getOfficeInfoDetails($applicationNo){
		$query=\DB::table('t_applications as t1')
                    ->leftjoin('t_office_applications as t2','t2.application_no','=','t1.application_no')
                    ->leftjoin('t_offices as t3','t2.office_id','=','t3.id')
                    ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                    ->select('t2.id','t2.office_id','t2.office_status','t3.office_name')
                    ->where('t1.application_no',$applicationNo)
                    ->where('t4.status_id','=', '1')
                    ->get();
		return $query;
	}
	public static function 	getOfficeEquipmentInfoDetails($applicationNo,$equipmentType){
		$query=\DB::table('t_applications as t1')
                ->leftjoin('t_equipment_applications as t2','t2.application_no','=','t1.application_no')
                ->leftjoin('t_equipments as t3','t2.equipment_id','=','t3.id')
                ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                ->select('t2.id','t2.equipment_id','t2.equipment_status','t3.equipment_type','t3.equipment_name')
                ->where('t1.application_no',$applicationNo)
                ->where('t3.equipment_type',$equipmentType)
                ->where('t4.status_id','=', '1')
                ->get();
		return $query;
	}

	public static function getEmploymentInfoDetails($applicationNo){
		$query=\DB::table('t_applications as t1')
                ->leftjoin('t_employment_applications as t2','t2.application_no','=','t1.application_no')
                ->leftjoin('t_employments as t3','t2.employment_id','=','t3.id')
                ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
                ->select('t2.id','t2.employment_id','t2.employment_status','t2.nationality','t3.employment_name')
                ->where('t1.application_no',$applicationNo)
                ->where('t4.status_id','=', '1')
                ->get();
		return $query;
	}

	public static function getTransportationInfoDetails($applicationNo){
		$query=\DB::table('t_applications as t1')
            ->leftjoin('t_transport_applications as t2','t2.application_no','=','t1.application_no')
            ->leftjoin('t_vehicles as t3','t2.vehicle_id','=','t3.id')
            ->leftJoin('t_workflow_dtls as t4','t4.application_no', '=', 't1.application_no')
            ->select('t2.id','t2.vehicle_id','t2.transport_status','t2.fitness','t3.vehicle_name')
            ->where('t1.application_no',$applicationNo)
            ->where('t4.status_id','=', '1')
            ->get();
		return $query;
    }
    
    public static function getApplicationSubmittedList (){
    $applications = \DB::table('t_workflow_dtls')
                ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalsubmitted'))
                ->where('t_workflow_dtls.status_id','1')
                ->pluck('totalsubmitted');
        return $applications;
    } 

    
    public static function getApplicationApprovedList (){
        $applications = \DB::table('t_workflow_dtls')
                    ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                    ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                    ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                    ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                    ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalapproved'))
                    ->where('t_workflow_dtls.status_id','3')
                    ->pluck('totalapproved');
            return $applications;
        } 

        public static function getApplicationRejectedList(){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalrejected'))
                        ->where('t_workflow_dtls.status_id','4')
                        ->pluck('totalrejected');
            return $applications;
        }

        public static function getAppSubmittedListForModuleWise($module){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalsubmitted'))
                        ->where('t_workflow_dtls.status_id','1')
                        ->where('t_module_masters.id',$module)
                        ->pluck('totalsubmitted');
            return $applications;
        }

        public static function getAppApprovedListForModuleWise($module){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalapproved'))
                        ->where('t_workflow_dtls.status_id','3')
                        ->where('t_module_masters.id',$module)
                        ->pluck('totalapproved');
            return $applications;
        }
        public static function getAppRejectedListForModuleWise($module){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalrejected'))
                        ->where('t_workflow_dtls.status_id','4')
                        ->where('t_module_masters.id',$module)
                        ->pluck('totalrejected');
            return $applications;
        }

        public static function getAppSubmittedListForModuleService($module,$service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalsubmitted'))
                        ->where('t_workflow_dtls.status_id','1')
                        ->where('t_module_masters.id',$module)
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalsubmitted');
            return $applications;
        }

        public static function getAppApprovedListForModuleService($module,$service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalapproved'))
                        ->where('t_workflow_dtls.status_id','3')
                        ->where('t_module_masters.id',$module)
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalapproved');
            return $applications;
        }

        public static function getAppRejectedListForModuleService($module,$service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalrejected'))
                        ->where('t_workflow_dtls.status_id','4')
                        ->where('t_module_masters.id',$module)
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalrejected');
            return $applications;
        }

        public static function getAppSubmittedListForServiceWise($service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalsubmitted'))
                        ->where('t_workflow_dtls.status_id','1')
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalsubmitted');
            return $applications;
        }

        public static function getAppApprovedListForServiceWise($service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalapproved'))
                        ->where('t_workflow_dtls.status_id','3')
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalapproved');
            return $applications;
        }

        public static function getAppRejectedListForServiceWise($service){
            $applications = \DB::table('t_workflow_dtls')
                        ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                        ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                        ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                        ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                        ->select(\DB::raw('COUNT(t_workflow_dtls.application_no) as totalrejected'))
                        ->where('t_workflow_dtls.status_id','4')
                        ->where('t_applications.service_id',$service)
                        ->pluck('totalrejected');
            return $applications;
        }
}
