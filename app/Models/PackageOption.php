<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
    public $timestamps = false;
    protected $table = 't_package_option_survey';
    protected $guarded=['id'];

    public static function  getPackageOptionList(){
        $query=\DB::select("SELECT a.* ,
                    b.dropdown_name AS location_name
                    FROM t_package_option_survey a 
                    LEFT JOIN t_dropdown_lists b ON a.location_id=b.id
                    ");
        return $query;
    }
    public static function insertDetails($tableName,$data){
		$flag=\DB::table($tableName)->insert($data);	
		return $flag;
    }

    public static function getPackageOptionToEdit($id){
		$query=\DB::table('t_package_option_survey as t1')
				   ->select('t1.*')
				   ->where('t1.id',$id)
				   ->first();
		return $query;
	}
}
