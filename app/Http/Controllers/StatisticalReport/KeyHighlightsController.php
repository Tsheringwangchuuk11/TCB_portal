<?php

namespace App\Http\Controllers\StatisticalReport;
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
        $this->middleware('permission:statistical/key-highlights,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:statistical/key-highlights,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:statistical/key-highlights,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:statistical/key-highlights,delete', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['keyhighligtslists'] = Keyhighlights::getHighlightsList();
        return view('statistica_report.key_highlights.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['dropdowns'] = Keyhighlights::getDropdownName();
        return view('statistica_report.key_highlights.create',$data);

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
        if(isset($_POST['highlight_type_id'])){
            foreach($request->highlight_type_id as $key => $value){
            $savedata[] = [
                    'highlight_type_id' => $request->highlight_type_id[$key],
                    'total_no' => $request->total_no[$key],
                    'percent' => $request->percent[$key],
                    'year' => $request->year[$key],
                    'is_publish' => $request->is_publish[$key],
                ];
                }
                $statusflag=Keyhighlights::insertDetails('t_key_highlights',$savedata);
                return redirect()->back()->with('msg_success', 'Key highlight details save successfully.');
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
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['keyhighlights'] = Keyhighlights::getHighLightsTypesToEdit($id);
        $data['dropdowns'] = Keyhighlights::getDropdownName();
        return view('statistica_report.key_highlights.edit',$data);
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
            $data = Keyhighlights::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('msg_success', 'Record deleted successfully.');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_danger', 'This data cannot be deleted as it is link in other data.');
        }
    }
}
