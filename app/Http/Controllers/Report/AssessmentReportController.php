<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Exports\ExportToView;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\Services;

class AssessmentReportController extends Controller
{
    
    public function getAssessment(Request $request)
    {
        $servicemodules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");        

        $applications = \DB::table('t_workflow_dtls')
                            ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                            ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                            ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                            ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                            ->orderBy('t_workflow_dtls.created_at', 'asc')
                            ->select('t_workflow_dtls.application_no','t_module_masters.module_name','t_applications.license_no', 't_applications.owner_name','t_services.name','t_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks');      

        if ($request->has('print')) {
            if ($request->query('print') == 'excel') {
                return \Excel::download(new ExportToView(['applications' => $applications->get()], 'hotel-assessment-list'), 'Hotel Assessment Report.xlsx');
            } else {
                $pdf = \PDF::loadView('pdf.hotel-assessment-list', ['applications' => $applications->get()]);
                return $pdf->stream('hotel assessment list Report-'.str_random(4).'.pdf');
            }
        } else {
            return view('report.assessment')->with('applications', $applications->paginate(30));
        }        
    }

    public function detailAssessment($application_no)
    {
        $applications = \DB::table('t_applications')->where($application_no, 'application_no')->pluck('application_no');        
        return response()->json($applications);
    }   
}
 