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
        $checklistStandards = TCheckListStandard::orderBy('id', 'DESC')->with('checklistArea')->paginate(100);

        return view('master.checklist-standard.index', compact('privileges', 'checklistStandards'));
    }

    public function create()
    {
        $checklistAreas = Dropdown::getDropdowns("t_check_list_areas","id","checklist_area","0","0");
        $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");        
        $serviceModules = TModuleMaster::whereIn('module_name', array('Tourist Standard Hotel', 'Village Home Stay', 'Restaurant'))->get();                   

        return view('master.checklist-standard.create', compact('checklistAreas', 'starCategories', 'basicStandards', 'serviceModules'));
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
                'checklist_standard_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){

                \DB::transaction(function () use ($request) {

                    $checklistStandard = new TCheckListStandard;

                    $checklistStandard->checklist_area_id = $request->checklist_area;
                    $checklistStandard->checklist_standard = $request->checklist_standard_name;
                    $checklistStandard->checklist_pts = $request->checklist_point;
                    $checklistStandard->is_active = $request->status == 'yes' ? '1' : 0;
                    $checklistStandard->created_by = auth()->user()->id;
                    $checklistStandard->save();

                    $checklists = [];
                    if((isset($request->checklist)) == true){
                            foreach($request->checklist as $key => $value){
                                
                                $checklists[] = [
                                    'star_category_id' => isset($value['star_category']) == true ? $value['star_category']: null,
                                    'standard_id' => isset($value['basic_standard']) == true ? $value['basic_standard']: null,
                                    'mandatory' => isset($value['mandatory']) == true ? $value['mandatory']: null,
                                    'is_active' => $value['status'],
                                    'created_by'=> auth()->user()->id
                                ];
                            }
                        }else{
                            TCheckListStandardMapping::create([
                                'checklist_id' => $checklistStandard->id,
                                'is_active' => '1',
                                'created_by'=> auth()->user()->id
                            ]);
                        }
                    $checklistStandard->standardMapping()->attach($checklists);
                });
             }
        return redirect('master/checklist-standards')->with('msg_success', 'checklist standard created successfully');

    }

    public function show($id)
    {
        $checklistStandard =TCheckListStandard::with('standardMapping')->findOrFail($id);

        return view('master.checklist-standard.show', compact('checklistStandard'));
    }

    public function edit($id)
    {
        $checklistStandard =TCheckListStandard::with('checklistArea.checklistChapter.serviceModule', 'standardMapping')->findOrFail($id);              
        $checklistChapters = TCheckListChapter::whereIn('module_id', array($checklistStandard->checklistArea->checklistChapter->serviceModule->id))->get();
        $checklistAreaLists = TCheckListArea::whereIn('checklist_ch_id', array($checklistStandard->checklistArea->checklistChapter->id))->get();                 
        $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");
        $serviceModules = TModuleMaster::whereIn('module_name', array('Tourist Standard Hotel', 'Village Home Stay', 'Restaurant'))->get();             

        return view('master.checklist-standard.edit', compact('checklistStandard', 'starCategories', 'basicStandards', 'serviceModules', 'checklistChapters', 'checklistAreaLists'));
    }

    public function update(Request $request, $id)
    {                           
        $rule = [
            'checklist_area' => 'required',
            'checklist_standard_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->passes()){

            \DB::transaction(function () use ($request, $id) {

                $checklistStandard = TCheckListStandard::findOrFail($id);

                $checklistStandard->checklist_area_id = $request->checklist_area;
                $checklistStandard->checklist_standard = $request->checklist_standard_name;
                $checklistStandard->checklist_pts = $request->checklist_point;
                $checklistStandard->is_active = $request->status == 'yes' ? '1' : 0;
                $checklistStandard->updated_by = auth()->user()->id;
                $checklistStandard->save();

                $checklists = [];

                if((isset($request->checklist)) == true)
                {
                    foreach($request->checklist as $key => $value){                        
                        $checklists[] = [
                            'star_category_id' => isset($value['star_category']) == true ? $value['star_category']: null,
                            'standard_id' => isset($value['basic_standard']) == true ? $value['basic_standard']: null,
                            'mandatory' => isset($value['mandatory']) == true ? $value['mandatory']: null,
                            'is_active' => $value['status'],
                            'created_by'=> auth()->user()->id,
                            'updated_by'=> auth()->user()->id,
                        ];
                    }
                }else{
                    TCheckListStandardMapping::create([
                        'checklist_id' => $checklistStandard->id,
                        'is_active' => '1',
                        'created_by'=> auth()->user()->id,
                        'updated_by'=> auth()->user()->id,
                    ]);
                }                
                $checklistStandard->standardMapping()->sync($checklists);
            });

         }
    return redirect('master/checklist-standards')->with('msg_success', 'checklist standard updated successfully');

    }


    public function destroy(Request $request, $id)
    {
        try {
            $checklistStandard = TCheckListStandard::findOrFail($id);
            $checklistStandard->delete();
            return redirect('master/checklist-standards')->with('msg_success', 'checklist standard successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This checklist standard  cannot be deleted as it is link in other data.');
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

}


