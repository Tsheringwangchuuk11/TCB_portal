<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dropdown extends Model
{
	protected $table = 't_dropdown_lists';
	protected $guarded=['id'];

	public static function getDropdownLists($tableName, $id, $name, $parentId, $parentNameId){
		$db_table = DB::table($tableName);
		if($parentId != 0){
			$db_table->where($parentNameId, $parentId);
		}
		$value = $db_table->orderBy( $id,'asc')->pluck($name,  $id)->all();
		return $value;
	}
	public static function getReportDropdownList($table_name, $id, $name,$parent_type_value,$parent_type_name,$parent_id,$parent_name_id){
		$db_table = DB::table($table_name);
		if($parent_id != 0){
			$db_table->where($parent_name_id, $parent_id);
			$db_table->where($parent_type_name, $parent_type_value);
		}
		$value = $db_table->orderBy( $id,'asc')->pluck($name,  $id)->all();		
		return $value;
	}
	public static function getDropdowns($tableName, $id, $name, $parentId, $parentNameId){

		$db_table = DB::table($tableName);
		if($parentId != 0){
			$db_table->where($parentNameId, $parentId);
		}
		$value = $db_table->orderBy( $id,'asc')->get();
		return $value;
	}

	public static function getMasterDropDown(){
		$query=\DB::table('t_dropdown_masters as t1')
					->select('t1.id','t1.master_name')
					->where('t1.is_view','Y')
					->where('t1.is_status','Y')
					->get();
  	     return $query;
	}
	public static function getMasterDropdownName($masterId){
		$query=\DB::table('t_dropdown_masters as t1')
					->select('t1.id','t1.master_name')
					->where('t1.is_view','Y')
					->where('t1.is_status','Y')
					->where('t1.id',$masterId)
					->first();
  	     return $query;
	}

	public static function getDropdownList($masterId){
		$query=\DB::table('t_dropdown_lists as t1')
					->select('t1.id','t1.dropdown_name')
					->where('t1.is_active','Y')
					->where('t1.master_id',$masterId)
					->get();
  	     return $query;
	}
	public static function getApplicationType($masterId,$dropdownId){
		$query=\DB::table('t_dropdown_lists as t1')
					->select('t1.id','t1.dropdown_name')
					->where('t1.is_active','Y')
					->where('t1.master_id',$masterId)
					->whereIn('t1.id',$dropdownId)
					->get();
  	     return $query;
	}
	public  static function getBasicStandardLists($condition){
        $db_table = DB::table('t_basic_standards');
        if ($condition == 'in'){
            $db_table->whereIn('id', [3,4]);
        }else if ($condition == 'notIn'){
            $db_table->whereNotIn('id', [3,4]);
        }
        $value = $db_table->orderBy( 'id','asc')->get();
        return $value;
    }
    public  static function getBasicStandards($condition){
        $db_table = DB::table('t_basic_standards');
        if ($condition == 'in'){
            $db_table->whereIn('id', [3,4]);
        }else if ($condition == 'notIn'){
            $db_table->whereNotIn('id', [3,4]);
        }
        $value = $db_table->orderBy( 'id','asc')->pluck('standard_code',  'id')->all();
        return $value;
	}
	
	public static function getCourseStatus($statusId){
		$query=\DB::table('t_course_status_type as t1')
					->select('t1.id','t1.course_status_name')
					->whereIn('t1.id',$statusId)
					->get();
  	     return $query;
	}
}
