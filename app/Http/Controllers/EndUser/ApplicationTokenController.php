<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
class ApplicationTokenController extends Controller
{
    public function oAuthRedirect(Request $request){
        $queries= http_build_query([
            'client_id'=>'MRNEQWUn8AU7ii_99B_I5ihUG80a',
            'redirect_uri'=>'http://portal.tourism.gov.bt/sso/enduser_dashboard',
            'response_type'=>'code',
        ]); 
        return redirect('https://stg-sso.dit.gov.bt/oauth2/authorize?'.$queries );
    }

    public function callBack(Request $request){
        $http = new GuzzleHttp\Client;
        $response = $http->post('https://stg-­sso.dit.gov.bt/oauth2/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 'MRNEQWUn8AU7ii_99B_I5ihUG80a',
                'client_secret' => 'WYUyM5ZMLYOe03CaSd4VEuUQ2f0a',
                'redirect_uri' => 'http://portal.tourism.gov.bt/sso/enduser_dashboard',
                'code' => $request->code,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    } 
}
