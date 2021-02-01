<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportationMode extends Model
{
    public $timestamps = false;
    protected $table = 't_transport_survey';
    protected $guarded=['id'];

    public static function  getTransportationList(){
        $query=\DB::table('t_transport_survey as t1')
                ->leftJoin('t_dropdown_lists as t2' ,'t2.id','=','t1.transport_mode_id')
                ->leftJoin('t_dropdown_lists as t3' ,'t3.id','=','t1.location_id')
                ->select('t1.*','t2.dropdown_name as transportation_mode','t3.dropdown_name as location_name')
                ->get();
        return $query;
    }

    public static function insertDetails($tableName,$data){
		$flag=\DB::table($tableName)->insert($data);	
		return $flag;
    }
       
    public static function getModeOfTransportToEdit($id){
		$query=\DB::table('t_transport_survey as t1')
				   ->select('t1.*')
				   ->where('t1.id',$id)
				   ->first();
		return $query;
	}
}
