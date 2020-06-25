<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TCheckListChapter;
use App\Models\TaskDetails;

class TouristStandardHotelController extends Controller
{
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }

    public function getApplicationDetails($applicationNo){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $moduleId= $data['applicantInfo']->module_id;
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");

        if($serviceId==1){
        //Technical clearance Details for hotel
        return view('services.approver.approve_technical_clearance',$data);
        }
        elseif($serviceId==4){
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

        elseif($serviceId==7){
            //Tourism standard hotel license renew Details
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approver.approve_hotel_license_renew',$data);
        }
        elseif($serviceId==8){
            //Tourism standard hotel license cancel Details
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approver.approve_hotels_license_cancel',$data);
        }

        elseif($serviceId==9){
            //Tourism standard hotel ownership change Details
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approver.approve_hotel_ownership_change',$data);
        }
        elseif($serviceId==10){
            //Tourism standard hotel name change Details
            $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
            return view('services.approver.approve_hotel_name_change',$data);
        }
    }

     //Approval function for technical clearance application
     public function hotelTechnicalClearanceApplication(Request $request){
        if($request->status =='APPROVED'){
           // insert into t_technical_clearances
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
       return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

       }else{
           $rejectId = WorkFlowDetails::getStatus('REJECTED');
           $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
           $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
           ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
           return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
           }
    }
    
   //Approval function for tourist stnadard hotel assessment application
   public function standardHotelAssessmentApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_techt_tourist_standard_dtlsnical_clearances
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
            $applicantdata[]= [    
                'module_id'   => $request->module_id,
                'cid_no'   => $request->cid_no,
                'star_category_id'   => $request->star_category_id,
                'license_no'   => $request->license_no,
                'license_date'   => date('Y-m-d', strtotime($request->license_date)),
                'tourist_standard_name'   => $request->tourist_standard_name,
                'owner_name'   => $request->owner_name,
                'address'   => $request->address,
                'contact_no'   => $request->contact_no,
                'fax'   => $request->fax,
                'email'   => $request->email,
                'webpage_url'   => $request->webpage_url,
                'bed_no'   => $request->bed_no,
                'village_id'   => $request->village_id,
                'inspection_date'   =>date('Y-m-d', strtotime($request->inspection_date)),
                'validaty_date'   =>now()->addYears(3),
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
            $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);
            // insert into t_room_dtls
            $roomInfoData = [];
            if(isset($_POST['room_type_id'])){
                foreach($request->room_type_id as $key => $value){
                $roomInfoData[] = [
                             'tourist_standard_id' =>  $id,
                             'room_type_id'   => $request->room_type_id[$key],
                             'room_no'   => $request->room_no[$key],
                             'created_at'   => now(),
                             'updated_at'   => now(),
                    ];
                 }
                $this->services->insertDetails('t_room_dtls',$roomInfoData);
            }
             // insert into t_staff_dtls
             $staffInfoData = [];
             if(isset($_POST['staff_area_id'])){
                 foreach($request->staff_area_id as $key => $value){
                 $staffInfoData[] = [
                              'tourist_standard_id' =>  $id,
                              'staff_area_id'   => $request->staff_area_id[$key],
                              'hotel_div_id'   => $request->hotel_div_id[$key],
                              'staff_name'   => $request->staff_name[$key],
                              'staff_gender'   => $request->staff_gender[$key],
                              'created_at'   => now(),
                              'updated_at'   => now(),
                     ];
                  }
                 $this->services->insertDetails('t_staff_dtls',$staffInfoData);
             }

               // insert into t_checklist_dtls
               $checklistData = [];
               if(isset($_POST['checklist_id'])){
                   foreach($request->checklist_id as $key => $value){
                   $checklistData[] = [
                                'tourist_standard_id' =>  $id,
                                'checklist_id'   => $request->checklist_id[$key],
                                'checklist_pts'   => $request->checklist_pts[$key],
                                'created_at'   => now(),
                                'updated_at'   => now(),
                       ];
                    }
                   $this->services->insertDetails('t_checklist_dtls',$checklistData);
               }
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }
        }
     //Approval function for tourist standard hotel licexnse renew application
     public function hotelLicenseRenewApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'license_date'=> date('Y-m-d', strtotime($request->license_date))

             );
            $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);
           
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }

     }   
   
      //Approval function for tourist standard hotel owner change application
     public function hotelOwnerShipChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'owner_name' => $request->owner_name,
                'cid_no' => $request->cid_no,
                'address' => $request->address, 
                'contact_no' => $request->contact_no,
				'email' => $request->email
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);

            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }

     }

     //Approval function for tourist standard hotel name change application
     public function hotelNameChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'tourist_standard_name' => $request->tourist_standard_name,
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);

            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }

     }

      //Approval function for tourist standard hotel license Cancel application
      public function hotelLicenseCancelApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_tourist_standard_dtls
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_tourist_standard_dtls_autit
            $savedatatoaudit=Services::saveTouristStandardHotelDtlsAudit($request->license_no);

              //update data to t_tourist_standard_dtls
              $data = array(
                'is_active' => 'N',
             );
             $updatedata=Services::updateApplicantDtls('t_tourist_standard_dtls','license_no',$request->license_no,$data);

            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
        return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }

     }
}
