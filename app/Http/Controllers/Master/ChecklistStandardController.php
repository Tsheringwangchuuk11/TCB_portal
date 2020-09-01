<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListStandardMapping;
use App\Models\TCheckListStandard;
use App\Models\TCheckListChapter;
use App\Models\TCheckListArea;
use App\Models\TModuleMaster;
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
        $serviceModules = TModuleMaster::whereIn('id', array('1', '2', '3', '4', '9'))->get();
        $checklistStandards = TCheckListStandard::filter($request)->orderBy('id', 'ASC')->with('checklistArea')->paginate(100);
        if($request->ajax()){
            $checklistStandards = TCheckListStandard::filter($request)->with('checklistArea')->paginate(100);
            return view('master.includes.checklist_standard_data', compact('serviceModules', 'privileges', 'checklistStandards'))->render();
        }
        return view('master.checklist-standard', compact('serviceModules', 'privileges', 'checklistStandards'));
    }

    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $rule = [
                'checklist_area' => 'required',
                'checklist_standard' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){

                \DB::transaction(function () use ($request) {
                    $checklist_point = null;
                    if (isset($request->checklist_point)){
                        $checklist_point = $request->checklist_point;
                    }elseif (isset($request->checklist_point1)){
                        $checklist_point = $request->checklist_point1;
                    }
                    $checklistStandard = TCheckListStandard::updateOrCreate(['id'=>$request->checklist_standard_id],
                        [
                            'checklist_area_id'  => $request->checklist_area,
                            'checklist_standard' => $request->checklist_standard,
                            'checklist_pts'      => $checklist_point,
                            'is_active'          => $request->status == 'yes' ? '1' : 0,
                            'created_by'         => auth()->user()->id
                        ]);

                    $checklists = [];
                    if((isset($request->checklistStandards)) == true){
                            foreach($request->checklistStandards as $key => $value){

                                $checklists[] = [
                                    'star_category_id' => isset($value['star_category_id']) == true ? $value['star_category_id']: null,
                                    'standard_id' => isset($value['basic_standard']) == true ? $value['basic_standard']: null,
                                    'mandatory' => isset($value['mandatory']) == true ? $value['mandatory']: null,
                                    'is_active' => $value['status'],
                                    'created_by'=> auth()->user()->id
                                ];
                            }
                        $checklistStandard->standardMapping()->sync($checklists);
                        }else{
                            $basic_standard_id = null;
                            if (isset($request->basic_standard)){
                                $basic_standard_id = $request->basic_standard;
                            }elseif (isset($request->basic_standard1)){
                                $basic_standard_id = $request->basic_standard1;
                            }

                            TCheckListStandardMapping::updateOrCreate(['id' => $request->standard_mapping_id],[
                                'checklist_id' => $checklistStandard->id,
                                'standard_id' => $basic_standard_id,
                                'is_active' => '1',
                                'created_by'=> auth()->user()->id
                            ]);
                        }


                });
                return response()->json($request->checklist_standard);
             }
        return response()->json(['error' => $validator->errors()->all() ]);

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $checklistStandard =TCheckListStandard::with('checklistStandardMapping')->findOrFail($id);
       return response()->json($checklistStandard);
    }

    public function update(Request $request, $id)
    {


    }


    public function destroy($id)
    {
        $checklistStandard = TCheckListStandard::findOrFail($id);
        try {
            $checklistStandard->checklistStandardMapping()->delete();
            $checklistStandard->delete();
            $checklistStandard['flag'] = true;
            return response()->json($checklistStandard);
        } catch(\Exception $exception){
            $checklistStandard['flag'] = false;
            return response()->json($checklistStandard);
        }
    }

    /**
    * get checklist chapter
    */
    public function getChapter(Request $request)
    {
        $chapters = TCheckListChapter::where('module_id', $request->moduleId)->get();
        return response()->json($chapters);
    }

    /**
    * get checklist standard
    */
    public function getChecklistArea(Request $request)
    {
        $checklistAreas = TCheckListArea::where('checklist_ch_id', $request->checklistId)->get();
        return response()->json($checklistAreas);
    }

    public function  getBasicStandardDtls(){
        $basicStandards = Dropdown::getBasicStandardLists('notIn');
        $starCategories = Dropdown::getDropdowns('t_star_categories', 'id', 'star_category_name', 'module_id', '1');
        return view('master.includes.basic_standard_data', compact('starCategories', 'basicStandards'))->render();
    }

}


