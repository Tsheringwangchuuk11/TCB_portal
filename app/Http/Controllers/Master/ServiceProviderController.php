<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\ServiceProvider;
use Validator;
class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:master/service-provider,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:master/service-provider,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:master/service-provider,edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:master/service-provider,delete', ['only' => 'destroy']);
    }
    public function index(Request $request)
    {
        $data['privileges'] = $request->instance();
        $data['serviceproviderlists'] = ServiceProvider::orderBy('id')->paginate(10);
        return view('master.service_provider_types.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.service_provider_types.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $savedata   =   ServiceProvider::Create(['service_provider_type' => $request->service_provider_type,'created_by' => auth()->user()->id]);
        return redirect('master/service-provider')->with('msg_success', 'New service provider added successfully');
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
        $data = ServiceProvider::findOrFail($id);
        return view('master.service_provider_types.edit', compact('data'));
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
            'service_provider_type' => $request->service_provider_type,
            'is_active' =>$request->is_active,
            'updated_by' =>auth()->user()->id,
       ];
       ServiceProvider::where('id',$id)->update($data);
        return redirect('master/service-provider')->with('msg_success', 'Service provider updated successfully');
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
            $events = ServiceProvider::findOrFail($id);
            $events->delete();
            return redirect('master/service-provider')->with('msg_success', 'Service provider successfully deleted');
        } catch(\Exception $exception){
            return redirect()->back()->with('msg_error', 'This service provider cannot be deleted as it is link in other data.');
        }
    }
}
