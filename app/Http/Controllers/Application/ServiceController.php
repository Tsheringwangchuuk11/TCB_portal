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
        
        //Technical clearance
        if($data['idInfos']->service_id==1 && $data['idInfos']->module_id==1){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['purposes'] =Dropdown::getDropdownList("6");
            $data['accommodationtypes'] =Dropdown::getDropdownList("7");
        }

        //Tourist standard hotel assessment
        else if($data['idInfos']->service_id==3 && $data['idInfos']->module_id==1){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            $data['roomTypeLists'] = Dropdown::getDropdownList("1");
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["31","32"]);
        }

        //recommendation letter for import license
        else if($data['idInfos']->service_id==4 && $data['idInfos']->module_id==1){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        }

        //work_permit
        else if($data['idInfos']->service_id==5 && $data['idInfos']->module_id==1){
            $data['countries'] = Dropdown::getDropdownList("3");
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['recommendation_letter_types'] =  Dropdown::getApplicationType("9",$dropdownId[]=["36","37","38","39","40"]);
        }

        //hotel_ownership_name_cancellation
        else if($data['idInfos']->service_id==6 && $data['idInfos']->module_id==1){
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["33","34","35"]);
        }
        
        //home_stays_assessment
        else if($data['idInfos']->service_id==7 && $data['idInfos']->module_id==2){
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["31","32"]);
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['relationTypes'] =  Dropdown::getDropdownList("4");
        }

        //restuarants_assessment
        else if($data['idInfos']->service_id==9 && $data['idInfos']->module_id==3){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        }

        //restuarant_ownership_name_change
        else if($data['idInfos']->service_id==10 && $data['idInfos']->module_id==3){
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["33","34"]);
        }

        //to_license_clearance_new _license
        else if($data['idInfos']->service_id==2 && $data['idInfos']->module_id==4){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        }

        //to_name_ownership_location_change
        else if($data['idInfos']->service_id==11 && $data['idInfos']->module_id==4){
            $data['applicationTypes'] = Dropdown::getApplicationType("8",$dropdownId[]=["33","34","41"]);
        }

        //recommandation_letter_for_tourism_industry_partners
        else if($data['idInfos']->service_id==13 && $data['idInfos']->module_id==4){
            $data['applicationTypes'] = Dropdown::getApplicationType("9",$dropdownId[]=["43","44"]);
            $data['eventFairDetails'] = Services::getTravelEventFairDetails();

        }

        //grievance
        else if($data['idInfos']->service_id==18 && $data['idInfos']->module_id==6){
            $data['serviceproviders'] =Dropdown::getDropdownList("5");
            $data['applicantTypes'] =Dropdown::getDropdownList("2");

        }

        //media_familiarization_tour
        else if($data['idInfos']->service_id==19 && $data['idInfos']->module_id==7){
            $data['countries'] = Dropdown::getDropdownList("3");
           // $data['channelTypes'] = Dropdown::getDropdowns("t_channel_types","id","channel_type","0","0");
        }

        //registered_tourism_events_list
        else {
            $data['eventFairDetails'] = Services::getTravelEventFairDetails();
        }

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
                    ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId)
                    ->where('t_check_list_standard_mappings.is_active','=','1');
            }]);
        }])->where('module_id','=',$request->module_id)
        ->get();
        return view('services.new_application.hotel_checklist', compact('checklistDtls','starCategoryId'));
    }

    public function getHomeStayCheckListChapter(Request $request){
            $checklistDtls =  TCheckListChapter::with(['chapterAreas' => function($q){
                $q->with(['checkListStandards'=> function($query){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                        ->where('t_check_list_standard_mappings.is_active','=','1');
                }]);
            }])->where('module_id','=',$request->module_id)
            ->get();
        return view('services.new_application.homestay_checklist', compact('checklistDtls'));
    }

    public function  getRestaurantCheckListChapter(Request $request){
        $checklistDtls =  TCheckListChapter::with(['chapterAreas' => function($q){
            $q->with(['checkListStandards'=> function($query){
                $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                ->where('t_check_list_standard_mappings.is_active','=','1');
            }]);
            }])->where('module_id','=',$request->module_id)
            ->get();
        return view('services.new_application.restaurant_checklist', compact('checklistDtls'));
     }

    public function getTouristHotelDetails($licenseNo){
         $data=Services::getTouristHotelDetails($licenseNo);
         return response()->json($data);
    }

    //Technical clearance details
    public function getTechCleranceDtls($dispatch_no){
        $data=Services::getTechCleranceDtls($dispatch_no);
        return response()->json($data);
    }

    public function getVillageHomeStayDetails($cidNo){
        $data=Services::getVillageHomeStayDetails($cidNo);
        return response()->json($data);
    }

    public function getTourOperatorDetails($licenseNo){
        $data=Services::getTourOperatorDetails($licenseNo);
        return response()->json($data);
    }

     public function getCompnayName(Request $request){
         $companyName=$request->companyName;
         $checkPresent=Services:: checkCompanyNameExists($companyName);
          return response()->json($checkPresent);
     }

     public function getEventRegisteredDetails($eventId,$serviceId,$moduleId){
        $eventdtl = Services::getEventRegisteredDetails($eventId);
        $companyTypes= Dropdown::getDropdownList("10");
        return view('services/registration_for_tourism_events', compact('eventdtl','serviceId','moduleId','companyTypes'));
    }

    //check dispatch Number
    public function checkDispatchNumber(Request $request){
        $present= Services::checkDispatchNumber($request->dispatch_no);
        return response()->json($present);
    }

    //delete record from database
    public function deleteDataRecord(Request $request){
      $flag= Services::deleteDataRecord($request->recordId,$request->table_name);
      return response()->json($flag);
    }
    public function saveNewApplication(Request $request){
       //dd($request->all());
        $application_no = $this->services->generateApplNo($request);
        DB::transaction(function () use ($request, $application_no) {
            //insert into t_application
            $data=new Services;
            $data->application_no=$application_no;
            $data->module_id=$request->module_id;
            $data->service_id=$request->service_id;
            $data->applicant_name=$request->applicant_name;
            $data->applicant_id=auth()->user()->id;
            $data->application_type_id=$request->application_type_id;
            $data->event_id=$request->event_id;
            $data->cid_no=$request->cid_no;
            $data->new_cid_no=$request->new_cid_no;
            $data->owner_name=$request->owner_name;
            $data->new_owner_name=$request->new_owner_name;
            $data->manager_name=$request->manager_name;
            $data->manager_mobile_no=$request->manager_mobile_no;
            $data->gender=$request->gender;
            $data->dob=$request->dob;
            $data->designation=$request->designation;
            $data->applicant_flat_no=$request->applicant_flat_no;
            $data->applicant_building_no=$request->applicant_building_no;
            $data->applicant_location=$request->applicant_location;
            $data->company_title_name=$request->company_title_name;
            $data->company_name_one=$request->company_name_one;
            $data->company_name_two=$request->company_name_two;
            $data->contact_no=$request->contact_no;
            $data->new_contact_no=$request->new_contact_no;
            $data->tentative_cons=$request->tentative_cons;
            $data->tentative_com=$request->tentative_com;
            $data->drawing_date=$request->drawing_date;
            $data->email=$request->email;
            $data->new_email=$request->new_email;
            $data->star_category_id=$request->star_category_id;
            $data->license_no=$request->license_no;
            $data->license_date=$request->license_date;
            $data->address=$request->address;
            $data->new_address=$request->new_address;
            $data->fax=$request->fax;
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
            $data->permanent_village_id=$request->permanent_village_id;
            $data->establishment_village_id=$request->establishment_village_id;
            $data->new_village_id=$request->new_village_id;
            $data->chiwog_id=$request->chiwog_id;
            $data->city=$request->city;
            $data->country_id=$request->country_id;
            $data->from_date=$request->from_date;
            $data->to_date=$request->to_date;
            $data->remarks=$request->remarks;
            $data->save();
            
            //insert into t_room_applications
		    $roomAppData = [];
            if(isset($_POST['room_type_id'])){
                foreach($request->room_type_id as $key => $value){
                $roomAppData[] = [
                        'application_no' => $application_no,
                          'room_type_id' => $request->room_type_id[$key],
                               'room_no' => $request->room_no[$key],
                    ];
                 }

                $this->services->insertDetails('t_room_applications',$roomAppData);
            }

            //insert into t_staff_applications
            $staffAppData = [];
            if(isset($_POST['staff_cid_no'])){
				foreach($request->staff_cid_no as $key => $value)
				{
                    $staffAppData[] = [
                    'application_no' => $application_no,
					 'staff_cid_no'  => $request->staff_cid_no[$key],
					   'staff_name'  => $request->staff_name[$key],
					 'staff_gender'  => $request->staff_gender[$key],
                      'staff_designation'  => $request->staff_designation[$key],
                    'qualification'  => $request->qualification[$key],
                       'experience'  => $request->experience[$key],
                           'salary'  => $request->salary[$key],
               'hospitility_relating'=> $request->hospitility_relating[$key],
                    ];
                }
                $this->services->insertDetails('t_staff_applications',$staffAppData);
            }

            //insert into t_checklist_applications
                $checklistData = [];
				for ($i=0; $i < count($_POST['checklist_id']); $i++)
				{
                   if($request->checkvalue[$i] == 1){
                    $checklistData[] = [
                        'application_no'  => $application_no,
                        'checklist_id'  => $request->checklist_id[$i],
                        'assessor_score_point'  => $request->assessor_score_point[$i],
                        'assessor_rating'  => $request->assessor_rating[$i],
                    ];
                   }
                }
                $this->services->insertDetails('t_checklist_applications',$checklistData);

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
                $this->services->insertDetails('t_member_applications',$membersDetailsData);
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
                $this->services->insertDetails('t_partner_applications',$partnerDetailsData);
            }

            //insert into office application
		    $officeInfoData = [];
            if(isset($_POST['office_id'])){
                foreach($request->office_id as $key => $value){
                $index = $_POST['office_status'][$key];
                $officeInfoData[] = [
                        'application_no'   => $application_no,
                             'office_id'   => $request->office_id[$key],
                         'office_status'   =>$_POST['office_status'.$index],
                    ];
                 }
                $this->services->insertDetails('t_office_applications',$officeInfoData);
            }

            //insert into office equipment application
		    $officeEquipmentData = [];
            if(isset($_POST['equipment_id'])){
                foreach($request->equipment_id as $key => $value){
                $index = $_POST['equipment_status'][$key];
                $officeEquipmentData[] = [
                          'application_no' => $application_no,
                            'equipment_id' => $request->equipment_id[$key],
                        'equipment_status' =>$_POST['equipment_status'.$index],
                    ];
                 }

                $this->services->insertDetails('t_equipment_applications',$officeEquipmentData);
            }

             //insert into employment application
		    $employmentData = [];
            if(isset($_POST['employment_id'])){
                foreach($request->employment_id as $key => $value){
                    $index = $_POST['employment_status'][$key];
                    $index = $_POST['nationality'][$key];

                $employmentData[] = [
                           'application_no'  => $application_no,
                            'employment_id'  => $request->employment_id[$key],
                        'employment_status'  =>$_POST['employment_status'.$index],
                              'nationality'  =>$_POST['nationality'.$index],

                    ];
                 }
                $this->services->insertDetails('t_employment_applications',$employmentData);
            }

            //insert into employment application
            $transportationData = [];
            if(isset($_POST['vehicle_id'])){
                foreach($request->vehicle_id as $key => $value){
                $index = $_POST['transport_status'][$key];
                $index1 = $_POST['fitness'][$key];
                $transportationData[] = [
                          'application_no' => $application_no,
                              'vehicle_id' => $request->vehicle_id[$key],
                        'transport_status' => $_POST['transport_status'.$index],
                                 'fitness' => $_POST['fitness'.$index1],
                         ];
                    }

                $this->services->insertDetails('t_transport_applications',$transportationData);
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
                 $this->services->insertDetails('t_organizer_applications',$organizerInfoData);
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

                $this->services->insertDetails('t_item_applications',$eventItemData);
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
                $this->services->insertDetails('t_product_applications',$productItemData);
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
                $this->services->insertDetails('t_channel_applications',$channelInfoData);
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
                $this->services->insertDetails('t_dist_channel_applications',$channelCoverageData);
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
                 $this->services->insertDetails('t_market_applications',$marketingInfoData);
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
                  $this->services->insertDetails('t_activity_applications',$marketinActivitiesData);
              }
            //insert into t_work_permit_applications
             $workpermitData = [];
             if(isset($_POST['passport_no'])){
                foreach($request->passport_no as $key => $value){
                    $workpermitData[] = [
                         'application_no'   => $application_no,
                           'name'   => $request->name[$key],
                         'passport_no'   => $request->passport_no[$key],
                         'start_date'   => date('Y-m-d', strtotime($request->start_date[$key])),
                          'end_date'   => date('Y-m-d', strtotime($request->end_date[$key])),
                        'country_id'   => $request->nationality[$key],
                    ];
                }
                $this->services->insertDetails('t_work_permit_applications',$workpermitData);
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

    public function saveGrievanceApplication(Request $request){
       // dd($request->all());
        $application_no = $this->services->generateApplNo($request);
        DB::transaction(function () use ($request, $application_no) {
            //insert into t_grievance_applications
            if(isset($_POST['applicant_type'])){
                if($request->complainant_name !=null){
                    $complainant_name=$request->complainant_name;
                }
                else
                {
                    $complainant_name=$request->representative_name;
                }
            $grievanceData[] = [
                    'application_no'  => $application_no,
                    'complainant_name'  => $complainant_name ,
                    'complainant_address'  => $request->complainant_address,
                    'complainant_mobile_no'  => $request->complainant_mobile_no,
                    'complainant_telephone_no'  => $request->complainant_telephone_no,
                    'complainant_email'  => $request->complainant_email,
                    'applicant_type'  => $request->applicant_type,
                    'respondent_name'  => $request->respondent_name,
                    'respondent_address'  => $request->respondent_address,
                    'respondent_mobile_no'  => $request->respondent_mobile_no,
                    'respondent_telephone_no'  => $request->respondent_telephone_no,
                    'respondent_email'  => $request->respondent_email,
                    'service_provider_id'  => $request->service_provider_id,
                    'claim_summary'  => $request->claim_summary,
                    'remedy_sought'  => $request->remedy_sought,
                    'location_id'  => $request->location_id,
                    'date'  =>date('Y-m-d', strtotime($request->date)),
           ];
           $this->services->insertDetails('t_grievance_applications',$grievanceData);
          // update application_no in t_documents
           $documentId = $request->documentId;
           $this->services->updateDocumentDetails($documentId,$application_no);
          }
        });
        return redirect('application/new-application')->with('appl_info', 'Your application has been submitted successfully and your application number is :'.$application_no);
    }
}
