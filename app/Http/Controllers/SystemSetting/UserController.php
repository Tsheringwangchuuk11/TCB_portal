<?php

namespace App\Http\Controllers\SystemSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TRole;

class UserController extends Controller
{
    private $rules = [
        'name' => 'required',
        'username' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
        'profile_pic' => 'mimes:jpeg,jpg,png,bmp|max:2048'
    ];

    public function __construct()
    {
        $this->middleware('permission:system/users,view', ['only' => ['index', 'show']]);
        $this->middleware('permission:system/users,create', ['only' => ['create', 'store']]);
        $this->middleware('permission:system/users,edit', ['only' => ['edit', 'update', 'postDisableToogle']]);
        $this->middleware('permission:system/users,delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $priviliges = $request->instance();
        $users = User::filter($request)->orderBy('user_name')->paginate(30);

        return view('system-settings.users.index', compact('users', 'priviliges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = TRole::orderBy('id')->get();

        return view('system-settings.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->roles)
        {
            return redirect()->back()->with('msg_error', 'You need to select at least one role');
        }

        $this->validate($request, $this->rules);

        \DB::transaction(function () use ($request) {
            //refer uploadImageToDirectory in helpers.php
            if ($request->hasFile('profile_pic')) {
                $imageSource = uploadImageToDirectory($request->file('profile_pic'), 'uploads/user-avatars/');
            }

            $user = new User;

            $user->name = $request->name;
            $user->email = $request->username;
            $user->password = bcrypt($request->password);
            $user->is_verified = 1;
            $user->is_active = 1;
            $user->avatar = isset($imageSource) ? $imageSource : null;
            $user->created_by = auth()->user()->id;

            $user->save();

            $rolesAssigned = [];
            foreach($request->roles as $key => $value) {
                $rolesAssigned[$value] = [
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ];
            }

            $user->roles()->sync($rolesAssigned);
        });

        return redirect('system/users')->with('msg_success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $instance = $request->instance(); //we need to pull the priviliges from the instance
        $canUpdate = (integer) $instance->edit;
        $user = User::with('roles', 'userLogs')->findOrFail($id);
        return view('system-settings.users.show', compact('user', 'canUpdate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = TRole::orderBy('id')->get();
        $user = User::with('roles')->findOrFail($id);
        $rolesAssigned = $user->roles->pluck('id')->toArray();

        return view('system-settings.users.edit', compact('roles', 'user', 'rolesAssigned'));
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
        if (!$request->roles)
        {
            return redirect()->back()->with('msg_error', 'You need to atleast select one role');
        }

        $this->rules['username'] = 'required|unique:users,email,' . $id;
        $this->rules['password'] = '';
        $this->rules['confirm_password'] = '';

        $this->validate($request, $this->rules);

        \DB::transaction(function () use ($request, $id) {
            //refer uploadImageToDirectory in helpers.js
            if ($request->hasFile('profile_pic')) {
                $imageSource = uploadImageToDirectory($request->file('profile_pic'), 'uploads/user-avatars/');
            }

            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->email = $request->username;
            $user->avatar = isset($imageSource) ? $imageSource : null;
            $user->updated_by = auth()->user()->id;

            $user->save();

            $rolesAssigned = [];
            foreach($request->roles as $key => $value) {
                $rolesAssigned[$value] = [
                    'created_by' => $request->user()->id,
                    'updated_by' => $request->user()->id,
                ];
            }

            $user->roles()->sync($rolesAssigned);
        });

        return redirect('system/users')->with('msg_success', 'User updated successfully');
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

    public function postDisableToggle(Request $request)
    {
        $user = User::findOrFail($request->id);

        $disable = false;

        if($user->is_active == 1){
            $disable = true;
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }

        $user->save();

        if($disable){
            return redirect('system/users')->with('msg_success', 'The user account has been suspended.');
        } else {
            return redirect('system/users')->with('msg_success', 'The user account is activated.');
        }
    }

    public function getResetPassword(Request $request, $id)
    {
        $instance = $request->instance(); //we need to pull the priviliges from the instance
        $canUpdate = (integer) $instance->edit;
        $user = User::with('roles')->findOrFail($id);

        return view('system-settings.users.reset-password', compact('user', 'canUpdate'));
    }

    public function postResetPassword(Request $request, $id)
    {
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => bcrypt($request->confirm_password),
            'updated_by' => auth()->user()->id
        ]);

        return redirect('system/users')->with('msg_success', 'Password reset successfully done');
    }
}
