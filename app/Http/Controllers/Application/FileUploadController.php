<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services\FileUploadModel;

class FileUploadController extends Controller
{

	public function __construct(FileUploadModel $file_model)
    {    
       $this->file_model = $file_model;
   }


	public function addDocuments(Request $request)
	{
		if($request->hasFile('filename')){
			$document = $this->file_model->getFileUploadDtls($request);
			return json_encode(array('data'=>$document));          
		}
	}

	public function deleteFile(Request $request){
		if($request->id){
			$this->file_model->deleteFile($request);
			$data = 'success';
			return response()->json($data);
		}
	}
}
