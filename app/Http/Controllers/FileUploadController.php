<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\FileUpload;

class FileUploadController extends Controller
{

	public function __construct(FileUpload $file_model)
    {    
       $this->file_model = $file_model;
   }

	public function addDocuments(Request $request)
	{
		$document = $this->file_model->getFileUploadDtls($request);
		return  response()->json(['status'=>'true','data'=>$document]);          
    	}
	public function deleteFile(Request $request){
		if($request->id){
			$this->file_model->deleteFile($request);
			$data = 'success';
			return response()->json($data);
		}
	}
}
