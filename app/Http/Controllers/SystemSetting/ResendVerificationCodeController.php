<?php

namespace App\Http\Controllers\SystemSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class ResendVerificationCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:system/resend-verification-codes,view', ['only' => 'index']);
        $this->middleware('permission:system/resend-verification-codes,edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $privileges = $request->instance();
        $users = User::filter($request)->where('is_verified', 0)->orderBy('name')->paginate(30);

        return view('system-settings.resend-verification-code.index', compact('users', 'privileges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('system-settings.resend-verification-code.edit', compact('user'));
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
        $user = User::findOrFail($id);
        $rules = [
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'email' => '|unique:users,email,' . $user->id,
        ];
        $this->validate($request, $rules);

        $user->update ([
            'email' => $request->email,
            'password' => Hash::make($request->confirm_password),
            'is_verified' => 0,
            'is_active' => 0,
            'email_verification_token' => str_random(60),
            'updated_by' => auth()->user()->id
        ]);

        $user->sendNewUserCredentialNotification($request->confirm_password);

        return redirect('system/resend-verification-codes')->with('msg_success', 'New Verification Code has been successfully emailed to the user.');

    }
}
