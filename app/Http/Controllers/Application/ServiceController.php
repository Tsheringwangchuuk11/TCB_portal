<?php

namespace App\Http\Controllers\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use Illuminate\Http\Request;
use DB;
use App\Models\Services;
use App\Models\Dropdown;
class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);

    }
    public function getModules()
    {
        $servicemodules = Dropdown::getDropdowns("t_module_master","module_id","module_name","0","0");
        return view('services/modules/module_services',compact('servicemodules'));  
    }

    public function getServices(Request $request)
    {
        $servicelist = Services::getServiceLists($request);
        return json_encode(array('data'=>$servicelist));
    }
    
    public function getServiceForm($page_link)
    {
        $page_link=str_replace("-", '/',$page_link);
        $idInfos = Services::getIdInfo($page_link);
<<<<<<< HEAD

        $starCategoryLists = Dropdown::getDropdowns("t_star_category","star_category_id","star_category_name","0","0");

        $dzongkhagLists = Dropdown::getDropdowns("t_dzongkhag_master","dzongkhag_id","dzongkhag_name","0","0");

        $checklistchapter=DB::table('t_checklist_chapter')
            ->select('checklist_ch_id', 'checklist_ch_name')
            ->get();
            
        return view($page_link, compact('idInfos','starCategoryLists','checklistchapter','dzongkhagLists'));
=======
        $starCategoryLists = Dropdown::getDropdowns("t_star_category","star_category_id","star_category_name","0","0");    
        return view($page_link, compact('idInfos','starCategoryLists'));
>>>>>>> 5cc1d1f2c47c0b8e8a0945098d3dddc42ea62e69
        
    }

    public static function getCheckListArea($id)
    {
        $area = Services::getCheckListArea($id);
        return $area;
    }

    public static function getCheckListStandard($id){
        $standard = Services::getCheckListStandard($id);
        return $standard;
    }
    public static function getCheckListChapter(Request $request){
        $starCategoryId=$request->star_category_id;
        $chapters=Services::getCheckListChapter($request);
        return view('services/checklist', compact('chapters','starCategoryId'));
    }

    public static function getChapterAreaList($chapterId,$starCategoryId){
        $chapterAreas=Services::getChapterArea($chapterId,$starCategoryId);
        return $chapterAreas;

    }
    public static function getStandardList($starCategoryId,$checkListAreaId){
        $standards=Services::getStandards($starCategoryId,$checkListAreaId);
        return $standards;
    }

    public function SaveNewApplication(Request $request){  
        $checklist_id=$request->checklist_pts;
		dd($checklist_id);
      $savedata=Services::SaveApplicantDetails($request);
    }
}
