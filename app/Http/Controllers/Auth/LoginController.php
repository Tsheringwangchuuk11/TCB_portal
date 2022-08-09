<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkFlowDetails;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:oauth')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $email = $request->get($this->username());
        $user = User::where($this->username(), $email)->first();
        $this->incrementLoginAttempts($request);
        if ($user) {
            if ($user->is_verified == 0) {
                return $this->sendFailedLoginResponse($request, 'auth.unverified');
            }

            if ($user->user_status == 0) {
                return $this->sendFailedLoginResponse($request, 'auth.inactive');
            }
        }
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['user_status'] = 1;
        return $credentials;
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $field
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $userLog = User::findOrFail($user->id);
        $userLog->last_login = Carbon::now()->toDateTimeString();
        $userLog->save();
        $user->userLogs()->create([
            'login_ip' => $request->ip(),
            'user_agent' => $request->server('HTTP_USER_AGENT')
        ]);
    }
    public function redirectTo()
    {

        if (sizeof(\auth()->user()->roles()->pluck('role_id')->toArray()) > 1){
            return '/tasklist/tasklist';
        }
        $roles = auth()->user()->roles()->get();

        $roleId = 0;
        foreach ($roles as $role){
            $roleId = $role->id;
        }
        $userId = auth()->user()->user_id;
        $endUserApplicantDtls = WorkFlowDetails::getEndUserApplicationDtls($userId);
        return view('dashboards.public',compact('endUserApplicantDtls'));
    }

    public function username()
        {
            $login = request()->login;
            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                    $field = 'email';
                } else {
                    $field = 'user_id';
                }
                request()->merge([$field => $login]);
                return $field;
        }
}
