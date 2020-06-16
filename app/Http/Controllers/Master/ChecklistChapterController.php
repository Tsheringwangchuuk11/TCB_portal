<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TCheckListChapter;
use App\Models\TModuleMaster;
use App\Models\Dropdown;
use Validator;

class ChecklistChapterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:master/checklist-chapters,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/checklist-chapters,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/checklist-chapters,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/checklist-chapters,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $checklistChapters = TCheckListChapter::orderBy('checklist_ch_name')->with('serviceModule')->paginate(10);
        $checklistChapterCount = TCheckListChapter::count();        
        $serviceModules = TModuleMaster::whereIn('module_name', array('Tourist Standard Hotel', 'Village Home Stay', 'Restaurant'))->get();

        return view('master.checklist-chapter', compact('privileges', 'checklistChapters', 'checklistChapterCount', 'serviceModules'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $userID = $request->checklist_id;
            $rule = [
                'service_module' => 'required',
                'checklist_name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){
                $user   =   TCheckListChapter::updateOrCreate(['id' => $userID],
                    ['module_id' => $request->service_module, 'checklist_ch_name' => $request->checklist_name, 'is_active'=> $request->status == 'yes' ? '1' : 0, 'created_by'=> auth()->user()->id ]);
            $moduleName = $user->serviceModule->module_name;
			return response()->json($user);
            }

            return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $checklistChapter = TCheckListChapter::with('serviceModule')->where('id', $id)->first();
        // dd($checklistChapter);

		return response()->json($checklistChapter);
    }
   //delete
    public function destroy($id)
    {
        try {
            $checklistChapter = TCheckListChapter::findOrFail($id);
            $checklistChapter->delete();

            return redirect('master/checklist-chapters')->with('msg_success', 'checklist chapter successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This checklist chapter  cannot be deleted as it is link in other data.');
        }
    }
}
