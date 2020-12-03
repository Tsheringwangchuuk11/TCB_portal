<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\Report;
use App\Exports\ExportToView;
use Excel;
use PDF;
use DB;
class CommonReportController extends Controller
{
    //Report for training
    public function reportForTraining(Request $request){
        $data['traineelists']=Report::getCourseCompletedTraineeList($request);
        $data['courseTypes'] =Dropdown::getDropdownList("13");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        if ($request->has('print')) {
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView($data, 'report.common_report.download_excel.excel_training_report'), 'Training List Report.xlsx');
            } else {
    	        $pdf = PDF::loadView('report.common_report.download_pdf.pdf_training_report', $data);
                return $pdf->stream('Training List Report-'.str_random(4).'.pdf');
            }
        }else{
            return view('report.common_report.training',$data);
        }
    }

    // Registration Report
    public static function reportForRegistration(Request $request){
        $data['registrationlists']=Report::getRegisteredHotelList($request);
        $data['modules'] = Report::getModule($dropdownId[]=["1","2","3","4","9"]);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['starCategoryLists'] = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        if ($request->has('print')) {
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView($data, 'report.common_report.download_excel.excel_training_report'), 'Training List Report.xlsx');
            } else {
    	        $pdf = PDF::loadView('report.common_report.download_pdf.pdf_training_report', $data);
                return $pdf->stream('Training List Report-'.str_random(4).'.pdf');
            }
        }else{
            return view('report.common_report.registration',$data);
        }
    }

   // Application List Report
    public function getApplicationList(Request $request)
    {                      
       /*  $data['applications_data'] = DB::table("t_applications")->select("t_applications.application_no","t_applications.service_id" ,"t_applications.module_id");
        $data['grievance_data'] = DB::table("t_grievance_applications")->select("t_grievance_applications.application_no","t_grievance_applications.service_id","t_grievance_applications.module_id")
                               ->union($data['applications_data']);
         $data['applications'] = DB::table('t_workflow_dtls')
                                ->joinSub($data['grievance_data'], 'uniondata', function ($join) {
                                    $join->on('t_workflow_dtls.application_no', '=', 'uniondata.application_no');
                                })
                            ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                            ->leftJoin('t_module_masters','uniondata.module_id','=','t_module_masters.id')
                            ->leftJoin('t_services','uniondata.service_id','=','t_services.id')
                            ->orderBy('t_workflow_dtls.created_at', 'asc')
                            ->select('t_workflow_dtls.application_no','t_module_masters.module_name',
                              't_services.name',
                             't_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks');    
dd($data['applications']); */
       
      $data['applications'] = DB::table('t_workflow_dtls')
                            ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                            ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                            ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                            ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                            ->orderBy('t_workflow_dtls.created_at', 'asc')
                            ->select('t_workflow_dtls.application_no','t_module_masters.module_name','t_applications.license_no',
                             't_applications.owner_name', 't_applications.cid_no', 't_applications.applicant_name', 't_services.name',
                             't_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks');  

        $data['totalapplication']= $data['applications']->count(); 
        $data['totalsubmitted']=Report::getApplicationSubmittedList();
        $data['totalapproved']=Report::getApplicationApprovedList();
        $data['totalrejected']=Report::getApplicationRejectedList();
        $data['serviceModules'] = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0"); 
        $data['services'] = Dropdown::getDropdowns("t_services","id","name","0","0"); 
        $data['statusTypes'] = Dropdown::getDropdowns("t_status_masters","id","name","0","0")->where('status_type', 'W');        

        //filter
        if($request->has('module') && $request->query('module', null) != null){
            $data['applications']->where('t_module_masters.id', $request->query('module'));
            $data['totalapplication']= $data['applications']->count();
            $data['totalsubmitted']=Report::getAppSubmittedListForModuleWise($request->module);
            $data['totalapproved']=Report::getAppApprovedListForModuleWise($request->module);
            $data['totalrejected']=Report::getAppRejectedListForModuleWise($request->module); 
           
        }          
        if($request->has('service') && $request->query('service', null) != null){
            if($request->has('module') && $request->module !=null){
                $data['applications']->where('t_services.id', $request->query('service'))->where('t_module_masters.id', $request->query('module'));
                $data['totalapplication']= $data['applications']->count();
                $data['totalsubmitted']=Report::getAppSubmittedListForModuleService($request->module,$request->service);
                $data['totalapproved']=Report::getAppApprovedListForModuleService($request->module,$request->service);
                $data['totalrejected']=Report::getAppRejectedListForModuleService($request->module,$request->service);
            }
           else{
            $data['applications']->where('t_services.id', $request->query('service'));
            $data['totalapplication']= $data['applications']->count();
            $data['totalsubmitted']=Report::getAppSubmittedListForServiceWise($request->service);
            $data['totalapproved']=Report::getAppApprovedListForServiceWise($request->service);
            $data['totalrejected']=Report::getAppRejectedListForServiceWise($request->service);
           }
        }
        if($request->has('status') && $request->query('status', null) != null){
            $data['applications']->where('t_status_masters.id', $request->query('status'));
        }

        if ($request->has('application_from') && $request->query('application_from') != '') {
            $data['applications']->where('t_workflow_dtls.created_at', '>=',  date('Y-m-d', strtotime($request->query('application_from'))));
        }

        if ($request->has('application_to') && $request->query('application_to') != '') {
            $data['applications']->where('t_workflow_dtls.created_at', '<=',  date('Y-m-d', strtotime($request->query('application_to'))));
        }

        if($request->has('application_no') && $request->query('application_no', null) != null){
            $data['applications']->where('t_workflow_dtls.application_no', $request->query('application_no'));
        } 
        if ($request->has('print'))
        {
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView(['applications' => $data['applications']->get()], 'report.common_report.download_excel.application-list'), 'Application List Report.xlsx');
            } else {
                $pdf = PDF::loadView('report.common_report.download_pdf.application-list', ['applications' =>$data['applications']->get()]);
                return $pdf->stream('application list Report-'.str_random(4).'.pdf');
            }
        } else {
            return view('report.common_report.application-list',$data)->with('applications',$data['applications']->paginate(10));
        }        
    }

    //Tourism Survey Report
    public  function tourismSurvey(){
        $data['report_types'] = Dropdown::getDropdowns('t_report_types','report_type_id','report_type','0','0');
        return view('report.common_report.tourism_survey', $data);
    }

    public function getReportContent(Request $request){
    }
}
