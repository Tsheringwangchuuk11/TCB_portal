<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
use PDF;
class TourOperatorController extends Controller
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
        $letterSample= $data['applicantInfo']->letter_type_id;
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");
        if($serviceId==4){
            //Tour operator Assessment Details
            $data['officeInfos']=Services::getOfficeInfoDetails($applicationNo);
            $data['officeEquipments']=Services::getOfficeEquipmentInfoDetails($applicationNo,'O');
            $data['communicationFacilities']=Services::getOfficeEquipmentInfoDetails($applicationNo,'C');
            $data['trekkingEquipments']=Services::getOfficeEquipmentInfoDetails($applicationNo,'T');
            $data['employments']=Services::getEmploymentInfoDetails($applicationNo);
            $data['transportations']=Services::getTransportationInfoDetails($applicationNo);
            return view('services.approver.approve_to_assessment',$data);

        }
        elseif($serviceId==9){
            //Tour Operator Owner Change Details
            return view('services.approver.approve_tour_operator_owner_change',$data);
        }
        elseif($serviceId==10){
            //Tour Operator Name Change Details
            return view('services.approver.approve_tour_operator_name_change',$data);
        }
        elseif($serviceId==11){
            //Tour propriater card Details
            return view('services.approver.approve_propreiter_card',$data);
        }
        elseif($serviceId==12){
            //Recommandation Letter for tour operator license
            $data['letterTypes'] = Dropdown::getDropdowns("t_recommandation_letter_masters","id","recommandation_letter_type","0","0");
            $data['letterContent']=null;
            if($letterSample=="1"){
                $p1="This is to certify that M/s.";
                $p2="is Royal Government of Bhutan’s licensed Tour Operator and registered with the Tourism Council of Bhutan.";
                $p3="We would like to confirm that Mr/Ms";
                $p6="is the proprietor of";
                $p4="The letter is valid till ";
                $p5="(validity of the license)";
                $data['letterContent']="<p1 class='text-justify'>".$p1."&nbsp"."<strong>".$data['applicantInfo']->owner_name."</strong>"."&nbsp".$p2."</p>" ."<p>".$p3."&nbsp"."<strong>".$data['applicantInfo']->owner_name."</strong>"."&nbsp".$p6."&nbsp"."<strong>".$data['applicantInfo']->company_title_name ."</strong>"."</p>"."<p>".$p4."<strong>".date('m/d/yy', strtotime($data['applicantInfo']->license_date))."</strong>".$p5."</p>";
            }
            return view('services.approver.approve_recommandation_letter_for_to_license',$data);
        }
        elseif($serviceId==21){
            //Tour operator license clearance Details
            $data['partnerInfo']=Services::getPartnerInfoDetails($applicationNo);
            return view('services.approver.approve_to_new _license',$data);
        }
        elseif($serviceId==13){
            //Tour Operator License Renew Details
            return view('services.approver.approve_to_license_renew',$data);
        }
        elseif($serviceId==15){
            //Tour Operator Event Registration for Travel Fairs
            return view('services/approver/approve_to_registration_travel_fairs',$data);
        }

    }

     //Approval function for tour operator technical clearance application
     public function tourOperatorTechnicalClearanceApplication(Request $request){
        if($request->status =='APPROVED'){
           // insert into t_operator_clearances
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
            $id=Services::getLastInsertedId('t_operator_clearances',$data);
           // insert into t_partner_dtls
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
           return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully');

       }else{
           $rejectId = WorkFlowDetails::getStatus('REJECTED');
           $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
           $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
           ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
           return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
   }

    //Approval function for tour operator assessment application
     public function tourOperatorAssessmentApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_operator_dtls
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
                $data[]= [    
                    'cid_no'   => $request->cid_no,
                    'name'   => $request->name,
                    'contact_no'   => $request->contact_no,
                    'license_date'   => date('Y-m-d', strtotime($request->license_date)),
                    'email'   => $request->email,
                    'license_no'   => $request->license_no,
                    'address'   => $request->address,
                    'company_name'   => $request->company_name,
                    'location'   => $request->location,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
             $id=Services::getLastInsertedId('t_operator_dtls',$data);
            // insert into t_office_dtls
             $officeInfoData = [];
             if(isset($_POST['office_id'])){
                 foreach($request->office_id as $key => $value){
                 $officeInfoData[] = [
                              'operator_dtls_id' =>  $id,
                              'office_id'   => $request->office_id[$key],
                              'office_status'   => $request->office_status[$key],
                              'created_at'   => now(),
                              'updated_at'   => now(),
                     ];
                  }
                 $this->services->insertDetails('t_office_dtls',$officeInfoData);
             }
            // insert into t_equipment_dtls
            $officeEquipmentData = [];
             if(isset($_POST['equipment_id'])){
                 foreach($request->equipment_id as $key => $value){
                 $officeEquipmentData[] = [
                              'operator_dtls_id' =>  $id,
                              'equipment_id'   => $request->equipment_id[$key],
                              'equipment_status'   => $request->equipment_status[$key],
                              'created_at'   => now(),
                              'updated_at'   => now(),
                     ];
                  }
                 $this->services->insertDetails('t_equipment_dtls',$officeEquipmentData);
             }
            // insert into t_employment_dtls
             $employmentData = [];
             if(isset($_POST['employment_id'])){
                 foreach($request->employment_id as $key => $value){
                 $employmentData[] = [
                              'operator_dtls_id' =>  $id,
                              'employment_id'   => $request->employment_id[$key],
                              'employment_status'   => $request->employment_status[$key],
                              'nationality'   => $request->nationality[$key],
                              'created_at'   => now(),
                              'updated_at'   => now(),
                     ];
                  }
                 $this->services->insertDetails('t_employment_dtls',$employmentData);
             }
               // insert into t_transportation_dtls
            $transportationData = [];
            if(isset($_POST['vehicle_id'])){
                foreach($request->vehicle_id as $key => $value){
                $transportationData[] = [
                            'operator_dtls_id' =>  $id,
                            'vehicle_id'   => $request->vehicle_id[$key],
                            'transport_status'   => $request->transport_status[$key],
                            'fitness'   => $request->fitness[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                    ];
                }
                $this->services->insertDetails('t_transportation_dtls',$transportationData);
            }
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                       ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]); 
            });
            return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully');

        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
    }

    public function proprieterCardApplication(Request $request){
        if($request->status =='APPROVED'){
                // insert into t_proprietor_card_dtls
                \DB::transaction(function () use ($request) {
                    $approveId = WorkFlowDetails::getStatus('APPROVED');
                    $completedId= WorkFlowDetails::getStatus('COMPLETED');
                    $data[]= [    
                        'name'   => $request->name,
                        'validity_date'   => date('Y-m-d', strtotime($request->validity_date)),
                        'license_no'   => $request->license_no,
                        'email'   => $request->email,
                        'company_name'   => $request->company_name,
                        'location'   => $request->location,
                        'contact_no'   => $request->contact_no,
                        'verified_by'   => auth()->user()->id,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                        ];
                $id=Services::getLastInsertedId('t_proprietor_card_dtls',$data);
                $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
                $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                            ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
                $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
                $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                        ->update(['status_id' => $completedId->id]); 
                });
                return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully');

            }else{
                $rejectId = WorkFlowDetails::getStatus('REJECTED');
                $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
                $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
                return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
                }
            }

    //Approval function for tour operator name change application
    public function tourOperatorNameChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

            //save data to t_operator_dtls_audit
            $savedatatoaudit=Services::saveTourOperatorDtlsAudit($request->license_no);

              //update data to t_operator_dtls
              $data = array(
                'company_name' => $request->company_name,
             );
             $updatedata=Services::updateApplicantDtls('t_operator_dtls','license_no',$request->license_no,$data);

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

       //Approval function for tour operator owner change application
       public function tourOperatorOwnerChangeApplication(Request $request){
        if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

           //save data to t_operator_dtls_audit
           $savedatatoaudit=Services::saveTourOperatorDtlsAudit($request->license_no);

              //update data to t_operator_dtls
              $data = array(
                'name' => $request->name,
                'cid_no' => $request->cid_no,
                'address' => $request->address, 
                'contact_no' => $request->contact_no,
				'email' => $request->email
             );
             $updatedata=Services::updateApplicantDtls('t_operator_dtls','license_no',$request->license_no,$data);

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

     //Approval function for tour operator license rennw application
      public function tourOperatorLicenseRenewApplication(Request $request){
        if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

           //save data to t_operator_dtls_audit
           $savedatatoaudit=Services::saveTourOperatorDtlsAudit($request->license_no);

              //update data to t_operator_dtls
              $data = array(
                'license_date'=> date('Y-m-d', strtotime($request->license_date))

             );
            $updatedata=Services::updateApplicantDtls('t_operator_dtls','license_no',$request->license_no,$data);
           
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

      //Approval function for tour operator license recommandation Letter application
      public function toLicenseRecommandationLetterApplication(Request $request){
    
        if($request->status =='APPROVED'){
            \DB::transaction(function () use ($request) {

                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');

           //save data to t_operator_dtls_audit
           $savedatatoaudit=Services::saveTourOperatorDtlsAudit($request->license_no);

              //update data to t_operator_dtls
              $data = array(
                'letter_sample'=> $request->letter_sample,

             );
            $updatedata=Services::updateApplicantDtls('t_operator_dtls','license_no',$request->license_no,$data);
           
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);

            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
        });
            $person = new Services();
            $person->name =$request->name ;
            $person->companyName =$request->company_name;
            $person->licenseValidatyDate =$request->license_date;
            $person->letterType =$request->letter_sample;

           return view('services/lettersample/lettersample',$person)->with('msg_success', 'Application approved successfully.');;
      //  $pdf = PDF::loadView('services/lettersample/lettersample', compact('applicantInfo'));
        //return $pdf->stream('Recommandation Letter-'.str_random(4).'.pdf');
       // return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');

        }else{
            $rejectId = WorkFlowDetails::getStatus('REJECTED');
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
            ->update(['status_id' => $rejectId->id,'user_id'=>auth()->user()->id,'remarks' => $request->remarks]);
            return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
            }
     } 
     
       //Approval function for travel fair application
        public function travelFairsApplication(Request $request){
            if($request->status =='APPROVED'){
                \DB::transaction(function () use ($request) {
    
                    $approveId = WorkFlowDetails::getStatus('APPROVED');
                    $completedId= WorkFlowDetails::getStatus('COMPLETED');
    
                    $eventdata[] = [
                        'event_id' =>  $request->event_id,
                        'name'   => $request->name,
                        'cid_no'   => $request->cid_no,
                        'contact_no'   => $request->contact_no,
                        'email'   => $request->email,
                        'company_name'   => $request->company_name,
                        'date_of_registration'   => $request->date_of_registration,
                        'remarks'   => $request->remarks,
                    ];
                $this->services->insertDetails('t_travel_fair_dtls',$eventdata);
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
