<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use DB;

class ServiceModel extends Model
{

	public $table = 't_document_dtls';

	function getFileUploadID($request){
		if($file = $request->file('files')){
			$name = $file->getClientOriginalName(); //get image name
			$file->move('MyUploadedDocument', $name); //make folder MyDocument inside public folder
			
			$temp = explode(".", $_FILES["files"]["name"][$i]); // Set temporary name
            $newfilename = round($qbank_id) . '.' . end($temp); //file rename

            $data = array(
            	'village_id'  => $request->village_name,
            	'cid'  => $request->cid,
            	'name'  => $request->name,
            	'mobile_number'  => $request->mobile_no,
            	'path' => $name
            );
            DB::table('t_document_dtls')->insert($data);
            $last_id = DB::table('t_document_dtls')->insertGetId($data);
        }
  } //files

}

} // ends ServiceModel
