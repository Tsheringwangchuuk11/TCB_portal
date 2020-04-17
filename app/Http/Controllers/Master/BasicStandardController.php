<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TBasicStandard;
use Validator;

class BasicStandardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:master/basic-standards,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/basic-standards,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/basic-standards,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/basic-standards,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $basicStandards = TBasicStandard::orderBy('id')->paginate(30);
        $basicStandardCount = $basicStandards->count();

        return view('master.basic-standard', compact('privileges', 'basicStandards', 'basicStandardCount'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $checklistAreaID = $request->checklist_area_id;
            $rule = [
                'checklist_chapter' => 'required',
                'checklist_area_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){
                $checklistArea   =   TCheckListArea::updateOrCreate(['id' => $checklistAreaID],
                    ['checklist_ch_id' => $request->checklist_chapter, 'checklist_area' => $request->checklist_area_name, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);

			return response()->json($checklistArea);
            }

            return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $checklistArea = TCheckListArea::where('id', $id)->first();

		return response()->json($checklistArea);
    }
   //delete
    public function destroy($id)
    {
        $checklistArea = TCheckListArea::where('id', $id)->delete();
		return response()->json($checklistArea);
    }
}
