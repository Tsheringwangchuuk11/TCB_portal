<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Country;
use Validator;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/country,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/country,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/country,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/country,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['countrylists'] = Country::orderBy('id')->paginate(10);
        return view('master.country.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.country.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savedata   =   Country::Create(['country_name' => $request->country_name,'created_by' => auth()->user()->id]);
        return redirect('master/country')->with('msg_success', 'New country added successfully');
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
        $data = Country::findOrFail($id);
        return view('master.country.edit', compact('data'));
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
            'country_name' => $request->country_name,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
       Country::where('id',$id)->update($data);
        return redirect('master/country')->with('msg_success', 'Country updated successfully');
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
            $events = Country::findOrFail($id);
            $events->delete();
            return redirect('master/country')->with('msg_success', 'Country successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This country cannot be deleted as it is link in other data.');
        }
    }
}
