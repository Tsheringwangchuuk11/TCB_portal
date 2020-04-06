<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dropdown extends Model
{
    //
	public static function getDropdownLists($tableName, $id, $name, $parentId, $parentNameId){

		$db_table = DB::table($tableName);
		if($parentId != 0){
			$db_table->where($parentNameId, $parentId);
		}
		$value = $db_table->orderBy( $id,'asc')->pluck($name,  $id)->all();		
		return $value;
	}
}
