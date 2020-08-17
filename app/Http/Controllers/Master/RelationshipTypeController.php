<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\RelationshipType;
use Validator;
class RelationshipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/relationship,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/relationship,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/relationship,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/relationship,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['relationshiplists'] = RelationshipType::orderBy('id')->paginate(10);
        return view('master.relationship_type.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.relationship_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savedata   =   RelationshipType::Create(['relation_type' => $request->relation_type,'created_by' => auth()->user()->id]);
        return redirect('master/relationship')->with('msg_success', 'New relationship added successfully');
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
        $data = RelationshipType::findOrFail($id);
        return view('master.relationship_type.edit', compact('data'));
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
            'relation_type' => $request->relation_type,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
       RelationshipType::where('id',$id)->update($data);
        return redirect('master/relationship')->with('msg_success', 'relationship updated successfully');
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
            $events = RelationshipType::findOrFail($id);
            $events->delete();
            return redirect('master/relationship')->with('msg_success', 'Relationship successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This relationship cannot be deleted as it is link in other data.');
        }
    }
}
