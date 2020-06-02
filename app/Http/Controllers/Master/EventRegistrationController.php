<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Validator;
class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/travel-fairs-event,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/travel-fairs-event,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/travel-fairs-event,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/travel-fairs-event,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $events = EventRegistration::orderBy('id')->paginate(10);
        return view('master.event_registration.registration_form', compact('events','privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'event_name' => 'required',
            'country_id' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'last_date' => 'required',
            'event_dtls' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->passes()){
        $savedata   =   EventRegistration::create(['event_name' => $request->event_name, 'country_id' => $request->country_id, 'location'=> $request->location ,'start_date'=> $request->start_date,'end_date'=> $request->end_date,'last_date'=> $request->last_date,'event_dtls'=> $request->event_dtls]);
        return response()->json($savedata);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
