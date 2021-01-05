<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keyhighlights;

class KeyhighlightsController extends Controller
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

       // return response()->json($request->all());
        $savedata = Keyhighlights::Create(['total_no' => $request->total_no,'percent' => $request->percent,'highlight_type_id' =>$request->highlight_type_id,'year' =>$request->year]);
        $lastRecord = Keyhighlights::getLatestRecord();
        return response()->json($lastRecord); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($highlight_type_id,Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['keyhighligtslists'] = Keyhighlights::getHighlightsList($highlight_type_id);
        $data['dropdown'] = Keyhighlights::getDropdownName($highlight_type_id);
        return view('master.key_highlights.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Keyhighlights::getHighLightsTypesToEdit($id);
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
            'total_no' => $request->total_no,
            'percent' =>$request->percent,
            'highlight_type_id' =>$request->highlight_type_id,
            'year' =>$request->year,
            'is_publish' =>$request->is_publish,
       ];
       Keyhighlights::where('key_highlight_id',$request->key_highlight_id)->update($data);
       $data = Keyhighlights::getHighLightsTypesToEdit($request->key_highlight_id); 
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
            $data = Keyhighlights::findOrFail($request->key_highlight_id);
            $data->delete();
            return response()->json(['status' => 'true', 'truemsg'=> 'Record deleted successfully!']);
        } catch(\Exception $exception){
            return response()->json(['status' => 'false', 'falsemsg' => 'This data cannot be deleted as it is link in other data.!']);
        }
    }
}
