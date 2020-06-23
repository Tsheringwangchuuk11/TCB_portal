<?php

namespace App\Http\Controllers\Application;

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
		$validation = Validator::make($request->all(), [
			'filename' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
		   ]);
		   if($validation->passes())
		   {
				$document = $this->file_model->getFileUploadDtls($request);
				return  response()->json(['status'=>'true','data'=>$document]);          
			}
			else{
			 return response()->json(['status'=>'false','message'   => $validation->errors()->all()]);   
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
