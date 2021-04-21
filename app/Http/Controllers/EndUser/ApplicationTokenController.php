<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
class ApplicationTokenController extends Controller
{
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
        return view('dashboards.public');
        }
        else{

            return "Something went wrong. Please try again later";
        } 
    } 
}
