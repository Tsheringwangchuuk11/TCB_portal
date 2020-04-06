<?php

namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateServiceRequest;
use App\Models\Services\ServiceModel;
use App\Models\Services\CheckListArea;
use App\Models\Services\CheckListStandard;
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

        $page_link=str_replace("-", '/', $request->page_link);
        $idInfos=DB::table('t_module_service_mapping as t1')
            ->join('t_service_master as t2', 't2.service_id', '=', 't1.service_id')
            ->join('t_module_master as t3', 't3.module_id', '=', 't1.module_id')
            ->select('t1.module_id','t1.service_id','t2.service_name','t3.module_name')
            ->where('t1.page_link',$page_link)
            ->get();

        $checklistchapter=DB::table('t_checklist_chapter')
            ->select('checklist_ch_id', 'checklist_ch_name')
            ->get();

        $starCategoryLists=DB::table('t_star_category')
            ->select('star_category_id','star_category_name')
            ->get(); 
              
        return view($page_link, compact('idInfos','starCategoryLists','checklistchapter'));
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

    public static function getCheckListArea($id){

        $area = CheckListArea::getCheckListArea($id);
        return $area;
    }

    public static function getCheckListStandard($id){
        $standard = CheckListStandard::where('checklist_area_id', $id)->get();
        return $standard;
    }
}
