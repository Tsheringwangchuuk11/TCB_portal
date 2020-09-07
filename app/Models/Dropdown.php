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
}
