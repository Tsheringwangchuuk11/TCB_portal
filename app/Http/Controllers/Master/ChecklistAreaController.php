<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListChapter;
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
        $serviceModules = Dropdown::getDropdowns("t_module_masters","id","module_name","0","0");

        return view('master.checklist-area', compact('privileges', 'checklistAreas', 'checklistAreaCount', 'checklistChapters', 'serviceModules'));
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
        try {
            $checklistArea = TCheckListArea::findOrFail($id);
            $checklistArea->delete();

            return redirect('master/checklist-areas')->with('msg_success', 'checklist area successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This checklist area  cannot be deleted as it is link in other data.');
        }
    }

    //get checklist chapter
    public function getChapter(Request $request)
    {                
        $chapters = TCheckListChapter::where('module_id', $request->moduleId)->get();
        return response()->json($chapters);
    }
}
