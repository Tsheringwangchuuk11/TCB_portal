<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TotalTripExpenditure;
use App\Models\Dropdown;

class TotalTripExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:statistical/total-trip-expenditure,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/total-trip-expenditure,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/total-trip-expenditure,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/total-trip-expenditure,delete', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['report_types'] = TotalTripExpenditure::getReportType($dropdownId[]=["2","3"]);
        return view('statistica_report.total_trip_expenditure.index',$data);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($report_type_id,$report_category_id)
    {
        $data['countries'] = Dropdown::getDropdownList("3");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('statistica_report.total_trip_expenditure.create',$data,compact('report_category_id'));
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
        if(isset($_POST['avg_expenditure_trip'])){
            foreach($request->avg_expenditure_trip as $key => $value){
            $savedata[] = [
                    'avg_expenditure_trip' => $request->avg_expenditure_trip[$key],
                    'avg_expenditure_night' => $request->avg_expenditure_night[$key],
                    'location_id' => $request->location_id[$key],
                    'year' => $request->year[$key],
                    'tot_expenditure' => $request->tot_expenditure[$key],
                    'mean' => $request->mean[$key],
                    'median' => $request->median[$key],
                    'report_category_id' => $request->report_category_id,
                ];
                }
                $statusflag=TotalTripExpenditure::insertDetails('t_totexpenditure_survey',$savedata);
                return redirect()->back()->with('msg_success', 'Data save successfully.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$report_type_id,$report_category_id)
    {
        $data['privileges'] = $request->instance();
        $data['totaltripexplists'] = TotalTripExpenditure::getTotalTripExpData($report_category_id);
        return view('statistica_report.total_trip_expenditure.show',$data,compact('report_category_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['totaltripexplist'] = TotalTripExpenditure::getTotalTripExpToEdit($id);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['countries'] = Dropdown::getDropdownList("3");        
        return view('statistica_report.total_trip_expenditure.edit',$data);
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
        $data = [
            'avg_expenditure_trip' => $request->avg_expenditure_trip,
            'avg_expenditure_night' => $request->avg_expenditure_night,
            'location_id' => $request->location_id,
            'year' => $request->year,
            'tot_expenditure' => $request->tot_expenditure,
            'mean' => $request->mean,
            'median' => $request->median,
        ];
        TotalTripExpenditure::where('totexp_id',$request->record_id)->update($data);
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
            $data = TotalTripExpenditure::findOrFail($request->record_id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
