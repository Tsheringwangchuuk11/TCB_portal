<?php

namespace App\Http\Controllers\EventRegistation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Validator;
use App\Models\Dropdown;
use App\Models\Services;
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
        $data['privileges'] = $request->instance();
        $data['events'] = EventRegistration::getEventDetails();
        return view('event.event_registration.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Dropdown::getDropdownList("3");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        return view('event.event_registration.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Services $service)
    {
       $savedata   =   EventRegistration::Create([
           'event_name' => $request->event_name,
            'country_id' => $request->country_id,
            'event_location'=> $request->event_location ,
            'start_date'=> $service->setDateAttribute($request->start_date),
            'village_id'=> $request->village_id ,
            'web_site'=> $request->web_site,
            'email'=> $request->email ,
            'contact_person'=> $request->contact_person,
            'mobile_no'=> $request->mobile_no ,
            'end_date'=>$service->setDateAttribute($request->end_date),
            'last_date'=>$service->setDateAttribute($request->last_date),
            'event_dtls'=> $request->event_dtls,
            'created_by' => auth()->user()->id
        ]);
       return redirect('events/travel-fairs-event')->with('msg_success', 'New event added successfully');
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
        $data['countries'] = Dropdown::getDropdownList("3");
        $data['dzongkhagLists'] = Dropdown::getDropdowns("t_dzongkhag_masters","id","dzongkhag_name","0","0");
        $data['data'] = EventRegistration::editEventDetail($id);
        return view('event.event_registration.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data=[
            'event_name' => $request->event_name,
            'country_id' =>$request->country_id,
            'event_location' =>$request->event_location,
            'last_date'=>$service->setDateAttribute($request->last_date),
            'start_date'=> $service->setDateAttribute($request->start_date),
            'web_site' =>$request->web_site,
            'email' =>$request->email,
            'contact_person' =>$request->contact_person,
            'mobile_no' =>$request->mobile_no,
            'end_date'=>$service->setDateAttribute($request->end_date),
            'village_id' =>$request->village_id,
            'event_dtls' =>$request->event_dtls,
            'updated_by' =>auth()->user()->id,
       ];
       EventRegistration::where('id',$id)->update($data);
        return redirect('events/travel-fairs-event')->with('msg_success', 'event updated successfully');
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
