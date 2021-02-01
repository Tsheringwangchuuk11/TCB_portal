<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurposeSurvey extends Model
{
    public $timestamps = false;
    protected $table = 't_purpose_survey';
    protected $guarded=['id'];
    
    public static function getPurposeSurveyData($report_category_id,$visitor_type_id){
		$query ="";
		if($report_category_id==1){
		//	Outbound Overnight Trips(outbound tourism)
			$query = \DB::select("SELECT 
					a.id,
					a.purpose_id,a.location_id,
					a.report_category_id,
					a.value,
					a.visitor_type_id,
					a.year,
					b.dropdown_name AS purpose,
					c.dropdown_name AS country,
					d.dropdown_name AS visitor_types
					FROM t_purpose_survey a
					LEFT JOIN t_dropdown_lists b ON a.purpose_id=b.id
					LEFT JOIN t_dropdown_lists d ON a.visitor_type_id=d.id
					LEFT JOIN t_dropdown_lists c ON a.location_id=c.id
					WHERE a.report_category_id=$report_category_id  AND a.visitor_type_id=$visitor_type_id" );
		}
		else if($report_category_id==2){
		//Outbound Excursion/ Daytrip
			$query = \DB::select("SELECT 
					a.id,
					a.purpose_id,
					a.report_category_id,
					a.value,
					a.gender,
					a.year,
					b.dropdown_name AS purpose
					FROM t_purpose_survey a
					LEFT JOIN t_dropdown_lists b ON a.purpose_id=b.id
					WHERE a.report_category_id=$report_category_id");
				 }
				 
		else if($report_category_id==3){
			$query=\DB::select("SELECT 
					a.id,
					a.purpose_id,
					a.location_id,
					a.report_category_id,
					a.value,
					a.visitor_type_id,
					a.year,
					a.gender,
					b.dropdown_name AS purpose,
					c.dzongkhag_name AS dzongkhag_name,
					d.dropdown_name AS visitor_types
					FROM t_purpose_survey a
					LEFT JOIN t_dropdown_lists b ON a.purpose_id=b.id
					LEFT JOIN t_dropdown_lists d ON a.visitor_type_id=d.id
					LEFT JOIN t_dzongkhag_masters c ON a.location_id=c.id
					WHERE a.report_category_id=$report_category_id AND a.visitor_type_id=$visitor_type_id");
			}
			else if($report_category_id==4){
				$query=\DB::select("SELECT 
						a.id,
						a.purpose_id,
						a.location_id,
						a.report_category_id,
						a.value,
						a.year,
						a.gender,
						b.dropdown_name AS purpose,
						c.dzongkhag_name AS dzongkhag_name
						FROM t_purpose_survey a
						LEFT JOIN t_dropdown_lists b ON a.purpose_id=b.id
						LEFT JOIN t_dzongkhag_masters c ON a.location_id=c.id
						WHERE a.report_category_id=$report_category_id");
				}
		return $query;
	}

	public static function getReportType($dropdownId){
		$query=\DB::table('t_report_types as t1')
					->select('t1.report_type_id','t1.report_type')
					->where('t1.is_active','Y')
					->whereIn('t1.report_type_id',$dropdownId)
					->get();
  	     return $query;
	}

	public static function getVisitorTypes($masterId,$dropdownId){
		$query=\DB::table('t_dropdown_lists as t1')
					->select('t1.id','t1.dropdown_name')
					->where('t1.is_active','Y')
					->where('t1.master_id',$masterId)
					->whereIn('t1.id',$dropdownId)
					->get();
  	     return $query;
	}
	public static function insertDetails($tableName,$data){
		$flag=\DB::table($tableName)->insert($data);	
		return $flag;
	   }

	public static function getPurposeSurveyToEdit($id){
	$query=\DB::table('t_purpose_survey as t1')
				->select('t1.*')
				->where('t1.id',$id)
				->first();
	return $query;
	}
}
