<?php

namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceRequest;
use App\Models\Services\ServiceModel;
use App\Models\Services\StarCategoryModel;
use App\Models\Services\CheckListStandardModel;
use App\Models\Services\CheckListChapterModel;
use App\Models\Services\CheckListAreaModel;
use App\HotelChapter;
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
    public function getCheckList(Request $request){
    //$checkList = $this->serviceModel->getCheckList($request);
    
    $moduleId=$request->module_id;
    $starCategoryId=$request->star_category_id;
    $chapterList=CheckListChapterModel::where('module_id',$moduleId)->get();
    return view('checklist', compact('chapterList','starCategoryId'));
    }

    public static function getChapterAreaList($chapterId,$starCategoryId){
        $chapterarea = HotelChapter::getChapter($starCategoryId,$chapterId);
        return  $chapterarea;
    }

    public static function getStandardList($starCategoryId,$checkListAreaId){
        $standard =DB::table('t_checklist_standard as t1')
                    ->leftjoin('t_checklist_standard_mapping as t2','t1.checklist_id','=','t2.checklist_id')
                    ->leftjoin('t_basic_standard as t3','t2.standard_id','=','t3.standard_id')
                    ->select('t1.checklist_standard','t1.checklist_pts', 't3.standard_code','t1.checklist_area_id')
                    ->where('t2.star_category_id', $starCategoryId AND 't1.checklist_area_id',$checkListAreaId)
                    ->get();
        return  $standard;
    }
    public function index(Request $request)
    {
        // fetching location
        $page_link=str_replace("-", '/', $request->page_link);
        $idInfos=DB::table('t_module_service_mapping as t1')
                    ->select('t1.module_id','t1.service_id')
                    ->where('t1.page_link',$page_link)
                    ->get();
        $starCategoryLists=StarCategoryModel::all('star_category_id','star_category_name');
        return view($page_link, compact('idInfos','starCategoryLists'));
    }
    public function addDocuments(Request $request)
    {
    
    
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
