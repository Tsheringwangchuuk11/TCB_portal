<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UploadExample;
use App\Upload;
use DB;

class ExcelUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:excel/uploads,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:excel/uploads,create', ['only' => ['create', 'store']]);                
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $uploads = Upload::orderBy('mobile_number')->paginate(30);

        return view('upload.index', compact('uploads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'eapi_user' => 'required',
            'upload' => 'required|mimes:csv,txt'
        ];
        

        $this->validate($request, $rules);

        $dataCount = Upload::where('transaction_date', date('Y-m-d', strtotime($request->transaction_date)))->count();
        if ($dataCount > 0) {
            return back()->with('msg_error', 'Duplicate entry.');
        }

        if($request->hasFile('upload')){
            $path = $request->file('upload');
            Excel::import(new UploadExample($request->eapi_user, $request->transaction_date), $path);
        }

        return back()->with('msg_success', 'Your excel file has been uploaded successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
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
}
