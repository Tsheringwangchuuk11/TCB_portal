<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    public $timestamps = false;
    protected $table = 't_origin_survey';
    protected $guarded=['id'];

    public static function  getOriginList(){
        $query=\DB::select("SELECT a.*,
                        b.dzongkhag_name AS dzo_of_origin,
                        c.dzongkhag_name AS main_destionation,
                        d.dropdown_name AS visitor_types,
                        e.report_category
                        FROM t_origin_survey a 
                        LEFT JOIN t_dzongkhag_masters b ON a.location_id=b.id
                        LEFT JOIN t_dzongkhag_masters c ON a.origin_id=c.id
                        LEFT JOIN t_dropdown_lists d ON a.visitor_type_id=d.id
                        LEFT JOIN t_report_categories e ON a.report_category_id =e.report_category_id
                    ");
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

    public static function getOriginDataToEdit($id){
		$query=\DB::table('t_origin_survey as t1')
				   ->select('t1.*')
				   ->where('t1.id',$id)
				   ->first();
		return $query;
	}
}
