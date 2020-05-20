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
    public function getApplicationDetails($applicationNo){
        $data['applicantInfo']=Services::getApplicantDetails($applicationNo);
        $serviceId= $data['applicantInfo']->service_id;
        $data['documentInfos']=Services::getDocumentDetails($applicationNo);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");
        if($serviceId==18){
            //Tourism product development
          $data['organizerInfo']=Services::getOrganizerInfoDetails($applicationNo);
          $data['itemsInfos']=Services::getItemInfoDetails($applicationNo);
          return view('services.approver.approve_tourism_product_development',$data);

      }
      elseif($serviceId==19){
             //Tourism product proposal
          $data['productInfo']=Services::getProductInfoDetails($applicationNo);
          return view('services.approver.approve_tourism_product_proposal',$data);
      }
    }

     //Approval function for tourism product development application
    public function tourismProductDevelopmentApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_festival_event_dtls
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
    
            $eventdata[]= [    
                'title_name'   => $request->title_name,
                'name'   => $request->name,
                'financial_year'   => $request->financial_year,
                'location'   => $request->location,
                'dates'   =>date('Y-m-d', strtotime($request->dates)),
                'contact_no'   => $request->contact_no,
                'address'   => $request->address,
                'email'   => $request->email,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
            $id=Services::getLastInsertedId('t_festival_event_dtls',$eventdata);
            // insert into t_organizer_dtls
                $organizerData[] = [
                             'festival_event_id' =>  $id,
                             'organizer_name'   => $request->organizer_name,
                             'organizer_address'   => $request->organizer_address,
                             'organizer_phone'   => $request->organizer_phone,
                             'organizer_email'   => $request->organizer_email,
                             'organizer_type'   => $request->organizer_type,
                             'amount_requested'   => $request->amount_requested,
                             'created_at'   => now(),
                             'updated_at'   => now(),
                    ];
                $this->services->insertDetails('t_organizer_dtls',$organizerData);
             
               // insert into t_item_dtls
               $itemsData = [];
               if(isset($_POST['items_name'])){
                   foreach($request->items_name as $key => $value){
                   $itemsData[] = [
                                'festival_event_id' =>  $id,
                                'items_name'   => $request->items_name[$key],
                                'item_costs'   => $request->item_costs[$key],
                                'created_at'   => now(),
                                'updated_at'   => now(),
                       ];
                    }
                   $this->services->insertDetails('t_item_dtls',$itemsData);
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

         //Approval function for tourism product Proposal application
    public function tourismProductProposalApplication(Request $request){
        if($request->status =='APPROVED'){
            // insert into t_proponent_dtls
            \DB::transaction(function () use ($request) {
                $approveId = WorkFlowDetails::getStatus('APPROVED');
                $completedId= WorkFlowDetails::getStatus('COMPLETED');
    
            $applicantdata[]= [    
                'registration_no'   => $request->registration_no,
                'name'   => $request->name,
                'address'   => $request->address,
                'contact_no'   => $request->contact_no,
                'receipt_date'   =>date('Y-m-d', strtotime($request->receipt_date)),
                'email'   => $request->email,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
            $id=Services::getLastInsertedId('t_proponent_dtls',$applicantdata);
            // insert into t_product_dtls
                $productData[] = [
                             'proponent_dlts_id' =>  $id,
                             'type'   => $request->type,
                             'location'   => $request->location,
                             'objective'   => $request->objective,
                             'product_des'   => $request->product_des,
                             'project_cost'   => $request->project_cost,
                             'timeline'   => $request->timeline,
                             'contribution'   => $request->contribution,
                             'created_at'   => now(),
                             'updated_at'   => now(),
                    ];
            $this->services->insertDetails('t_product_dtls',$productData);
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
