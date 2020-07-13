<?php

namespace App\Http\Controllers\EventRegistation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Validator;
use App\Models\Dropdown;
class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:events/travel-fairs-event,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:events/travel-fairs-event,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:events/travel-fairs-event,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:events/travel-fairs-event,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $countries = Dropdown::getDropdowns("t_country_masters","id","country_name","0","0");
        $events = EventRegistration::getEventDetails();
        return view('event.event_registration.registration_form', compact('events','privileges','countries'));
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
        //return response()->json($savedata);
         $rule = [
            'event_name' => 'required',
            'country_id' => 'required',
            'event_location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'last_date' => 'required',
            'event_dtls' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->passes()){
        $savedata   =   EventRegistration::updateOrCreate(['id' => $request->event_id],['event_name' => $request->event_name, 'country_id' => $request->country_id, 'event_location'=> $request->event_location ,'start_date'=> $request->start_date,'end_date'=> $request->end_date,'last_date'=> $request->last_date,'event_dtls'=> $request->event_dtls]);
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
        $event = EventRegistration::where('id', $id)->first();
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
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
            $events = EventRegistration::findOrFail($id);
            $events->delete();
            return redirect('events/travel-fairs-event')->with('msg_success', 'Events successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This events cannot be deleted as it is link in other data.');
        }
    }
}
