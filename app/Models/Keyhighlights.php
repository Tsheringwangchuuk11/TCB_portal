<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyhighlights extends Model
{
	public $timestamps = false;
    protected $table = 't_key_highlights';
	protected $guarded=['key_highlight_id'];
	protected $primaryKey = 'key_highlight_id';

    public static function getDropdownName(){
		$query=\DB::table('t_dropdown_lists as t1')
					->select('t1.id','t1.dropdown_name')
					->where('t1.is_active','Y')
					->where('t1.master_id',"19")
					->get();
  	     return $query;
	}

	public static function getHighlightsList(){
		$query=\DB::table('t_key_highlights as t1')
				   ->leftjoin('t_dropdown_lists as t2', 't2.id', '=', 't1.highlight_type_id')
				   ->select('t1.*','t2.dropdown_name')
				   ->orderBy('key_highlight_id', 'DESC')
				   ->get();
		return $query;
	}

	public static function insertDetails($tableName,$data){
		$flag=\DB::table($tableName)->insert($data);	
		return $flag;
	   }

	public static function getHighLightsTypesToEdit($key_highlight_id){
		$query=\DB::table('t_key_highlights as t1')
				   ->leftjoin('t_dropdown_lists as t2', 't2.id', '=', 't1.highlight_type_id')
				   ->select('t1.*','t2.dropdown_name')
				   ->where('key_highlight_id',$key_highlight_id)
				   ->first();
		return $query;
	}
}
