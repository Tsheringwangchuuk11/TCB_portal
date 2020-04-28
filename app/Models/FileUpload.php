<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FileUpload extends Model
{
    
	public $table = 't_documents';

    // save file
	public function getFileUploadDtls($request){

		if($file = $request->file('filename')){
            $module_name = $request->module_name;
            $service_name = $request->service_name;
            $year = date('Y');
            $date = date('zHis');
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension(); //get file extension
            $filepath = 'MyDocument/'.$module_name.'/'.$service_name.'/'.$year.'/'.$filename.$date;
			$file->move($filepath); //make folder MyDocument

            $data1 = array(
            	'document_type'  => $fileextension,
            	'document_name'  => $filename,
            	'upload_url'  => $filepath
            );
            $last_id = DB::table('t_documents')->insertGetId($data1);
            $fileinfo = DB::table('t_documents')
                ->select('document_name','id','upload_url')
                ->where('id',$last_id)
                ->get();
            return $fileinfo;
        }
    }

    // delete file
    public function deleteFile($request){
        $id = $request->id;
        $url = $request->url;
        $year = date('Y');
        unlink($url);
        DB::table('t_documents')->where('id', $id)->delete();
    }
}
