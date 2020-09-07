<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dropdown;

class DropDownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/drop-down-master,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/drop-down-master,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/drop-down-master,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/drop-down-master,delete', ['only' => 'destroy']);
    }
    public function getMasterDropDown(){
        $masterDropDownLists = Dropdown::getMasterDropDown();
        return view('master.drop_down_list.index',compact('masterDropDownLists'));
    }
    public function index()
    {
        $masterDropDownLists = Dropdown::getMasterDropDown();
        return view('master.drop_down_list.index',compact('masterDropDownLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.drop_down_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $savedata = Dropdown::Create(['dropdown_name' => $request->dropdown_name,'master_id' => $request->master_id,'created_by' => auth()->user()->id]);
         $lastRecord = Dropdown::latest()->first();
        return response()->json($lastRecord );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($masterId,Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['dropdownlists'] = Dropdown::where('master_id',$masterId)->get();
        $data['masterdropdown'] = Dropdown::getMasterDropdownName($masterId);
        return view('master.drop_down_list.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Dropdown::findOrFail($id);
        return response()->json($data);

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
            'dropdown_name' => $request->dropdown_name,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
       Dropdown::where('id',$request->drop_down_id)->update($data);
       $data = Dropdown::findOrFail($request->drop_down_id);
       return response()->json($data);
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
            $data = Dropdown::findOrFail($request->drop_down_id);
            $data->delete();
            return response()->json(['status' => 'true', 'truemsg'=> 'Record deleted successfully!']);
        } catch(\Exception $exception){
            return response()->json(['status' => 'false', 'falsemsg' => 'This checklist chapter  cannot be deleted as it is link in other data.!']);
        }
    }
}
