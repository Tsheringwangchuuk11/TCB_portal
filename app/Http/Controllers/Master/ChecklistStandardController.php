<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListStandard;
use App\Models\Dropdown;
use Validator;

class ChecklistStandardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:master/checklist-standards,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/checklist-standards,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/checklist-standards,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/checklist-standards,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $checklistStandards = TCheckListStandard::orderBy('id')->with('checklistArea')->paginate(10);
        $checklistStandardCount = TCheckListStandard::count();
        $checklistAreas = Dropdown::getDropdowns("t_check_list_areas","id","checklist_area","0","0");

        return view('master.checklist-standard', compact('privileges', 'checklistStandards', 'checklistStandardCount', 'checklistAreas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $checklistStandardID = $request->checklist_standard_id;
            $rule = [
                'checklist_area' => 'required',
                'checklist_standard_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){
                $checklistStandard   =   TCheckListStandard::updateOrCreate(['id' => $checklistStandardID],
                    ['checklist_area_id' => $request->checklist_area, 'checklist_standard' => $request->checklist_standard_name, 'checklist_pts' => $request->checklist_point, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);

			return response()->json($checklistStandard);
            }

            return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $checklistStandard = TCheckListStandard::where('id', $id)->first();

		return response()->json($checklistStandard);
    }
   //delete
    public function destroy($id)
    {
        $checklistStandard = TCheckListStandard::where('id', $id)->delete();
		return response()->json($checklistStandard);
    }
}
