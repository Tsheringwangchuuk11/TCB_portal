<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalTripExpenditure extends Model
{
    public $timestamps = false;
    protected $table = 't_totexpenditure_survey';
    protected $guarded=['totexp_id'];
    protected $primaryKey = 'totexp_id';
    public static function getReportType($dropdownId){
		$query=\DB::table('t_report_types as t1')
					->select('t1.report_type_id','t1.report_type')
					->where('t1.is_active','Y')
					->whereIn('t1.report_type_id',$dropdownId)
					->get();
  	     return $query;
    }
    
    public static function getTotalTripExpData($report_category_id){
		$query ="";
		if($report_category_id==1){
		//	Outbound Overnight Trips(outbound tourism)
			$query = \DB::select("SELECT a.totexp_id,
            a.avg_expenditure_trip,
            a.tot_expenditure,
            a.mean,
            a.report_category_id,
            a.location_id,
            a.year,
            b.dropdown_name AS country
            FROM t_totexpenditure_survey a 
            LEFT JOIN t_dropdown_lists b ON a.location_id=b.id
            WHERE a.report_category_id= $report_category_id " );
		}
		else if($report_category_id==2){
		//Outbound Excursion/ Daytrip
			$query = \DB::select("SELECT a.totexp_id,
            a.avg_expenditure_trip,
            a.tot_expenditure,
            a.mean,
            a.report_category_id,
            a.location_id,
            a.year,
            b.dropdown_name AS country
            FROM t_totexpenditure_survey a 
            LEFT JOIN t_dropdown_lists b ON a.location_id=b.id
            WHERE a.report_category_id= $report_category_id ");
				 }
				 
		else if($report_category_id==3){
			$query=\DB::select("SELECT a.totexp_id,
                        a.avg_expenditure_trip,
                        a.avg_expenditure_night,
                        a.tot_expenditure,
                        a.mean,
                        a.median,
                        a.report_category_id,
                        a.location_id,
                        a.year,
                        b.dzongkhag_name
                        FROM t_totexpenditure_survey a 
                        LEFT JOIN t_dzongkhag_masters b ON a.location_id=b.id
                        WHERE a.report_category_id=$report_category_id");
			}
			else if($report_category_id==4){
				$query=\DB::select("SELECT a.totexp_id,
                            a.avg_expenditure_trip,
                            a.tot_expenditure,
                            a.report_category_id,
                            a.location_id,
                            a.year,
                            b.dzongkhag_name
                            FROM t_totexpenditure_survey a 
                            LEFT JOIN t_dzongkhag_masters b ON a.location_id=b.id
                            WHERE a.report_category_id=$report_category_id");
			     	}
		return $query;
	}
    public static function insertDetails($tableName,$data){
            $flag=\DB::table($tableName)->insert($data);	
            return $flag;
    }
     
    public static function getTotalTripExpToEdit($id){
    $query=\DB::table('t_totexpenditure_survey as t1')
          ->select('t1.*')
          ->where('t1.totexp_id',$id)
          ->first();
    return $query;
    }
}
