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
        // $checklistStandardCount = TCheckListStandard::count();
        // $checklistAreas = Dropdown::getDropdowns("t_check_list_areas","id","checklist_area","0","0");
        // $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        // $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");

        return view('master.checklist-standard.index', compact('privileges', 'checklistStandards'));
    }

    public function create()
    {
        $checklistAreas = Dropdown::getDropdowns("t_check_list_areas","id","checklist_area","0","0");
        $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");

        return view('master.checklist-standard.create', compact('checklistAreas', 'starCategories', 'basicStandards'));
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

                    foreach($request->checklist as $key => $value){
                        $checklists[] = [
                            'star_category_id' => $value['star_category'],
                            'standard_id' => $value['basic_standard'],
                            'mandatory' => $value['mandatory']== 1 ? 1 : 0,
                            'is_active' => $value['status'] == 'yes' ? 1 : 0,
                            'created_by'=> auth()->user()->id
                        ];
                    }
                    $checklistStandard->standardMapping()->sync($checklists);
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
        $checklistStandard =TCheckListStandard::with('standardMapping')->findOrFail($id);
        $checklistAreas = Dropdown::getDropdowns("t_check_list_areas","id","checklist_area","0","0");
        $starCategories = Dropdown::getDropdowns("t_star_categories","id","star_category_name","0","0");
        $basicStandards = Dropdown::getDropdowns("t_basic_standards","id","standard_code","0","0");

        return view('master.checklist-standard.edit', compact('checklistStandard', 'checklistAreas', 'starCategories', 'basicStandards'));
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

                foreach($request->checklist as $key => $value){
                    $checklists[] = [
                        'star_category_id' => $value['star_category'],
                        'standard_id' => $value['basic_standard'],
                        'mandatory' => $value['mandatory']== 1 ? 1 : 0,
                        'is_active' => $value['status'] == 'yes' ? 1 : 0,
                        'created_by'=> auth()->user()->id,
                        'updated_by'=> auth()->user()->id,
                    ];
                }
                $checklistStandard->standardMapping()->sync($checklists);
            });
         }
    return redirect('master/checklist-standards')->with('msg_success', 'checklist standard updated successfully');

    }
//     public function store(Request $request)
//     {
//             $checklistStandardID = $request->checklist_standard_id;
//             $rule = [
//                 'checklist_area' => 'required',
//                 'checklist_standard_name' => 'required',
//             ];
//             $validator = Validator::make($request->all(), $rule);
//             if($validator->passes()){
//                 $checklistStandard   =   TCheckListStandard::updateOrCreate(['id' => $checklistStandardID],
//                     ['checklist_area_id' => $request->checklist_area, 'checklist_standard' => $request->checklist_standard_name, 'checklist_pts' => $request->checklist_point, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);

//                     $checklists = [];

//             foreach($request->checklist as $key => $value){
//                 $checklists[] = [
//                     'star_category_id' => $value['star_category'],
//                     'standard_id' => $value['basic_standard'],
//                     'mandatory' => $value['mandatory']== 1 ? 1 : 0,
//                     'is_active' => $value['status'] == 'yes' ? 1 : 0,
//                     'created_by'=> auth()->user()->id
//                 ];
//             }
//             $checklistStandard->standardMapping()->createMany($checklists);

// 			return response()->json($checklistStandard);
//             }

//             return response()->json(['error' => $validator->errors()->all() ]);
//     }


//     public function edit($id)
//     {
//         $checklistStandard = TCheckListStandard::where('id', $id)->first();

// 		return response()->json($checklistStandard);
//     }
//    //delete
//     public function destroy($id)
//     {
//         $checklistStandard = TCheckListStandard::where('id', $id)->delete();
// 		return response()->json($checklistStandard);
//     }
}
