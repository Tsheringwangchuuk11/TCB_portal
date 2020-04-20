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
            $basicStandardID = $request->basic_standard_id_;
            $rule = [
                'standard_code' => 'required',
                'standard_desc' => 'required',
            ];
            $validator = Validator::make($request->all(), $rule);
            if($validator->passes()){
                $basicStandard   =   TBasicStandard::updateOrCreate(['id' => $basicStandardID],
                    ['standard_code' => $request->standard_code, 'standard_desc' => $request->standard_desc, 'created_by'=> auth()->user()->id ]);

			return response()->json($basicStandard);
            }

            return response()->json(['error' => $validator->errors()->all() ]);
    }


    public function edit($id)
    {
        $basicStandard = TBasicStandard::where('id', $id)->first();

		return response()->json($basicStandard);
    }
   //delete
    public function destroy($id)
    {
        $basicStandard = TBasicStandard::where('id', $id)->delete();
		return response()->json($basicStandard);
    }
}
