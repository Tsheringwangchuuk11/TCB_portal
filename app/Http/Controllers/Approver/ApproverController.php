<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;

class ApproverController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);

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
            $starCatsegoryIdId=Services::getApplicantDetails($applicationNo)->star_category_id;
            $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo,$starCategoryIdId){
                $q->with(['checkListStandards'=> function($query) use($applicationNo,$starCategoryIdId){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                        ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                        ->where('t_checklist_applications.application_no','=',$applicationNo)
                        ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryIdId);
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

    public function approveNewApplication(Request $request){
        $approveId = WorkFlowDetails::getStatus('APPROVED');
        $rejectId = WorkFlowDetails::getStatus('REJECTED');
    }
}
