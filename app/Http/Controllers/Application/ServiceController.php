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
        $data['officeInfos'] = Dropdown::getDropdowns("t_offices","id","office_name","0","0");
        $data['officeEquipments'] = Services::getOfficeEquipmentDetails('O');
        $data['trekkingEquipments'] = Services::getOfficeEquipmentDetails('T');
        $data['communicationFacilities'] = Services::getOfficeEquipmentDetails('C');
        $data['employments'] = Dropdown::getDropdowns("t_employments","id","employment_name","0","0");
        $data['transportations'] = Dropdown::getDropdowns("t_vehicles","id","vehicle_name","0","0");
        $data['channelTypes'] = Dropdown::getDropdowns("t_channel_types","id","channel_type","0","0");
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");
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
            $data->applicant_name=$request->applicant_name;
            $data->end_user_id=auth()->user()->id;
            $data->cid_no=$request->cid_no;
            $data->company_title_name=$request->company_title_name;
            $data->company_name_one=$request->company_name_one;
            $data->company_name_two=$request->company_name_two;
            $data->location=$request->location;
            $data->location_id=$request->location_id;
            $data->contact_no=$request->contact_no;
            $data->tentative_cons=$request->tentative_cons;
            $data->tentative_com=$request->tentative_com;
            $data->drawing_date=$request->drawing_date;
            $data->email=$request->email;
            $data->star_category_id=$request->star_category_id;
            $data->license_no=$request->license_no;
            $data->owner_name=$request->owner_name;
            $data->address=$request->address;
            $data->webpage_url=$request->webpage_url;
            $data->number=$request->number;
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
            $data->gender=$request->gender;
            $data->dob=$request->dob;
            $data->applicant_flat_no=$request->applicant_flat_no;
            $data->applicant_building_no=$request->applicant_building_no;
            $data->applicant_location=$request->applicant_location;
            $data->date=$request->date;
            $data->from_date=$request->from_date;
            $data->to_date=$request->to_date;
            $data->financial_year=$request->financial_year;
            $data->gewog_id=$request->gewog_id;
            $data->village_id=$request->village_id;
            $data->city=$request->city;
            $data->country_id=$request->country_id;
            $data->visit_purpose=$request->visit_purpose;
            $data->sell_destination=$request->sell_destination;
            $data->sell_bhutan=$request->sell_bhutan;
            $data->destination_year=$request->destination_year;
            $data->bhutan_year=$request->bhutan_year;
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
					 'staff_area_id'  => $staff_area_id[$key],
					  'hotel_div_id'  => $hotel_div_id[$key],
					    'staff_name'  => $staff_name[$key],
					  'staff_gender'  => $staff_gender[$key],
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
					  'checklist_id'  => $checklist_id[$key]
                    ];
                }
                $this->services->insertIntoCheckListApplication($checklistData);
            }

             //insert into t_member_applications
             $member_name=$request->member_name;
             $relation_type_id=$request->relation_type_id;
             $member_age=$request->member_age;
             $member_gender=$request->member_gender;
             $membersDetailsData = [];

             if(isset($member_name)){
				foreach($member_name as $key => $value)
				{
                    $membersDetailsData[] = [    
                      'application_no'  => $application_no,
                         'member_name'  => $member_name[$key],
                    'relation_type_id'  => $relation_type_id[$key],
                          'member_age'  => $member_age[$key],
                       'member_gender'  => $member_gender[$key]
                    ];
                }
                $this->services->insertMemberApplication($membersDetailsData);
            }
            
             //insert into t_partner_applications
             $partnerDetailsData = [];
             if(isset($_POST['partner_name'])){
                    $partnerDetailsData[] = [    
                         'application_no'   => $application_no,
                           'partner_name'   => $request->partner_name,
                         'partner_cid_no'   => $request->partner_cid_no,
                         'partner_gender'   => $request->partner_gender,
                            'partner_dob'   => date('Y-m-d', strtotime($request->partner_dob)),
                        'partner_flat_no'   => $request->partner_flat_no,
                    'partner_building_no'   => $request->partner_building_no,
                       'partner_location'   => $request->partner_location,
                     'partner_village_id'   => $request->partner_village_id
                    ];
                $this->services->insertPartnerApplication($partnerDetailsData);
            }
 
            //insert into office application
		    $officeInfoData = [];
            if(isset($_POST['office_id'])){
                foreach($request->office_id as $key => $value){
                $officeInfoData[] = [
                        'application_no'   => $application_no,
                             'office_id'   => $request->office_id[$key],
                         'office_status'   =>$request->office_status[$key],
                    ];
                 }

                $this->services->insertOfficeApplication($officeInfoData);
            }

            //insert into office equipment application
		    $officeEquipmentData = [];
            if(isset($_POST['equipment_id'])){
                foreach($request->equipment_id as $key => $value){
                $officeEquipmentData[] = [
                          'application_no' => $application_no,
                            'equipment_id' => $request->equipment_id[$key],
                        'equipment_status' =>$request->equipment_status[$key],
                    ];
                 }

                $this->services->insertOfficeEquipmentApplication($officeEquipmentData);
            }

             //insert into employment application
		    $employmentData = [];
            if(isset($_POST['employment_id'])){
                foreach($request->employment_id as $key => $value){
                $employmentData[] = [
                           'application_no'  => $application_no,
                            'employment_id'  => $request->employment_id[$key],
                        'employment_status'  =>$request->employment_status[$key],
                              'nationality'  =>  $request->nationality[$key],

                    ];
                 }

                $this->services->insertEmploymentApplication($employmentData);
            }

            //insert into employment application
            $transportationData = [];
            if(isset($_POST['vehicle_id'])){
                foreach($request->vehicle_id as $key => $value){
                $transportationData[] = [
                          'application_no' => $application_no,
                              'vehicle_id' => $request->vehicle_id[$key],
                        'transport_status' => $request->transport_status[$key],
                                 'fitness' =>  $request->fitness[$key],

                    ];
                    }

                $this->services->insertTransportationApplication($transportationData);
            }

              // insert into t_organizer_applications
              $organizerInfoData = [];
              if(isset($_POST['organizer_name'])){				
                     $organizerInfoData[] = [    
                        'application_no'   => $application_no,
                        'organizer_name'   => $request->organizer_name,
                     'organizer_address'   => $request->organizer_address,
                       'organizer_phone'   => $request->organizer_phone,
                       'organizer_email'   => $request->organizer_email,
                        'organizer_type'   => $request->organizer_type,
                      'amount_requested'   => $request->amount_requested
                     ];
                 $this->services->insertOrganizerInfo($organizerInfoData);
             }

            //insert into employment application
            $eventItemData = [];
            if(isset($_POST['items_name'])){
                foreach($request->items_name as $key => $value){
                $eventItemData[] = [
                        'application_no' => $application_no,
                           'items_name'  => $request->items_name[$key],
                           'item_costs'  => $request->item_costs[$key],

                    ];
                }

                $this->services->insertEventItemsApplication($eventItemData);
            }
            
            //insert intot_product_applications
            $productItemData = [];
            if(isset($_POST['type'])){
                $productItemData[] = [
                        'application_no' => $application_no,
                                 'type'  => $request->type,
                             'location'  => $request->location,
                            'objective'  => $request->objective,
                          'product_des'  => $request->product_des,
                         'project_cost'  => $request->project_cost,
                             'timeline'  => $request->timeline,
                         'contribution'  => $request->contribution,
                    ];
                $this->services->insertProductItemsApplication($productItemData);
            }

            //insert intot t_channel_applications
            $channelInfoData = [];
            if(isset($_POST['channel_name'])){
                foreach($request->channel_name as $key => $value){
                    $channelInfoData[] = [
                         'application_no'  => $application_no,
                        'channel_type_id'  => $request->channel_type_id[$key],
                           'channel_name'  => $request->channel_name[$key],
                            'circulation'  => $request->circulation[$key],
                        'target_audience'  => $request->target_audience[$key],
                    ];
                }
                $this->services->insertChannelApplication($channelInfoData);
            }
            
            //insert intot t_dist_channel_applications
            $channelCoverageData = [];
            if(isset($_POST['area_coverage'])){
                foreach($request->area_coverage as $key => $value){
                    $channelCoverageData[] = [
                        'application_no'  => $application_no,
                         'area_coverage'  => $request->area_coverage[$key],
                         'channel_name'   => $request->channel[$key],
                         'channel_link'   => $request->channel_link[$key],
                      'channel_type_id'   => $request->channel_type[$key],
                        'intended_date'   =>date('Y-m-d', strtotime($request->intended_date[$key])),

                    ];
                }
                $this->services->insertChannelCoverageApplication($channelCoverageData);
            }

             //insert intot t_channel_applications
             $marketingInfoData = [];
             if(isset($_POST['country'])){
                 foreach($request->country as $key => $value){
                     $marketingInfoData[] = [
                          'application_no'  => $application_no,
                              'country_id'  => $request->country[$key],
                                    'city'  => $request->city_name[$key],
                     ];
                 }
                 $this->services->insertMarketingInfoApplication($marketingInfoData);
             }

              //insert intot t_activity_applications
              $marketinActivitiesData = [];
              if(isset($_POST['activities'])){
                  foreach($request->activities as $key => $value){
                      $marketinActivitiesData[] = [
                           'application_no'  => $application_no,
                               'activities'  => $request->activities[$key],
                      ];
                  }
                  $this->services->insertMarketingActivitiesApplication($marketinActivitiesData);
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
