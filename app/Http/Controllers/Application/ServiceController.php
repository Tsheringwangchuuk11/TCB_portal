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

    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    public function getModules()
    {
        $servicemodules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");
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
        $starCategoryLists = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $dzongkhagLists = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $roomTypeLists = Dropdown::getDropdowns("t_room_types","id","room_name","0","0");
        $staffAreaLists = Dropdown::getDropdowns("t_staff_areas","id","staff_area_name","0","0");
        $hotelDivisionLists = Dropdown::getDropdowns("t_hotel_divisions","id","hotel_div_name","0","0");
        return view($page_link, compact('idInfos','starCategoryLists','dzongkhagLists','roomTypeLists','staffAreaLists','hotelDivisionLists'));

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


    public function saveNewApplication(Request $request){
        DB::transaction(function () use ($request) {
            //insert into t_application
            $application_no = $this->services->generateApplNo($request);
            $data=new Services;
            $data->application_no=$application_no;
            $data->module_id=$request->module_id;
            $data->service_id=$request->service_id;
            $data->name=$request->name;
            $data->cid_no=$request->cid_no;
            $data->name_one=$request->name_one;
            $data->name_two=$request->name_two;
            $data->proposed_location=$request->proposed_location;
            $data->location_id=$request->location_id;
            $data->contact_no=$request->contact_no;
            $data->tentative_cons=$request->tentative_cons;
            $data->tentative_com=$request->tentative_com;
            $data->drawing_date=$request->drawing_date;
            $data->email=$request->email;
            $data->star_category_id=$request->star_category_id;
            $data->license_no=$request->license_no;
            $data->owner=$request->owner;
            $data->address=$request->address;
            $data->internet_url=$request->internet_url;
            $data->bed_no=$request->bed_no;
            $data->thram_no=$request->thram_no;
            $data->house_no=$request->house_no;
            $data->town_distance=$request->town_distance;
            $data->road_distance=$request->road_distance;
            $data->condition=$request->condition;
            $data->validity_date=$request->validity_date;
            $data->flat_no=$request->flat_no;
            $data->building_no=$request->building_no;
            $data->license_date=$request->license_date;
            $data->fax=$request->fax;
            $data->drawing_date=$request->drawing_date;
            $data->save();
            $this->services->insertIntoRoomApplication($request,$application_no);
            $this->services->insertIntoStaffApplication($request,$application_no);
            $this->services->updateDocumentDetails($request,$application_no);

        });

    }
}
