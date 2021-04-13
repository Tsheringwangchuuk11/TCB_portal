<?php

namespace App\Http\Controllers\SystemSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;

class AboutUsContent extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content=Services::getAboutUsContent();
        return view('about_us.index',compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Services $service)
    {

        $content= [
            'content' => $request->content,
              'created_by' =>auth()->user()->id,
        ];
        $service->updateOrSaveDetails('t_about_content',$content,['id'=>$request->recordId]);
        return redirect('system/about-us-content')->with('msg_success', 'Content added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {
         if($request->file('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);
            $url = asset('storage/uploads/'.$filenametostore);
            return  $url;
        } 
    }

    public function DeleteUploadImage(Request $request){
        $imgSrc= $request->imgSrc;
        $imageName = basename($imgSrc);
        //return response()->json($imageName);
        $result=unlink('storage/uploads/'.$imageName);          
        if($result){
            return response()->json('delete successfully');
        }else{
            return response()->json('delete failed');
        }
    } 
}
