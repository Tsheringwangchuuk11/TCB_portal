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

}
