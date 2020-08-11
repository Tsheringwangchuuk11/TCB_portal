<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\RoomType;
use Validator;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/room-types,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/room-types,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/room-types,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/room-types,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
            $data['privileges'] = $request->instance();
            $data['roomtypeslists'] = RoomType::orderBy('id')->paginate(10);
            return view('master.roomtypes.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.roomtypes.create');

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
            'room_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->passes()){
        $savedata   =   RoomType::Create(['room_name' => $request->room_name]);
        return redirect('master/room-types')->with('msg_success', 'New room types added successfully');

       }
       return response()->json(['error' => $validator->errors()->all() ]); 
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
        $data = RoomType::findOrFail($id);
        return view('master.roomtypes.edit', compact('data'));
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
        $data= $request->validate([
                 'room_name' => 'required',
                 'is_active' => 'required',
            ]);

        RoomType::where('id',$id)->update( $data);
        return redirect('master/room-types')->with('msg_success', 'Room type updated successfully');
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
            $events = RoomType::findOrFail($id);
            $events->delete();
            return redirect('master/room-types')->with('msg_success', 'Room type successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This room types cannot be deleted as it is link in other data.');
        }
    }
}
