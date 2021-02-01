<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripExpenditure extends Model
{
    public $timestamps = false;
    protected $table = 't_tripexpenditure_survey';
    protected $guarded=['id'];

    public static function  getTripExpenditureList(){
        $query=\DB::select("SELECT a.*,
                    b.dropdown_name AS purpose,
                    c.dropdown_name AS exp_item,
                    d.dropdown_name AS trip_types,
                    e.report_category
                    FROM t_tripexpenditure_survey a 
                    LEFT JOIN t_dropdown_lists b ON a.purpose_id = b.id
                    LEFT JOIN t_dropdown_lists c ON a.exp_item_id = c.id
                    LEFT JOIN t_dropdown_lists d ON a.trip_type_id = d.id
                    LEFT JOIN t_report_categories e ON a.report_category_id=e.report_category_id
                    ");
        return $query;
    }

    public static function getReportCategories($dropdownId){
		$query=\DB::table('t_report_categories as t1')
					->select('t1.report_category_id','t1.report_category')
					->where('t1.is_active','Y')
					->whereIn('t1.report_category_id',$dropdownId)
					->get();
  	     return $query;
    }
    
    public static function insertDetails($tableName,$data){
		$flag=\DB::table($tableName)->insert($data);	
		return $flag;
    }

    public static function getTripExpenditureToEdit($id){
		$query=\DB::table('t_tripexpenditure_survey as t1')
				   ->select('t1.*')
				   ->where('t1.id',$id)
				   ->first();
		return $query;
	}
}
