<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use DB;

class FileUploadModel extends Model
{
    
	public $table = 't_document_dtls';

	public function getFileUploadDtls($request){

		if($file = $request->file('filename')){
            $year = date('Y');
			$filename = $file->getClientOriginalName(); //get file name
            $fileextension = $file->getClientOriginalExtension(); //get file extension
            $filepath = 'MyDocument/'.$year.'/'.$filename;
			$file->move('MyDocument/'.$year, $filename); //make folder MyDocument
			return $filepath;

            $data1 = array(
                'application_no' => '0001',
            	'document_type'  => $fileextension,
            	'document_name'  => $filename,
            	'upload_url'  => $filepath
            );
            $last_id = DB::table('t_document_dtls')->insertGetId($data1);

            return $last_id;
        }
    }


}
