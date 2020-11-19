<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Exports\ExportToView;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\WorkFlowDetails;
use App\Models\TCheckListChapter;
use App\Models\TModuleMaster;
use App\Models\Report;
use App\Models\Services;
use Excel;
use PDF;
use DB;

class AssessmentReportController extends Controller
{
    //hotel assessment list report
    public function getAssessment(Request $request)
    {                                           
        $applications = Report::getAssessmentReportList();       
        $serviceModules = Report::getModule($dropdownId[]=["1","2","3","4","9"]);;                            
         
        if($request->has('module') && $request->query('module', null) != null){
            $applications->where('t_applications.module_id', $request->query('module'));
        }

        if ($request->has('application_from') && $request->query('application_from') != '') {
            $applications->where('t_workflow_dtls.created_at', '>=',  date('Y-m-d', strtotime($request->query('application_from'))));
        }

        if ($request->has('application_to') && $request->query('application_to') != '') {
            $applications->where('t_workflow_dtls.created_at', '<=',  date('Y-m-d', strtotime($request->query('application_to'))));
        }

        if($request->has('application_no') && $request->query('application_no', null) != null){
            $applications->where('t_workflow_dtls.application_no', $request->query('application_no'));
        }      

        if ($request->has('print'))
        {
            if ($request->query('print') == 'excel') {
                return Excel::download(new ExportToView(['applications' => $applications->get()], 'report.assessment_report.download_excel.hotel-assessment-list'), 'Hotel Assessment Report.xlsx');
            } else {
                $pdf = PDF::loadView('report.assessment_report.download_pdf.hotel-assessment-list', ['applications' => $applications->get()]);
                return $pdf->stream('hotel assessment list Report-'.str_random(4).'.pdf');
            }
        } else {
            return view('report.assessment_report.assessment', compact('serviceModules'))->with('applications', $applications->paginate(15));
        }        
    }

    //detail report for hotel assessment
    public function detailAssessment(Request $request, $application_no,$moduleId)
    {
        if($moduleId==1){
            $application =Report::getHotelDetailAssessment($application_no);
            $roomDetails =Report::getRoomDetailAssessment($application_no);
            $staffInfos =Report::getstaffDetailAssessment($application_no);
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
            $chapterId=Services::getChapterId($application_no,$moduleId, $starCategoryId)->toArray();                 
            if ($request->has('print'))
            {
                if ($request->query('print') == 'excel') {                
                    return Excel::download(new ExportToView
                    ([
                        'application' => $application,
                        'data' => $data,
                        'roomDetails' => $roomDetails,
                        'staffInfos' => $staffInfos,
                        'chapterId' => $chapterId,
                    ],'report.assessment_report.download_excel.hotel-assessment-list-detail'),'Hotel Assessment Detail Report.xlsx');
                } else {
                    $pdf = PDF::loadView('report.assessment_report.download_pdf.hotel-assessment-detail', compact('application', 'data','roomDetails','staffInfos','chapterId'));
                    return $pdf->stream('Hotel Assessment Detail Report-'.str_random(4).'.pdf');
                }
            } else {
            
                    return view('report.assessment_report.hotel_detail', compact('application','data','roomDetails','staffInfos','chapterId'));   
            } 
        }elseif($moduleId==2){
            $application =Report::getVillageHomeStayDetailAssessment($application_no);
            $familyDetails =Report::getFamilyDetailAssessment($application_no);
            $moduleId = $application->module_id;   
            $data =  TCheckListChapter::with(['chapterAreas' => function($q) use($application_no){
                                    $q->with(['checkListStandards'=> function($query) use($application_no){
                                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                                            ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                                            ->where('t_checklist_applications.application_no','=',$application_no);
                                                        }]);
                                        }])->where('module_id','=',$moduleId)
                                        ->get();   
            if ($request->has('print'))
            {
                if ($request->query('print') == 'excel') {                
                    return Excel::download(new ExportToView
                    ([
                        'application' => $application,
                        'data' => $data,
                        'familyDetails' => $familyDetails,
                    ],'report.assessment_report.download_excel.village_home_stay_details'),'Village Home Stay Assessment Detail Report.xlsx');
                } else {
                    $pdf = PDF::loadView('report.assessment_report.download_pdf.village_home_stay_details', compact('application', 'data','familyDetails'));
                    return $pdf->stream('Village Home Stay Assessment Detail Report-'.str_random(4).'.pdf');
                }
            } else {
                    return view('report.assessment_report.village_home_stay_details', compact('application', 'data','familyDetails'));   
            } 

        } elseif($moduleId==3){
            $application =Report::getRestuarantDetailAssessment($application_no);
            $staffInfos =Report::getstaffDetailAssessment($application_no);
            $moduleId = $application->module_id;   
            $data =  TCheckListChapter::with(['chapterAreas' => function($q) use($application_no){
                                    $q->with(['checkListStandards'=> function($query) use($application_no){
                                        $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                                            ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                                            ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                                            ->where('t_checklist_applications.application_no','=',$application_no);
                                                        }]);
                                        }])->where('module_id','=',$moduleId)
                                        ->get();   
            if ($request->has('print'))
            {
                if ($request->query('print') == 'excel') {                
                    return Excel::download(new ExportToView
                    ([
                        'application' => $application,
                        'data' => $data,
                        'staffInfos' => $staffInfos,
                    ],'report.assessment_report.download_excel.restuarant_assessment_detail'),'Restaurant Assessment Detail Report.xlsx');
                } else {
                    $pdf = PDF::loadView('report.assessment_report.download_pdf.restaurant_detail', compact('application', 'data','staffInfos'));
                    return $pdf->stream('Restaurant Assessment Detail Report-'.str_random(4).'.pdf');
                }
            } else {
                    return view('report.assessment_report.restaurant_detail', compact('application', 'data','staffInfos'));   
            } 

        } elseif($moduleId==4){
            $data['application'] =Report::getTourOperatorDetailAssessment($application_no); 
            $data['checklistDtls'] =  TCheckListChapter::with(['chapterAreas' => function($q){
                $q->with(['checkListStandards'=> function($query){
                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                    ->where('t_check_list_standard_mappings.is_active','=','1');
                }]);
                }])->where('module_id','=',$moduleId)
                ->get();
            $data['checklistrecords']=Services::getCheckedRecord($application_no);
            $data['checklistrec']=Services::getCheckedRecord($application_no)->pluck('checklist_id')->toArray();
            if ($request->has('print'))
            {
                if ($request->query('print') == 'excel') {                
                    return Excel::download(new ExportToView($data,'report.assessment_report.download_excel.tour_operator'),'Tour Oprator Assessment Detail Report.xlsx');
                } else {
                    $pdf = PDF::loadView('report.assessment_report.download_pdf.tour_operator',$data);
                    return $pdf->stream('Tour Operator Assessment Detail Report-'.str_random(4).'.pdf');
                }
            } else {
                    return view('report.assessment_report.tour_operator',$data);   
            } 

    } 
    elseif($moduleId==9){
        $application =Report::getHotelDetailAssessment($application_no);
        $roomDetails =Report::getRoomDetailAssessment($application_no);
        $staffInfos =Report::getstaffDetailAssessment($application_no);
        $moduleId = $application->module_id;   
        $data =  TCheckListChapter::with(['chapterAreas' => function($q) use($application_no){
                                $q->with(['checkListStandards'=> function($query) use($application_no){
                                    $query->leftJoin('t_check_list_standard_mappings','t_check_list_standards.id','=','t_check_list_standard_mappings.checklist_id')
                                        ->leftJoin('t_basic_standards','t_check_list_standard_mappings.standard_id','=','t_basic_standards.id')
                                        ->leftJoin('t_checklist_applications','t_check_list_standards.id','=','t_checklist_applications.checklist_id')
                                        ->where('t_checklist_applications.application_no','=',$application_no);
                                            }]);
                                    }])->where('module_id','=',$moduleId)
                                ->get();
        $chapterId=Services::getTentedAccomChapterId($application_no,$moduleId)->toArray();                 
        if ($request->has('print'))
        {
            if ($request->query('print') == 'excel') {                
                return Excel::download(new ExportToView
                ([
                    'application' => $application,
                    'data' => $data,
                    'roomDetails' => $roomDetails,
                    'staffInfos' => $staffInfos,
                    'chapterId' => $chapterId,
                ],'report.assessment_report.download_excel.tented_accommodation_detail'),'Tented Accommodation Assessment Detail Report.xlsx');
            } else {
                $pdf = PDF::loadView('report.assessment_report.download_pdf.tented_accommodation_detail', compact('application', 'data','roomDetails','staffInfos','chapterId'));
                return $pdf->stream('Tented Accommodation Assessment Detail Report-'.str_random(4).'.pdf');
            }
        } else {
        
                return view('report.assessment_report.tented_accommodation_detail', compact('application','data','roomDetails','staffInfos','chapterId'));   
        } 
    }
}
}
 