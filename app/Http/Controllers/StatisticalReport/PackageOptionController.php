<?php

namespace App\Http\Controllers\StatisticalReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageOption;
use App\Models\Dropdown;

class PackageOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:statistical/package-option,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/package-option,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/package-option,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/package-option,delete', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['packageoptionLists'] = PackageOption::getPackageOptionList();
        return view('statistica_report.package_option.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Dropdown::getDropdownList("3");
        return view('statistica_report.package_option.create',$data);
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
        if(isset($_POST['location_id'])){
            foreach($request->location_id as $key => $value){
            $savedata[] = [
                    'location_id' => $request->location_id[$key],
                    'package_option' => $request->package_option[$key],
                    'value' => $request->value[$key],
                    'year' => $request->year[$key],
                ];
                }
            $statusflag=PackageOption::insertDetails('t_package_option_survey',$savedata);
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
        $data['package_option'] = PackageOption::getPackageOptionToEdit($id);   
        $data['countries'] = Dropdown::getDropdownList("3");
        return view('statistica_report.package_option.edit',$data);
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
            'location_id' => $request->location_id,
            'package_option' =>$request->package_option,
            'value' =>$request->value,
            'year' =>$request->year,
       ];
       PackageOption::where('id',$request->record_id)->update($data);
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
            $data = PackageOption::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
