<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripExpenditure;
use App\Models\Dropdown;

class TripExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:statistical/trip-expenditure,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/trip-expenditure,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/trip-expenditure,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/trip-expenditure,delete', ['only' => 'destroy']);
    }

    public function index(request $request)
    {
        $data['privileges'] = $request->instance();
        $data['tripexpenditureLists'] = TripExpenditure::getTripExpenditureList();
        return view('statistica_report.trip_expenditure.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['purposes'] = Dropdown::getDropdownList("15");
        $data['exp_items'] = Dropdown::getDropdownList("17");
        $data['trip_types'] = Dropdown::getDropdownList("18");
        $data['report_categories'] = TripExpenditure::getReportCategories($dropdownId[]=["1","2","3","4"]);
        return view('statistica_report.trip_expenditure.create',$data);
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
                    'exp_item_id' => $request->exp_item_id[$key],
                    'value' => $request->value[$key],
                    'year' => $request->year[$key],
                    'trip_type_id' => $request->trip_type_id[$key],
                    'report_category_id' => $request->report_category_id[$key],
                ];
                }
            $statusflag=TripExpenditure::insertDetails('t_tripexpenditure_survey',$savedata);
            return redirect()->back()->with('msg_success', 'Data save successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tripexpenditure'] = TripExpenditure::getTripExpenditureToEdit($id);
        $data['purposes'] = Dropdown::getDropdownList("15");
        $data['exp_items'] = Dropdown::getDropdownList("17");
        $data['trip_types'] = Dropdown::getDropdownList("18");
        $data['report_categories'] = TripExpenditure::getReportCategories($dropdownId[]=["1","2","3","4"]);       
        return view('statistica_report.trip_expenditure.edit',$data);
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
            'exp_item_id' =>$request->exp_item_id,
            'trip_type_id' =>$request->trip_type_id,
            'report_category_id' =>$request->report_category_id,
            'value' =>$request->value,
            'year' =>$request->year,
       ];
       TripExpenditure::where('id',$request->record_id)->update($data);
       return redirect()->back()->with('msg_success', 'Data updated successfully.');
    } 
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = TripExpenditure::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
