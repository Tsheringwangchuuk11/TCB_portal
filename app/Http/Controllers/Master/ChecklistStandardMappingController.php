<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListStandardMapping;
use App\Models\Dropdown;
use Validator;


class ChecklistStandardMappingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:master/checklist-standard-mappings,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/checklist-standard-mappings,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/checklist-standard-mappings,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/checklist-standard-mappings,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $standardMappings = TCheckListStandardMapping::orderBy('id')->with('starCategory', 'checklistStandard', 'basicStandard')->paginate(10);
        $standardMappingCount = $standardMappings->count();
        $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $checklistStandards = Dropdown::getDropdowns("t_check_list_standards","id","checklist_standard","0","0");
        $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");

        return view('master.checklist-standard-mapping', compact('privileges', 'standardMappings', 'standardMappingCount', 'starCategories', 'checklistStandards', 'basicStandards'));
    }

    public function store(Request $request)
    {
            $standardMappingID = $request->standard_mapping_id;
            $rule = [
                'star_category' => 'required',
                'checklist_standard' => 'required',
                'basic_standard' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){
                $standardMapping   =   TCheckListStandardMapping::updateOrCreate(['id' => $standardMappingID],
                    ['star_category_id' => $request->star_category, 'checklist_id' => $request->checklist_standard, 'standard_id' => $request->basic_standard, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);

			return response()->json($standardMapping);
            }

            return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $standardMapping = TCheckListStandardMapping::where('id', $id)->first();

		return response()->json($standardMapping);
    }
   //delete
    public function destroy($id)
    {
        $standardMapping = TCheckListStandardMapping::where('id', $id)->delete();
		return response()->json($standardMapping);
    }
}