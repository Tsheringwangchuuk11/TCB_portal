<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileUploadController extends Controller
{

	public function __construct(FileUpload $file_model)
    {    
       $this->file_model = $file_model;
   }


	public function addDocuments(Request $request)
	{
		/*if($request->hasFile('filename')){
			$document = $this->file_model->getFileUploadDtls($request);
			return json_encode(array('data'=>$document));          
		}*/
		$module_name = $request->module_name;
		$service_name = $request->service_name;
		$year = date('Y');
		$date = date('zHis');
		$this->validate($request, [
			'filename' => 'required',
			'filename.*' => 'max:4096'
	]);
		$document=null;
		if($request->hasFile('filename')){
			$filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension(); //get file extension
			$target_path  = public_path('/MyDocument/'.$module_name.'/'.$service_name.'/'.$year.'/'.$filename.$date);
			
			if($file->move($target_path)) {
				
				$data1 = array(
					'document_type'  => $fileextension,
					'document_name'  => $filename,
					'upload_url'  => $target_path
				);
            
			$document = $this->file_model->getFileUploadDtls($data1);
		}
	}
	return json_encode(array('data'=>$document));          
}

	public function deleteFile(Request $request){
		if($request->id){
			$this->file_model->deleteFile($request);
			$data = 'success';
			return response()->json($data);
		}
	}
}
