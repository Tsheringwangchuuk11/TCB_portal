<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;
use App\Models\TechnicalClearance;
use App\Models\TaskDetails;
class ApproverController extends Controller
{
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    public function openApplication($applicationNo,$serviceId,$moduleId){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");

        if($serviceId==1 && $moduleId==1){
             //Technical clearance Details
            return view('services.approver.approve_technical_clearance',$data);
        }
    
        elseif($serviceId==4 && $moduleId==1){
            //Tourism standard hotel assesment Details
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            $data['roomTypeLists'] = Dropdown::getDropdowns("t_room_types","id","room_name","0","0");
            $data['staffAreaLists'] = Dropdown::getDropdowns("t_staff_areas","id","staff_area_name","0","0");
            $data['hotelDivisionLists'] = Dropdown::getDropdowns("t_hotel_divisions","id","hotel_div_name","0","0");
            $data['roomInfos']=Services::getRoomDetails($applicationNo);
            $data['staffInfos']=Services::getStaffDetails($applicationNo);
            $starCategoryId=Services::getApplicantDetails($applicationNo)->star_category_id;
            $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo,$starCategoryId){
                $q->with(['checkListStandards'=> function($query) use($applicationNo,$starCategoryId){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                        ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                        ->where('t_checklist_applications.application_no','=',$applicationNo)
                        ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId);
                }]);
            }])->where('module_id','=',$moduleId)
            ->get();
            return view('services.approver.approve_hotels_assessment',$data);
        }
        elseif($serviceId==11 && $moduleId==4){
            //Proprietors Card Details
            return view('services.approver.approve_propreiter_card',$data);

        }
        elseif($serviceId==4 && $moduleId==4){
            //Tour operator Assessment Details
            $data['officeInfos']=Services::getOfficeInfoDetails($applicationNo);
            $data['officeEquipments']=Services::getOfficeEquipmentInfoDetails($applicationNo,'O');
            $data['communicationFacilities']=Services::getOfficeEquipmentInfoDetails($applicationNo,'C');
            $data['trekkingEquipments']=Services::getOfficeEquipmentInfoDetails($applicationNo,'T');
            $data['employments']=Services::getEmploymentInfoDetails($applicationNo);
            $data['transportations']=Services::getTransportationInfoDetails($applicationNo);
            return view('services.approver.approve_to_assessment',$data);

        }
        elseif($serviceId==14 && $moduleId==7){
            //Media familiarization tour Details
            $data['channelTypes'] = Dropdown::getDropdowns("t_channel_types","id","channel_type","0","0");
            $data['channelTypesInfos']=Services::getChannelInfoDetails($applicationNo);
            $data['channelCoverages']=Services::getChannelCoverageInfoDetails($applicationNo);
            return view('services.approver.approve_media_familiarization_tour',$data);
        }
        elseif($serviceId==18 && $moduleId==5){
              //Tourism product development
            $data['organizerInfo']=Services::getOrganizerInfoDetails($applicationNo);
            $data['itemsInfos']=Services::getItemInfoDetails($applicationNo);
            return view('services.approver.approve_tourism_product_development',$data);

        }
        elseif($serviceId==19 && $moduleId==5){
               //Tourism product proposal
            $data['productInfo']=Services::getProductInfoDetails($applicationNo);
            return view('services.approver.approve_tourism_product_proposal',$data);
        }
        elseif($serviceId==21 && $moduleId==4){
            //Tour operator license clearance Details
            $data['partnerInfo']=Services::getPartnerInfoDetails($applicationNo);
            return view('services.approver.approve_to_new _license',$data);
        }
    }
        
    //Approval function for technical clearance application
    public function hotelTechnicalClearanceApplication(Request $request){
         if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            $data[]= [    
                'cid_no'   => $request->cid_no,
                'name'   => $request->name,
                'contact_no'   => $request->contact_no,
                'gewog_id'   => $request->gewog_id,
                'location'   => $request->location,
                'proposed_rooms_no'   => $request->proposed_rooms_no,
                'tentative_cons'   => $request->tentative_cons,
                'tentative_com'   => $request->tentative_com,
                'drawing_date'   => date('Y-m-d', strtotime($request->drawing_date)),
                'email'   => $request->email,
                'submitted_by'   => $request->submitted_by,
                'created_at'   => now(),
                'updated_at'   => now(),
             ];
             
            $this->services->insertDetails('t_technical_clearances',$data);
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                       ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return response()->json(['status'=>'approved','msg'=>'Application approved successfully.']);
        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return response()->json(['rejected'=>'false','msg'=>'Application reject successfully.']);
            }
    }

    //Approval function for tour operator technical clearance application
    public function tourOperatorTechnicalClearanceApplication(Request $request){
        //return response()->json($request);
         if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
                $data[]= [    
                    'cid_no'   => $request->cid_no,
                    'name'   => $request->name,
                    'gender'   => $request->gender,
                    'dob'   => date('Y-m-d', strtotime($request->dob)),
                    'applicant_flat_no'   => $request->applicant_flat_no,
                    'applicant_building_no'   => $request->applicant_building_no,
                    'applicant_location'   => $request->applicant_location,
                    'company_name'   => $request->company_name,
                    'village_id'   => $request->village_id,
                    'location'   => $request->location,
                    'flat_no'   => $request->flat_no,
                    'building_no'   => $request->building_no,
                    'postal_address'   => $request->postal_address,
                    'contact_no'   => $request->contact_no,
                    'reference_no'   => $request->reference_no,
                    'remarks'   => $request->remarks,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
          //  $this->services->insertDetails('t_operator_clearances',$data);
             $id=Services::getLastInsertedId('t_operator_clearances',$data);
             $partnerData[]= [ 
                'operator_id' =>  $id,
                'partner_name'   => $request->partner_name,
                'partner_cid_no'   => $request->partner_cid_no,
                'partner_gender'   => $request->partner_gender,
                'partner_dob'   => date('Y-m-d', strtotime($request->partner_dob)),
                'partner_flat_no'   => $request->partner_flat_no,
                'partner_building_no'   => $request->partner_building_no,
                'partner_location'   => $request->partner_location,
                'village_id'   => $request->village_id,
                'created_at'   => now(),
                'updated_at'   => now(),
             ]; 
                
            $this->services->insertDetails('t_partner_dtls',$partnerData); 
        
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                       ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
            });
            return response()->json(['status'=>'approved','msg'=>'Application approved successfully.']);

        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return response()->json(['status'=>'reject','msg'=>'Application reject successfully.']);

            }
    }
}
