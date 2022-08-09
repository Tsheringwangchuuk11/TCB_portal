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
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\EndUserNotification;

class TourismProductController extends Controller
{
    public function __construct(Services $services)
    {
        $this->middleware('permission:application/new-application,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:application/new-application,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:application/new-application,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:application/new-application,delete', ['only' => 'destroy']);
        $this->services = $services;

    }
    public function getApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
       
        if($serviceId==15){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['productInfo']=Services::getProductInfoDetails($applicationNo);
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
                return view('services.resubmit_application.resubmit_eoi',$data,compact('status'));
                }else{
                    $status= WorkFlowDetails::getStatus('APPROVED')->id;
                    return view('services.approve_application.approve_eoi',$data,compact('status'));
                }

        }
        else if($serviceId==16){
        //new Tourism product development
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['productInfo']=Services::getProductInfoDetails($applicationNo);
        if($status==9){
            return view('services.resubmit_application.resubmit_new_tourism_product_development',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_new_tourism_product_development',$data,compact('status'));
            }
      }
      elseif($serviceId==17){
        // Existing Tourism product proposal
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['productTypes'] = Dropdown::getDropdownList("12");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['productInfo']=Services::getProductInfoDetails($applicationNo);
        if($status==9){
            return view('services.resubmit_application.resubmit_existing_tourism_product_proposal',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('services.approve_application.approve_existing_tourism_product_proposal',$data,compact('status'));
            }
         }
    }

    public function viewApplicationDetails($applicationNo,$status=null){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
       
        if($serviceId==15){
            $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
            $data['productInfo']=Services::getProductInfoDetails($applicationNo);
            $data['documentInfos']=Services::getDocumentDetails($applicationNo);
            if($status==9){
                return view('report.application_details.view_eoi',$data,compact('status'));
                }else{
                    $status= WorkFlowDetails::getStatus('APPROVED')->id;
                    return view('report.application_details.view_eoi',$data,compact('status'));
                }

        }
        else if($serviceId==16){
        //new Tourism product development
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['productInfo']=Services::getProductInfoDetails($applicationNo);
        if($status==9){
            return view('report.application_details.view_new_tourism_product_development',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('report.application_details.view_new_tourism_product_development',$data,compact('status'));
            }
      }
      elseif($serviceId==17){
        // Existing Tourism product proposal
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['productTypes'] = Dropdown::getDropdownList("12");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['productInfo']=Services::getProductInfoDetails($applicationNo);
        if($status==9){
            return view('report.application_details.view_existing_tourism_product_proposal',$data,compact('status'));
            }else{
                $status= WorkFlowDetails::getStatus('APPROVED')->id;
                return view('report.application_details.view_existing_tourism_product_proposal',$data,compact('status'));
            }
         }
    }

    //Approval function for toueism product EOI
    public function tourismProductEOIApplication(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
         if($request->status =='APPROVED'){
             // insert into t_operator_clearances
             \DB::transaction(function () use ($request,$service,$roleId) {
                 $approveId = WorkFlowDetails::getStatus('APPROVED');
                 $completedId= WorkFlowDetails::getStatus('COMPLETED');
                 $data[]= [    
                    'cid_no'   => $request->cid_no,
                    'name'   => $request->name,
                    'email'   => $request->email,
                    'contact_no'   => $request->contact_no,
                    'address'   => $request->address,
                    'receipt_date'   =>now(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                 ];
             $id=Services::getLastInsertedId('t_proponent_dtls',$data);
                // insert into t_partner_dtls
                $productdtlsData[]= [ 
                    'proponent_dlts_id' =>  $id,
                    'product_type'   => $request->product_type,
                    'modality'   => $request->modality,
                    'activities_results'   => $request->activities_results,
                    'product_des'   => $request->partner_email,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]; 
            $service->insertDetails('t_product_dtls',$productdtlsData); 

             $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
             $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                     ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
    
             $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
             $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['status_id' => $completedId->id]);
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
            } 
         });
         return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
         }
         elseif($request->status =='RESUBMIT'){
             $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
             $completedId= WorkFlowDetails::getStatus('COMPLETED');
             $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
             $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
             ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
    
             $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
             $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['status_id' => $completedId->id]);
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
            }
             return redirect('tasklist/tasklist')->with('msg_success', 'Application resend successfully');
         }
         else{
    
             $completedId= WorkFlowDetails::getStatus('COMPLETED');
             $rejectId = WorkFlowDetails::getStatus('REJECTED');
             $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
             $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
             ->update(['status_id' => $rejectId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
    
             $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
             $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                     ->update(['status_id' => $completedId->id]);
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
            }
         return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
        }
   }

    //Approval function for new tourism product development application
    public function newTourismProductDevelopment(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
 
     if($request->status =='VERIFIED'){
         $verifiedId = WorkFlowDetails::getStatus('VERIFIED');
         $releaseId= WorkFlowDetails::getStatus('INITIATED');
         $assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id, 2);
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
             ->update(['status_id' => $verifiedId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updateworkflow=TaskDetails::where('application_no',$request->application_no)
             ->update([
                         'status_id' => $releaseId->id,
                         'assigned_priv_id' => $assigned_priv_id->id
                     ]);
         return redirect('tasklist/tasklist')->with('msg_success', 'Application has been verified successfully.');
     } elseif($request->status =='APPROVED'){
         // insert into t_techt_tourist_standard_dtlsnical_clearances
         \DB::transaction(function () use ($request,$service,$roleId) {
             $approveId = WorkFlowDetails::getStatus('APPROVED');
             $completedId= WorkFlowDetails::getStatus('COMPLETED');

            $applicantdata[]= [
                'cid_no'   => $request->cid_no,
                'name'   => $request->name,
                'email'   => $request->email,
                'contact_no'   => $request->contact_no,
                'address'   => $request->address,
                'receipt_date'   =>now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
         $id=Services::getLastInsertedId('t_proponent_dtls',$applicantdata);
            // insert into t_partner_dtls
            $productdtlsData[]= [ 
                'proponent_dlts_id' =>  $id,
                'product_type'   => $request->product_type,
                'village_id'=>$request->establishment_village_id,
                'objective'  => $request->objective,
                'product_des'  => $request->product_des,
                'project_cost'  => $request->project_cost,
                'start_date'  =>date('Y-m-d', strtotime($request->start_date)),  
                'end_date'  => date('Y-m-d', strtotime($request->end_date)),  
                'contribution'  => $request->contribution,
            ]; 
            $service->insertDetails('t_product_dtls',$productdtlsData); 
 
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
 
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approved',$request->service_name))->delay($when));
            }
     });
     return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
 
     } elseif($request->status =='RESUBMIT'){
         $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
         $completedId= WorkFlowDetails::getStatus('COMPLETED');
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
         ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                 ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
        }
        return redirect('tasklist/tasklist')->with('msg_success', 'Application resend successfully');
     }
     else{
 
         $completedId= WorkFlowDetails::getStatus('COMPLETED');
         $rejectId = WorkFlowDetails::getStatus('REJECTED');
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
         ->update(['status_id' => $rejectId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                 ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
        }
         return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
         }
    }

    //Approval function for existing tourism product Proposal application
    public function existingTourismProductProposal(Request $request,Services $service){
        $roles = auth()->user()->roles()->get();
        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
 
     if($request->status =='VERIFIED'){
         $verifiedId = WorkFlowDetails::getStatus('VERIFIED');
         $releaseId= WorkFlowDetails::getStatus('INITIATED');
         $assigned_priv_id=TaskDetails::getAssignPrivId($request->service_id, 2);
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
             ->update(['status_id' => $verifiedId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updateworkflow=TaskDetails::where('application_no',$request->application_no)
             ->update([
                         'status_id' => $releaseId->id,
                         'assigned_priv_id' => $assigned_priv_id->id
                     ]);
         return redirect('tasklist/tasklist')->with('msg_success', 'Application has been verified successfully.');
     } elseif($request->status =='APPROVED'){
         // insert into t_techt_tourist_standard_dtlsnical_clearances
         \DB::transaction(function () use ($request,$service,$roleId) {
             $approveId = WorkFlowDetails::getStatus('APPROVED');
             $completedId= WorkFlowDetails::getStatus('COMPLETED');

            $applicantdata[]= [
                'cid_no'   => $request->cid_no,
                'name'   => $request->name,
                'email'   => $request->email,
                'contact_no'   => $request->contact_no,
                'address'   => $request->address,
                'receipt_date'   =>now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
         $id=Services::getLastInsertedId('t_proponent_dtls',$applicantdata);
            // insert into t_partner_dtls
            $productdtlsData[]= [ 
                'proponent_dlts_id' =>  $id,
                'product_type_id'   => $request->product_type_id,
                'village_id'=>$request->establishment_village_id,
                'objective'  => $request->objective,
                'product_des'  => $request->product_des,
                'project_cost'  => $request->project_cost,
                'start_date'  =>date('Y-m-d', strtotime($request->start_date)),   
                'end_date'  => date('Y-m-d', strtotime($request->end_date)),  
                'contribution'  => $request->contribution,
            ]; 
            $service->insertDetails('t_product_dtls',$productdtlsData); 
 
            $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
            $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
                    ->update(['status_id' => $approveId->id,'role_id'=> $roleId,'remarks' => $request->remarks]);
 
            $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
            $updateworkflow=TaskDetails::where('application_no',$request->application_no)
                                    ->update(['status_id' => $completedId->id]);
            //Email send notifications
            if ($request->email) {
                $when = Carbon::now()->addMinutes(1);
                Notification::route('mail', $request->email) 
                ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Approvded',$request->service_name))->delay($when));
            }
     });
     return redirect('tasklist/tasklist')->with('msg_success', 'Application approved successfully.');
 
     } elseif($request->status =='RESUBMIT'){
         $resubmitdId = WorkFlowDetails::getStatus('RESUBMIT');
         $completedId= WorkFlowDetails::getStatus('COMPLETED');
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
         ->update(['status_id' => $resubmitdId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                 ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Resubmit',$request->service_name))->delay($when));
        }
         return redirect('tasklist/tasklist')->with('msg_success', 'Application resend successfully');
     }
     else{
 
         $completedId= WorkFlowDetails::getStatus('COMPLETED');
         $rejectId = WorkFlowDetails::getStatus('REJECTED');
         $savetoaudit=WorkFlowDetails::saveWorkFlowDtlsAudit($request->application_no);
         $updateworkflow=WorkFlowDetails::where('application_no',$request->application_no)
         ->update(['status_id' => $rejectId->id,'role_id'=>$roleId,'remarks' => $request->remarks]);
 
         $savetotaskaudit=TaskDetails::savedTaskDtlsAudit($request->application_no);
         $updatetaskdtls=TaskDetails::where('application_no',$request->application_no)
                                 ->update(['status_id' => $completedId->id]);
        //Email send notifications
        if ($request->email) {
            $when = Carbon::now()->addMinutes(1);
            Notification::route('mail', $request->email) 
            ->notify((new EndUserNotification($request->email, $request->name, $request->application_no, 'Rejected',$request->service_name))->delay($when));
        }          
         return redirect('tasklist/tasklist')->with('msg_success', 'Application reject successfully');
         }
    }
}
