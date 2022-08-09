<?php

namespace App\Http\Controllers\EndUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\OauthUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ApplicationTokenController extends Controller
{
    use AuthenticatesUsers;

    public function __construct() {
        $this->client = new Client([
            'curl' => [
                CURLOPT_SSL_VERIFYPEER => false,
             ],
            'base_uri' => env('BASE_URl'),
            //'timeout'  => 2.0,
          ]);
      }

    public function oAuthRedirect(Request $request){
      if($request->session()->get('expires_in') > time()){
        return redirect()->intended('/enduser_dashboard');
       }else{
        $queries= http_build_query([
            'response_type'=>'code',
            'scope' => 'openid',
            'client_id'=>env('CONSUMER_KEY'),
            'redirect_uri'=>env('REDIRECT_URI'),
        ]); 
        return redirect('https://sso.dit.gov.bt/oauth2/authorize?'.$queries );
       }
    }

    public function callBack(Request $request){
        $response = $this->client->request('POST','oauth2/token', [
            'form_params' => [
              'client_id' =>env('CONSUMER_KEY'),
              'client_secret' =>env('CONSUMER_SECRET'),
              'grant_type' => "authorization_code",
              'code' => $request->code,
              'redirect_uri'=>env('REDIRECT_URI')
                ]
            ]);

        if($response->getStatusCode()==200) {
            $json =json_decode($response->getBody());
            $id_token = explode(".", $json->id_token);
            $json_token = json_decode(base64_decode($id_token[1]), true);
                $user_id=$json_token['username'];
                $user_name=$json_token['firstName'];
                 $request->session()->put('access_token', $json->access_token);
                 $request->session()->put('refresh_token', $json->refresh_token);
                 $request->session()->put('expires_in', time() + $json->expires_in);
                $isOauthUser = OauthUser::where('user_id', $user_id)->first();
                if($isOauthUser){
                    $isOauthUser->id_token=$json->id_token;
                    $isOauthUser->access_token=$json->access_token;
                    $isOauthUser->refresh_token=$json->refresh_token;
                    $isOauthUser->last_login_at = Carbon::now()->toDateTimeString();
                    $isOauthUser->save();
                    Auth::guard('oauth')->login($isOauthUser);
                    return redirect()->intended('/enduser_dashboard');
                }else{
                    $isOauthUser=new OauthUser;
                    $isOauthUser->user_id=$user_id;
                    $isOauthUser->user_name=$user_name;
                    $isOauthUser->id_token=$json->id_token;
                    $isOauthUser->access_token=$json->access_token;
                    $isOauthUser->refresh_token=$json->refresh_token;
                    $isOauthUser->token_type=$json->token_type;
                    $isOauthUser->scope=$json->scope;
                    $isOauthUser->expires_in=$request->session()->get('expires_in');
                    $isOauthUser->last_login_at = Carbon::now()->toDateTimeString();
                    $isOauthUser->save();
                    Auth::guard('oauth')->login($isOauthUser);
                    return redirect()->intended('/enduser_dashboard');
                }
            }
        else{
            return "Something went wrong. Please try again later";
        } 
    } 


    public function logoutCallBack() {
        Auth::logout();
        return redirect('/');
    }

    private function getAuthorizationCode() {
    return base64_encode('MRNEQWUn8AU7ii_99B_I5ihUG80a'.':'.'WYUyM5ZMLYOe03CaSd4VEuUQ2f0a');
    }

    protected function guard()
    {
        return Auth::guard('oauth');
    }
      
}
