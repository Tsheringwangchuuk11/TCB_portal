<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTypes;

class ProductTypesController extends Controller
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
   

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savedata = ProductTypes::Create(['product_name' => $request->product_name,'dropdown_id' => $request->dropdown_id,'created_by' => auth()->user()->id]);
        $lastRecord = ProductTypes::latest()->first();
        return response()->json($lastRecord); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dropdownId,Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['productTypelists'] = ProductTypes::where('dropdown_id',$dropdownId)->get();
        $data['dropdown'] = ProductTypes::getDropdownName($dropdownId);
        return view('master.product_types.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProductTypes::findOrFail($id);
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
            'product_name' => $request->product_name,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
       ProductTypes::where('id',$request->product_types_id)->update($data);
       $data = ProductTypes::findOrFail($request->product_types_id); 
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
            $data = ProductTypes::findOrFail($request->product_types_id);
            $data->delete();
            return response()->json(['status' => 'true', 'truemsg'=> 'Record deleted successfully!']);
        } catch(\Exception $exception){
            return response()->json(['status' => 'false', 'falsemsg' => 'This checklist chapter  cannot be deleted as it is link in other data.!']);
        }
    }
}
