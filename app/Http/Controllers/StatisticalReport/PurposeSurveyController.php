<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurposeSurvey;
use App\Models\Dropdown;
class PurposeSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:statistical/purpose-survey,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/purpose-survey,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/purpose-survey,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/purpose-survey,delete', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['report_types'] = PurposeSurvey::getReportType($dropdownId[]=["2","3"]);
        $data['visitorsTypes'] = PurposeSurvey::getVisitorTypes("14",$dropdownId[]=["316","317"]);
        return view('statistica_report.purpose_survey.index',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($report_type_id,$report_category_id,$visitor_type_id)
    {
        $data['purposes'] = Dropdown::getDropdownList("15");
        $data['countries'] = Dropdown::getDropdownList("3");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('statistica_report.purpose_survey.create',$data,compact('report_category_id','visitor_type_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savedata = [];
        if(isset($_POST['purpose_id'])){
            foreach($request->purpose_id as $key => $value){
            $savedata[] = [
                    'purpose_id' => $request->purpose_id[$key],
                    'value' => $request->value[$key],
                    'location_id' => $request->location_id[$key],
                    'year' => $request->year[$key],
                    'gender' => $request->gender[$key],
                    'report_category_id' => $request->report_category_id,
                    'visitor_type_id' => $request->visitor_type_id,
                ];
                }
                $statusflag=PurposeSurvey::insertDetails('t_purpose_survey',$savedata);
                return redirect()->back()->with('msg_success', 'Data save successfully.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$report_type_id,$report_category_id,$visitor_type_id)
    {
        $data['privileges'] = $request->instance();
        $data['purposesurveylists'] = PurposeSurvey::getPurposeSurveyData($report_category_id,$visitor_type_id);
        return view('statistica_report.purpose_survey.show',$data,compact('report_category_id','visitor_type_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *s
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['purposesurveylist'] = PurposeSurvey::getPurposeSurveyToEdit($id);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['purposes'] = Dropdown::getDropdownList("15");
        $data['countries'] = Dropdown::getDropdownList("3");        
        return view('statistica_report.purpose_survey.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=[
            'purpose_id' => $request->purpose_id,
            'gender' =>$request->gender,
            'value' =>$request->value,
            'year' =>$request->year,
            'location_id' =>$request->location_id,
       ];
       PurposeSurvey::where('id',$request->record_id)->update($data);
       return redirect()->back()->with('msg_success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {
            $data = PurposeSurvey::findOrFail($request->record_id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
