<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Origin;
use App\Models\Dropdown;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:statistical/origin,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/origin,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/origin,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/origin,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['originLists'] = Origin::getOriginList();
        return view('statistica_report.origin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['visitorsTypes'] = Origin::getVisitorTypes("14",$dropdownId[]=["316","317"]);
        $data['report_categories'] = Origin::getReportCategories($dropdownId[]=["3"]);
        return view('statistica_report.origin.create',$data);
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
        if(isset($_POST['origin_id'])){
            foreach($request->origin_id as $key => $value){
            $savedata[] = [
                    'origin_id' => $request->origin_id[$key],
                    'visitor_type_id' => $request->visitor_type_id[$key],
                    'location_id' => $request->location_id[$key],
                    'value' => $request->value[$key],
                    'year' => $request->year[$key],
                    'report_category_id' => $request->report_category_id[$key],
                ];
                }
            $statusflag=Origin::insertDetails('t_origin_survey',$savedata);
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
        $data['origindata']=Origin::getOriginDataToEdit($id);
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['visitorsTypes'] = Origin::getVisitorTypes("14",$dropdownId[]=["316","317"]);
        $data['report_categories'] = Origin::getReportCategories($dropdownId[]=["3"]);
        return view('statistica_report.origin.edit',$data);

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
            'origin_id' => $request->origin_id,
            'visitor_type_id' =>$request->visitor_type_id,
            'location_id' =>$request->location_id,
            'report_category_id' =>$request->report_category_id,
            'value' =>$request->value,
            'year' =>$request->year,
       ];
       Origin::where('id',$request->record_id)->update($data);
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
            $data = Origin::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
