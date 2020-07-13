<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FileUpload extends Model
{
    
	public $table = 't_documents';

    public function getClientOriginalExtension()
    {
        return pathinfo($this->originalName, PATHINFO_EXTENSION);
    }

    // save file
    public function getFileUploadDtls($request)
    {
		if($file = $request->file('filename')){
            $module_name = $request->module_name;
            $service_name = $request->service_name;        
            $randomString=str_random(8);
            $fileOriginName = $file->getClientOriginalName();
            $fileName = time() . '-' . $randomString . '.' . $file->getClientOriginalExtension();
            $fileextension = $file->getClientOriginalExtension(); //get file extension
            
            $filepath = $module_name.'/'.$service_name.'/';
            $file->move(public_path('MyDocument').'/'. $filepath, $fileName);//make folder MyDocument			
            $uploadurl ='MyDocument'.'/'.$filepath.$fileName;

            $data1 = array(
            	'document_type'  => $fileextension,
            	'document_name'  => $fileOriginName,
            	'upload_url'  => $uploadurl
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

