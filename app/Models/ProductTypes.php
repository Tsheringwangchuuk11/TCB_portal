<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table = 't_product_types_master';
    protected $guarded=['id'];
    
    public static function getDropdownName($dropdownId){
		$query=\DB::table('t_dropdown_lists as t1')
					->select('t1.id','t1.dropdown_name')
					->where('t1.is_active','Y')
					->where('t1.id',$dropdownId)
					->first();
  	     return $query;
	}
}
