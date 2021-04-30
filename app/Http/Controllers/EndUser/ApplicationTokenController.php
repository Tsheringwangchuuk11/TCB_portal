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
            'timeout'  => 2.0,
          ]);
      }
    public function oAuthRedirect(Request $request){
        $queries= http_build_query([
            'response_type'=>'code',
            'scope' => 'openid',
            'client_id'=>env('CONSUMER_KEY'),
            'redirect_uri'=>env('REDIRECT_URI'),
        ]); 
        return redirect('https://stg-sso.dit.gov.bt/oauth2/authorize?'.$queries );
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
                $isOauthUser = OauthUser::where('user_id', $user_id)->first();
                if($isOauthUser){
                    $isOauthUser->last_login_at = Carbon::now()->toDateTimeString();
                    $isOauthUser->save();
                    Auth::guard('oauth')->login($isOauthUser);
                    return redirect()->intended('/enduser_dashboard');
                }else{
                    $createOauthUser = OauthUser::create([
                        'user_id' =>  $user_id,
                        'user_name' =>  $user_name
                    ]);
                    Auth::guard('oauth')->login($createOauthUser);
                    return redirect()->intended('/enduser_dashboard');
                }
            }
        else{
            return "Something went wrong. Please try again later";
        } 
    } 

        public function logout() {
            $client = new Client([
                   'curl' => [
                       CURLOPT_SSL_VERIFYPEER => false,
                    ],
                 ]);
       
             $response = $client->request('POST', 'https://stg-sso.dit.gov.bt/oidc/logout', [
                   'form_params' => [
                     'post_logout_redirect_uri' => 'https://portal.tourism.gov.bt/sso/logout',
                     'id_token_hint'=>auth()->user()->id_token,
                    ]
                ]);   
            } 
       
      


      public function logoutCallBack() {
        Auth::logout();
        return redirect('/login');
      }

      private function getAuthorizationCode() {
        return base64_encode('MRNEQWUn8AU7ii_99B_I5ihUG80a'.':'.'WYUyM5ZMLYOe03CaSd4VEuUQ2f0a');

        }

    protected function guard()
    {
        return Auth::guard('oauth');
    }
      
}
