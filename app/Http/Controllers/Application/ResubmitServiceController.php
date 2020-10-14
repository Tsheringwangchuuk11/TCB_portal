<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\TaskDetails;
use DB;

class ResubmitServiceController extends Controller
{
    public function saveResubmitApplication(Request $request,Services $services){
        $application_no= $request->application_no;
          DB::transaction(function () use ($request,$application_no,$services) {
             //insert into t_application
             $data=[
             'application_no'=> $application_no,
             'module_id'=> $request->module_id,
             'service_id'=> $request->service_id,
             'applicant_name'=> $request->applicant_name,
             'applicant_id'=> auth()->user()->id,
             'application_type_id'=> $request->application_type_id,
             'event_id'=> $request->event_id,
             'cid_no'=> $request->cid_no,
             'new_cid_no'=> $request->new_cid_no,
             'owner_name'=> $request->owner_name,
             'new_owner_name'=> $request->new_owner_name,
             'manager_name'=> $request->manager_name,
             'manager_mobile_no'=> $request->manager_mobile_no,
             'gender'=> $request->gender,
             'dob'=> $request->dob,
             'designation'=> $request->designation,
             'applicant_flat_no'=> $request->applicant_flat_no,
             'applicant_building_no'=> $request->applicant_building_no,
             'applicant_location'=> $request->applicant_location,
             'company_title_name'=> $request->company_title_name,
             'company_name_one'=> $request->company_name_one,
             'company_name_two'=> $request->company_name_two,
             'contact_no'=> $request->contact_no,
             'new_contact_no'=> $request->new_contact_no,
             'tentative_cons'=> $request->tentative_cons,
             'tentative_com'=> $request->tentative_com,
             'drawing_date'=> $request->drawing_date,
             'email'=> $request->email,
             'new_email'=> $request->new_email,
             'star_category_id'=> $request->star_category_id,
             'license_no'=> $request->license_no,
             'license_date'=> $request->license_date,
             'address'=> $request->address,
             'new_address'=> $request->new_address,
             'fax'=> $request->fax,
             'webpage_url'=> $request->webpage_url,
             'number'=> $request->number,
             'thram_no'=> $request->thram_no,
             'house_no'=> $request->house_no,
             'town_distance'=> $request->town_distance,
             'road_distance'=> $request->road_distance,
             'condition'=> $request->condition,
             'validity_date'=> $request->validity_date,
             'flat_no'=> $request->flat_no,
             'building_no'=> $request->building_no,
             'permanent_village_id'=> $request->permanent_village_id,
             'establishment_village_id'=> $request->establishment_village_id,
             'new_village_id'=> $request->new_village_id,
             'chiwog_id'=> $request->chiwog_id,
             'city'=> $request->city,
             'country_id'=> $request->country_id,
             'from_date'=> $request->from_date,
             'to_date'=> $request->to_date,
             'remarks'=> $request->remarks,
             'dispatch_no'=> $request->dispatch_no,
             ];
            $satus=Services::updateApplicantDtls('t_applications','application_no',$request->application_no,$data);

            //insert into t_room_applications
             if(isset($_POST['room_type_id'])){
                 foreach($request->room_type_id as $key => $value){
                        $roomAppData= [
                            'application_no' => $application_no,
                              'room_type_id' => $request->room_type_id[$key],
                                   'room_no' => $request->room_no[$key],
                        ];
                        $satus=Services::updateOrSaveDetails('t_room_applications',$roomAppData, ['id'=>$request->room_record_id[$key]] );
                    } 
                }
             //insert into t_staff_applications
             if(isset($_POST['staff_cid_no'])){
                 foreach($request->staff_cid_no as $key => $value)
                 {
                     $staffAppData = [
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
                 $satus=Services::updateOrSaveDetails('t_staff_applications',$staffAppData, ['id'=>$request->staff_record_id[$key]] );
                 }
             }
 
             //insert into t_checklist_applications
             if(isset($_POST['checklist_id'])){
                 for ($i=0; $i < count($_POST['checklist_id']); $i++)
                 {
                    if($request->checkvalue[$i] == 1){
                     $checklistData = [
                         'application_no'  => $application_no,
                         'checklist_id'  => $request->checklist_id[$i],
                         'assessor_score_point'  => $request->assessor_score_point[$i],
                         'assessor_rating'  => $request->assessor_rating[$i],
                     ];
                     $satus=Services::updateOrSaveDetails('t_checklist_applications',$checklistData, ['id'=>$request->checklist_record_id[$i]] );
                    }
                 }
             }
 
            //insert into t_member_applications
              if(isset($_POST['member_name'])){
                 foreach($request->member_name as $key => $value)
                 {
                     $membersDetailsData = [
                       'application_no'  => $application_no,
                          'member_name'  => $request->member_name[$key],
                     'relation_type_id'  => $request->relation_type_id[$key],
                           'member_dob'  => $request->member_dob[$key],
                        'member_gender'  => $request->member_gender[$key]
                     ];
                    $satus=Services::updateOrSaveDetails('t_member_applications',$membersDetailsData, ['id'=>$request->member_record_id[$key]] );

                 }
             }

            //insert tour operator check list application
            if(isset($_POST['area'])){
                foreach($request->area as $key => $value){
                $index = $_POST['area'][$key];
                $tocheckdata = [
                        'application_no'   => $application_no,
                         'checklist_id'   =>$_POST['check'.$index],
                    ];
                    $satus=Services::updateOrSaveDetails('t_checklist_applications',$tocheckdata, ['id'=>$request->checklist_record_id[$key]] );
                 }
            }
 
              //insert into t_partner_applications
              if(isset($_POST['partner_name'])){
                     $partnerDetailsData= [
                          'application_no'   => $application_no,
                            'partner_name'   => $request->partner_name,
                          'partner_cid_no'   => $request->partner_cid_no,
                          'partner_gender'   => $request->partner_gender,
                             'partner_dob'   => date('Y-m-d', strtotime($request->partner_dob)),
                      'partner_village_id'   => $request->partner_village_id,
                      'partner_email'   => $request->partner_email
                     ];
                 $satus=Services::updateOrSaveDetails('t_partner_applications',$partnerDetailsData, ['id'=>$request->partner_record_id[$key]] );
             }

              //insert tourism partner details into t_partner_applications
              if(isset($_POST['event_id'])){
                foreach($request->member_name as $key => $value)
                {
                    $tourismindustrypatner = [
                        'application_no'   => $application_no,
                        'partner_name'   => $request->partner_name[$key],
                      'partner_cid_no'   => $request->partner_cid_no[$key],
                       'partner_email'   => $request->partner_email[$key],
                  'partner_contact_no'   => $request->partner_contact_no[$key],
                  'partner_designation'  => $request->partner_designation[$key],
                  'partner_passport_no'  => $request->partner_passport_no[$key],
                             'event_id'  => $request->event_id[$key],
                    ];
                   $satus=Services::updateOrSaveDetails('t_partner_applications',$tourismindustrypatner, ['id'=>$request->partner_record_id[$key]] );
                }
            }

             //insert EOI and new tourism product development info into t_product_applications
             if(isset($_POST['product_type'])){
                 $productItemData = [
                    'application_no' => $application_no,
                    'product_type'=>$request->product_type,
                    'modality'=>$request->modality,
                    'village_id'=>$request->establishment_village_id,
                    'activities_results'  => $request->activities_results,
                    'product_des'  => $request->product_des,
                    'objective'  => $request->objective,
                    'product_des'  => $request->product_des,
                    'project_cost'  => $request->project_cost,
                    'start_date'  => $request->start_date,
                    'end_date'  => $request->end_date,
                    'contribution'  => $request->contribution,
                     ];
                 $satus=Services::updateOrSaveDetails('t_product_applications',$productItemData, ['id'=>$request->record_id] );

             }

               //insert existing tourism product development info into t_product_applications
               if(isset($_POST['product_type_id'])){
                $productItemData = [
                    'application_no' => $application_no,
                    'product_type_id'=>$request->product_type_id,
                         'village_id'=>$request->establishment_village_id,
                         'objective'  => $request->objective,
                      'product_des'  => $request->product_des,
                     'project_cost'  => $request->project_cost,
                        'start_date'  => $request->start_date,
                     'end_date'  => $request->end_date,
                     'contribution'  => $request->contribution,
                    ];
                $satus=Services::updateOrSaveDetails('t_product_applications',$productItemData, ['id'=>$request->record_id] );

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
                  $services->insertDetails('t_organizer_applications',$organizerInfoData);
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
 
                 $services->insertDetails('t_item_applications',$eventItemData);
             }
 


             //insert into t_product_applications
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
                 $services->insertDetails('t_product_applications',$productItemData);
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
                 $services->insertDetails('t_channel_applications',$channelInfoData);
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
                 $services->insertDetails('t_dist_channel_applications',$channelCoverageData);
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
                  $services->insertDetails('t_market_applications',$marketingInfoData);
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
                   $services->insertDetails('t_activity_applications',$marketinActivitiesData);
               }

            //insert into t_foreign_worker_applications
            if(isset($_POST['passport_no'])){
                foreach($request->passport_no as $key => $value){
                    $workpermitData = [
                        'application_no'   => $request->application_no,
                        'name'   => $request->name[$key],
                        'passport_no'   => $request->passport_no[$key],
                        'start_date'   => date('Y-m-d', strtotime($request->start_date[$key])),
                        'end_date'   => date('Y-m-d', strtotime($request->end_date[$key])),
                        'nationality'   => $request->nationality[$key],
                    ];
                    $satus=Services::updateOrSaveDetails('t_foreign_worker_applications',$workpermitData, ['id'=>$request->worker_record_id[$key]] );
                }
            }

             //update application_no in t_documents
              $documentId = $request->documentId;
              $services->updateDocumentDetails($documentId,$application_no);
 
            //insert into t_workflow_dtls
           $submitId=WorkFlowDetails::getStatus('SUBMITTED')->id;
           $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($application_no);
           $updateworkflow=WorkFlowDetails::where('application_no',$application_no)
                      ->update(['status_id' =>$submitId,'user_id'=>auth()->user()->id,'remarks' => null]);
         
 
            //insert into t_task_dtls
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($application_no);
            $initiatedId=WorkFlowDetails::getStatus('INITIATED')->id;
            $assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id, 1)->id;
            $updatetaskdtls=TaskDetails::where('application_no',$application_no)
                                    ->update(['status_id' =>$initiatedId,'assigned_priv_id'=>$assigned_priv_id ]);
 
         });  
         return redirect('dashboard')->with('appl_info', 'Your application has been submitted successfully and your application number is :'.$application_no);
     }
}
