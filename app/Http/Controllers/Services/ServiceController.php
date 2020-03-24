<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceRequest;
use App\Models\Services\ServiceModel;
use DB;
use File;
class ServiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ServiceModel $serviceModel)
    {
       $this->serviceModel = $serviceModel;
    }
    public function index(Request $request)
    {
        // fetching location
        $page_link=str_replace("-", '/', $request->page_link);
        $idInfos=DB::table('t_module_service_mapping as t1')
                    ->select('t1.module_id','t1.service_id')
                    ->where('t1.page_link',$page_link)
                    ->get();
        $starCategoryLists=DB::table('t_star_category')
                             ->select('star_category_id','star_category_name')
                             ->get();
        return view($page_link, compact('location','idInfos','starCategoryLists'));
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
    public function store(CreateServiceRequest $request)
    {
         // dd('yass');
        $saveData = $this->serviceModel->saveApplicantDetails($request);
        return redirect()->back()->with('msg','Data save successfully');
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
}
