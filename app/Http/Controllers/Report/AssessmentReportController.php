<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Exports\ExportToView;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\TCheckListChapter;
use App\Models\Services;
use Excel;
use PDF;
use DB;

class AssessmentReportController extends Controller
{
    //hotel assessment list report
    public function getAssessment(Request $request)
    {
        $servicemodules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");        

        $applications = DB::table('t_workflow_dtls')
                            ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                            ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                            ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                            ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                            ->orderBy('t_workflow_dtls.created_at', 'asc')
                            ->select('t_workflow_dtls.application_no','t_module_masters.module_name','t_applications.license_no', 't_applications.owner_name','t_services.name','t_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks')->get();
                            
        return response()->json($applications);

        if ($request->has('print')) {
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView(['applications' => $applications->get()], 'hotel-assessment-list'), 'Hotel Assessment Report.xlsx');
            } else {
                $pdf = PDF::loadView('pdf.hotel-assessment-list', ['applications' => $applications->get()]);
                return $pdf->stream('hotel assessment list Report-'.str_random(4).'.pdf');
            }
        } else {
            return view('report.assessment')->with('applications', $applications->paginate(15));
        }        
    }

    //detail report for hotel assessment
    public function detailAssessment(Request $request, $application_no)
    {
        $application = DB::table('t_applications as application')->select('application.*') ->where('application_no','=', $application_no)      ->first();                                                                
        $starCategoryId = $application->star_category_id;
        $moduleId = $application->module_id;        
        $data =  TCheckListChapter::with(['chapterAreas' => function($q) use($application_no,$starCategoryId){
                                $q->with(['checkListStandards'=> function($query) use($application_no,$starCategoryId){
                                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                                        ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                                        ->where('t_checklist_applications.application_no','=',$application_no)
                                        ->where('t_check_list_standard_mappings.star_category_id','=',$starCategoryId);
                                                    }]);
                                    }])->where('module_id','=',$moduleId)
                                    ->get();              
        if($request->has('print')){
            $pdf = PDF::loadView('pdf.hotel-assessment-detail', compact('application', 'data'));
            return $pdf->stream('Hotel Assessment Detail Report-'.str_random(4).'.pdf');
        }

        return view('report.assessment-detail', compact('application', 'data'));         
    }   
}
 