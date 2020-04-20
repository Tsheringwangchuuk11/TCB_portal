<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListArea;
use App\Models\Dropdown;
use Validator;


class ChecklistAreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:master/checklist-areas,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/checklist-areas,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/checklist-areas,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/checklist-areas,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $checklistAreas = TCheckListArea::orderBy('id')->with('checklistChapter')->paginate(10);
        $checklistAreaCount = TCheckListArea::count();
        $checklistChapters = Dropdown::getDropdowns("t_check_list_chapters","id","checklist_ch_name","0","0");

        return view('master.checklist-area', compact('privileges', 'checklistAreas', 'checklistAreaCount', 'checklistChapters'));
    }

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
