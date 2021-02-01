<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportationMode;
use App\Models\Dropdown;

class TransportationModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:statistical/transportation,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/transportation,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/transportation,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/transportation,delete', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['transportationlists'] = TransportationMode::getTransportationList();
        return view('statistica_report.transportation_mode.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['modeoftransports'] = Dropdown::getDropdownList("16");
        $data['countries'] = Dropdown::getDropdownList("3");
        return view('statistica_report.transportation_mode.create',$data);
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
        if(isset($_POST['transport_mode_id'])){
            foreach($request->transport_mode_id as $key => $value){
            $savedata[] = [
                    'transport_mode_id' => $request->transport_mode_id[$key],
                    'location_id' => $request->location_id[$key],
                    'value' => $request->value[$key],
                    'year' => $request->year[$key],
                ];
                }
                $statusflag=TransportationMode::insertDetails('t_transport_survey',$savedata);
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
        $data['modeoftransportdata'] = TransportationMode::getModeOfTransportToEdit($id);
        $data['modeoftransports'] = Dropdown::getDropdownList("16");
        $data['countries'] = Dropdown::getDropdownList("3");       
        return view('statistica_report.transportation_mode.edit',$data);
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
            'transport_mode_id' => $request->transport_mode_id,
            'location_id' =>$request->location_id,
            'value' =>$request->value,
            'year' =>$request->year,
       ];
       TransportationMode::where('id',$request->record_id)->update($data);
       return redirect()->back()->with('msg_success', 'Key highlight details updated successfully.');
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
            $data = TransportationMode::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
