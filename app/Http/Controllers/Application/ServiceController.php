<?php

namespace App\Http\Controllers\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceRequest;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\TaskDetails;
use App\Models\TCheckListChapter;
use App\Models\TCheckListStandard;
use DB;
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
        $data['idInfos'] = Services::getIdInfo($page_link);
        $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['roomTypeLists'] = Dropdown::getDropdowns("t_room_types","id","room_name","0","0");
        $data['staffAreaLists'] = Dropdown::getDropdowns("t_staff_areas","id","staff_area_name","0","0");
        $data['hotelDivisionLists'] = Dropdown::getDropdowns("t_hotel_divisions","id","hotel_div_name","0","0");
        $data['relationTypes'] = Dropdown::getDropdowns("t_relation_types","id","relation_type","0","0");
        return view($page_link, $data);

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
        $moduleId = $request->module_id;

        $checklistDtls =  TCheckListChapter::with(['chapterAreas' => function($q) use($starCategoryId){
            $q->with(['checkListStandards'=> function($query) use($starCategoryId){
                $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                    ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId);
            }]);
        }])->where('module_id','=',$request->module_id)
        ->get();
        return view('services/hotel_checklist', compact('checklistDtls'));
    }

    public function getHomeStayCheckListChapter(Request $request){
            $checklistDtls =  TCheckListChapter::with(['chapterAreas' => function($q){
                $q->with(['checkListStandards'=> function($query){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id');
                }]);
            }])->where('module_id','=',$request->module_id)
            ->get();
        return view('services/homestay_checklist', compact('checklistDtls'));
    }
    public function getOwnerShipDetails($licenseNo){
         $data=Services::getOwnerShipDetails($licenseNo);
         return response()->json($data);
    }
    public function saveNewApplication(Request $request){
        $application_no = $this->services->generateApplNo($request);
        DB::transaction(function () use ($request, $application_no) {
            //insert into t_application
            $data=new Services;
            $data->application_no=$application_no;
            $data->module_id=$request->module_id;
            $data->service_id=$request->service_id;
            $data->name=$request->name;
            $data->end_user_id=auth()->user()->id;
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

            //insert into t_room_applications
            $room_type_id=$request->room_type_id;
		    $room_no=$request->room_no;
		    $roomAppData = [];
            if(isset($room_type_id)){
                foreach($room_type_id as $key => $value){
                $roomAppData[] = [
                        'application_no' => $application_no,
                          'room_type_id' => $room_type_id[$key],
                               'room_no' => $room_no[$key],
                    ];
                 }

                $this->services->insertIntoRoomApplication($roomAppData);
            }

            //insert into t_staff_applications
            $staff_area_id=$request->staff_area_id;
            $hotel_div_id=$request->hotel_div_id;
            $staff_name=$request->staff_name;
            $staff_gender=$request->staff_gender;
            $staffAppData = [];
            if(isset($staff_area_id)){
				foreach($staff_area_id as $key => $value)
				{
                    $staffAppData[] = [
                    'application_no'  => $application_no,
					'staff_area_id'   => $staff_area_id[$key],
					'hotel_div_id'    => $hotel_div_id[$key],
					'staff_name'      => $staff_name[$key],
					'staff_gender'    => $staff_gender[$key],
                    ];
                }
                $this->services->insertIntoStaffApplication($staffAppData);
            }

            //insert into t_checklist_applications
             $checklist_id=$request->checklist_id;
             $checklistData = [];
            if(isset($checklist_id)){
				foreach($checklist_id as $key => $value)
				{
                    $checklistData[] = [    
                    'application_no'  => $application_no,
					'checklist_id'   => $checklist_id[$key]
                    ];
                }
                $this->services->insertIntoCheckListApplication($checklistData);
            }

	        //update application_no in t_documents
             $documentId = $request->documentId;
             $this->services->updateDocumentDetails($documentId,$application_no);

            //insert into t_workflow_dtls
            $update=new WorkFlowDetails;
            $update->application_no=$application_no;
            $update->status_id=WorkFlowDetails::getStatus('SUBMITTED')->id;
            $update->user_id=auth()->user()->id;
            $update->save();

            //insert into t_task_dtls
            $update=new TaskDetails;
            $update->application_no=$application_no;
            $update->status_id=WorkFlowDetails::getStatus('INITIATED')->id;
            $update->assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id)->id;
            $update->save();

        });
        return redirect('application/new-application')->with('appl_info', 'Your application has been submitted successfully and your application number is :'.$application_no);
    }
}
