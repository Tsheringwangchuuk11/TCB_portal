<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListChapter;
use App\Models\TCheckListArea;
use App\Models\TModuleMaster;
use App\Models\Dropdown;
use Validator;
use App\Models\TCheckListStandard;


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
<<<<<<< HEAD
        $privileges = $request->instance();        
        $checklistAreas = TCheckListArea::filter($request)->orderBy('id')->with('checklistChapter.serviceModule')->get();
        $checklistAreaCount = TCheckListArea::count();   
        $serviceModules = TModuleMaster::whereIn('module_name', array('Tourist Standard Hotel', 'Village Home Stay', 'Restaurant'))->get();             
=======
        $privileges = $request->instance();
        $checklistAreas = TCheckListArea::filter($request)->orderBy('id')->with('checklistChapter.serviceModule')->paginate(10);
        $checklistAreaCount = TCheckListArea::count();
        $serviceModules = TModuleMaster::whereIn('id', array('1', '2', '3', '4', '9'))->get();

        if($request->ajax()){
            $checklistAreas = TCheckListArea::filter($request)->with('checklistChapter.serviceModule')->paginate(10);
            return view('master.includes.checklist_area_data', compact('privileges', 'checklistAreas', 'checklistAreaCount', 'serviceModules'))->render();
        }
>>>>>>> d9f24451c857d8e067c00c4af4c4b45fe30ea269
        return view('master.checklist-area', compact('privileges', 'checklistAreas', 'checklistAreaCount', 'serviceModules'));
    }

    public function store(Request $request)
    {
        $checklistAreaID = $request->checklist_area_id;
        $rule = [
            'checklist_chapter' => 'required',
            'checklist_area' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->passes()){
            $checklistArea   =   TCheckListArea::updateOrCreate(['id' => $checklistAreaID],
                ['checklist_ch_id' => $request->checklist_chapter, 'checklist_area' => $request->checklist_area, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);

        return response()->json($checklistArea);
        }

        return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $checklistArea = TCheckListArea::with('checklistChapter.serviceModule')->where('id', $id)->first();

		return response()->json($checklistArea);
    }

   //delete
    public function destroy($id)
    {
        //to check checklist area is used in checklist standard
        $isAreaUsed = TCheckListStandard::where('checklist_area_id', $id)->exists();
        $checklistArea = TCheckListArea::findOrFail($id);
        $checklistArea['isAreaUsed'] = $isAreaUsed;
        if(!$isAreaUsed){
            $checklistArea->delete();
        }
        return response()->json($checklistArea);

    }

    //get chapter
    public function getChapter(Request $request)
    {
        $chapters = TCheckListChapter::where('module_id', $request->moduleId)->get();
        return response()->json($chapters);
    }

}
