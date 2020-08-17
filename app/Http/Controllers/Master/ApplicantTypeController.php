<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\ApplicantTypes;
use Validator;

class ApplicantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/applicant-types,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/applicant-types,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/applicant-types,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/applicant-types,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['applicanttypeslists'] = ApplicantTypes::orderBy('id')->paginate(10);
        return view('master.applicant_types.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.applicant_types.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $savedata   =   ApplicantTypes::Create(['applicant_type' => $request->applicant_type,'created_by' => auth()->user()->id]);
        return redirect('master/applicant-types')->with('msg_success', 'New appicant types added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ApplicantTypes::findOrFail($id);
        return view('master.applicant_types.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[
            'applicant_type' => $request->applicant_type,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
        ApplicantTypes::where('id',$id)->update($data);
        return redirect('master/applicant-types')->with('msg_success', 'Applicant type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $events = ApplicantTypes::findOrFail($id);
            $events->delete();
            return redirect('master/applicant-types')->with('msg_success', 'Applicant type successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This applicant types cannot be deleted as it is link in other data.');
        }
    }
}
