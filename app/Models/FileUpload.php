<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use DB;

class FileUploadModel extends Model
{
    
	public $table = 't_document_dtls';

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
			$file->move('MyDocument/'.$module_name.'/'.$service_name.'/'.$year, $filename.$date); //make folder MyDocument

            $data1 = array(
            	'document_type'  => $fileextension,
            	'document_name'  => $filename,
            	'upload_url'  => $filepath
            );
            $last_id = DB::table('t_document_dtls')->insertGetId($data1);
            $fileinfo = DB::table('t_document_dtls')
                ->select('document_name','document_id','upload_url')
                ->where('document_id',$last_id)
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
        DB::table('t_document_dtls')->where('document_id', $id)->delete();
    }


}
