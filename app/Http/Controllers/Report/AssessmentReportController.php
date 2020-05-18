<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\TaskDetails;

class AssessmentReportController extends Controller
{
    
    public function getAssessment()
    {
        $servicemodules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");
        $myTasklists = TaskDetails::orderBy('application_no')->paginate(10);

        return view('report.assessment', compact('servicemodules', 'myTasklists'));
    }
}
