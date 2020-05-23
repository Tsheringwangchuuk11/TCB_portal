<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
use App\Models\TCheckListChapter;
class RestaurantController extends Controller
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
       
        if($serviceId==4){
        //Restuarant Checklist Details
        $data['staffAreaLists'] = Dropdown::getDropdowns("t_staff_areas","id","staff_area_name","0","0");
        $data['hotelDivisionLists'] = Dropdown::getDropdowns("t_hotel_divisions","id","hotel_div_name","0","0");
        $data['staffInfos']=Services::getStaffDetails($applicationNo);
        $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q) use($applicationNo){
            $q->with(['checkListStandards'=> function($query) use($applicationNo){
                $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                    ->where('t_checklist_applications.application_no','=',$applicationNo);
            }]);
        }])->where('module_id','=',$moduleId)
        ->get();
        return view('services.approver.approve_restaurant_assessment',$data);
        }
        elseif($serviceId==5){
            //Restuarant bar license Details
            return view('services.approver.approve_restaurant_assessment',$data);
        } 
        elseif($serviceId==7){
            //Restuarant bar license renew Details
            return view('services.approver.approve_restuarant_license_renew',$data);
        } 
        elseif($serviceId==8){
            //Restuarant bar license cancel Details
            return view('services.approver.approve_restuarant_license_cancel',$data);
        }

        elseif($serviceId==9){
            //Restuarant owner change Details
            return view('services.approver.approve_restuarant_owner_change',$data);
        }  
        elseif($serviceId==10){
            //Restuarant name change Details
            return view('services.approver.approve_restuarant_name_change',$data);
        }     
    }

     //Approval function for tourist stnadard hotel assessment application
   public function restaurantAssessmentApplication(Request $request){
    if($request->status =='APPROVED'){
        // insert into t_techt_tourist_standard_dtlsnical_clearances
        \DB::transaction(function () use ($request) {
            $approveId = WorkFlowDetails::getStatus('APPROVED');
            $completedId= WorkFlowDetails::getStatus('COMPLETED');

        $applicantdata[]= [    
            'module_id'   => $request->module_id,
            'cid_no'   => $request->cid_no,
            'license_no'   => $request->license_no,
            'license_date'   => date('Y-m-d', strtotime($request->license_date)),
            'tourist_standard_name'   => $request->tourist_standard_name,
            'owner_name'   => $request->owner_name,
            'address'   => $request->address,
            'contact_no'   => $request->contact_no,
            'fax'   => $request->fax,
            'email'   => $request->email,
            'webpage_url'   => $request->webpage_url,
            'village_id'   => $request->village_id,
            'inspection_date'   =>date('Y-m-d', strtotime($request->inspection_date)),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
        $id=Services::getLastInsertedId('t_tourist_standard_dtls',$applicantdata);
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

    //Approval function for tourist standard restaurant name change application
    public function restaurantNameChangeApplication(Request $request){
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

       //Approval function for tourist standard restaurant owner change application
       public function restaurantOwnerChangeApplication(Request $request){
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

      //Approval function for tourist standard restaurant license renew application
      public function restaurantLicenseRenewApplication(Request $request){
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

}
