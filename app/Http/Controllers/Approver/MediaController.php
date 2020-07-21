<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\WorkFlowDetails;
use App\Models\Dropdown;
use App\Models\TaskDetails;
class MediaController extends Controller
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
        $data['countries'] = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");
        if($serviceId==14){
            //Media familiarization tour Details
            $data['channelTypes'] = Dropdown::getDropdowns("t_channel_types","id","channel_type","0","0");
            $data['channelTypesInfos']=Services::getChannelInfoDetails($applicationNo);
            $data['channelCoverages']=Services::getChannelCoverageInfoDetails($applicationNo);
            return view('services.approver.approve_media_familiarization_tour',$data);
        }
    }

     //Approval function for FAM application
   public function famApplication(Request $request){
    if($request->status =='APPROVED'){
        // insert into t_fam_dtls
        \DB::transaction(function () use ($request) {
            $approveId = WorkFlowDetails::getStatus('APPROVED');
            $completedId= WorkFlowDetails::getStatus('COMPLETED');

        $applicantdata[]= [    
            'name'   => $request->name,
            'agent_cid_no'   => $request->agent_cid_no,
            'designation'   => $request->designation,
            'email'   => $request->email,
            'website'   => $request->website,
            'agency_name'   => $request->agency_name,
            'agency_address'   => $request->agency_address,
            'city'   => $request->city,
            'country_id'   => $request->country_id,
            'fam_type'   => $request->fam_type,
            'from_date'   => date('Y-m-d', strtotime($request->from_date)),
            'to_date'   => date('Y-m-d', strtotime($request->to_date)),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
        $id=Services::getLastInsertedId('t_fam_dtls',$applicantdata);
           // insert into t_channel_dtls
           $channelDtlData = [];
           if(isset($_POST['channel_type_id'])){
               foreach($request->channel_type_id as $key => $value){
               $channelDtlData[] = [
                            'fam_dtls_id' =>  $id,
                            'channel_type_id'   => $request->channel_type_id[$key],
                            'channel_name'   => $request->channel_name[$key],
                            'circulation'   => $request->circulation[$key],
                            'target_audience'   => $request->target_audience[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                   ];
                }
               $this->services->insertDetails('t_channel_dtls',$channelDtlData);
           }
            // insert into t_dist_channel_dtls
            $distChannelDtlData = [];
            if(isset($_POST['area_coverage'])){
                foreach($request->area_coverage as $key => $value){
                $distChannelDtlData[] = [
                             'fam_dtls_id' =>  $id,
                             'area_coverage'   => $request->area_coverage[$key],
                             'channel_name'   => $request->channel_name[$key],
                             'channel_link'   => $request->channel_link[$key],
                             'channel_type_id'   =>$request->channel_type_id[$key],
                             'intended_date'   => date('Y-m-d', strtotime($request->intended_date[$key])),
                             'created_at'   => now(),
                             'updated_at'   => now(),
                    ];
                 }
                $this->services->insertDetails('t_dist_channel_dtls',$distChannelDtlData);
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

      //Approval function forTour Operator FAM application
   public function TourOperatorfamApplication(Request $request){
    if($request->status =='APPROVED'){
        // insert into t_fam_dtls
        \DB::transaction(function () use ($request) {
            $approveId = WorkFlowDetails::getStatus('APPROVED');
            $completedId= WorkFlowDetails::getStatus('COMPLETED');

        $applicantdata[]= [    
            'name'   => $request->name,
            'agent_cid_no'   => $request->agent_cid_no,
            'designation'   => $request->designation,
            'email'   => $request->email,
            'website'   => $request->website,
            'agency_name'   => $request->agency_name,
            'agency_address'   => $request->agency_address,
            'city'   => $request->city_id,
            'country_id'   => $request->country,
            'fam_type'   => $request->fam_type,
            'from_date'   => date('Y-m-d', strtotime($request->from_date)),
            'to_date'   => date('Y-m-d', strtotime($request->to_date)),
            'visit_purpose'   => $request->visit_purpose,
            'sell_destination'   => $request->sell_destination,
            'sell_bhutan'   => $request->sell_bhutan,
            'destination_year'   => $request->destination_year,
            'bhutan_year'   => $request->bhutan_year,
            'established_year'   => $request->established_year,
            'remarks'   => $request->remarks,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
        $id=Services::getLastInsertedId('t_fam_dtls',$applicantdata);
           // insert into t_market_dtls
           $marketDtlData = [];
           if(isset($_POST['country_id'])){
               foreach($request->country_id as $key => $value){
               $marketDtlData[] = [
                            'fam_dtls_id' =>  $id,
                            'country_id'   => $request->country_id[$key],
                            'city'   => $request->city[$key],
                            'created_at'   => now(),
                            'updated_at'   => now(),
                   ];
                }
               $this->services->insertDetails('t_market_dtls',$marketDtlData);
           }
            // insert into t_activity_dtls
            $activitiesDtlData = [];
            if(isset($_POST['activities'])){
                foreach($request->activities as $key => $value){
                $activitiesDtlData[] = [
                             'fam_dtls_id' =>  $id,
                             'activities'   => $request->activities[$key],
                             'created_at'   => now(),
                             'updated_at'   => now(),
                    ];
                 }
                $this->services->insertDetails('t_activity_dtls',$activitiesDtlData);
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
}
