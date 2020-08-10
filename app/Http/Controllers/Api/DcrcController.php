<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DcrcController extends Controller
{
    public function getCitizenDetails(Request $request)
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        if ($request->cid_no) {
            $cid = $request->cid_no;
            $api_url = "https://staging-datahub-apim.dit.gov.bt/dcrc_individualcitizendetailapi/1.0.0/citizendetail/".$cid;

            $client_id = "qNneAneiQYeNm0i4VrwGeQurs4ca"; //enter the consumer_key
            $client_secret = "aEoji4CYv4jEOEM3UZ5zxr7fdgka"; //enter consumer secret
            $access_token = "207ab579-c0a3-39cd-be10-d16b307b0bef"; //enter provided token

            $cl = curl_init();
            curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
            /* uncomment the next line in case you don't have the required SSL certificates */
            curl_setopt($cl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($cl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token));


            curl_setopt($cl, CURLOPT_URL, "$api_url");
            $response = curl_exec($cl);
            $data = json_decode($response, true);
            //echo var_dump($data); exit;
            if($data['citizendetails']) {
                foreach ($data['citizendetails'] as $cDetails) {
                    $cDetailData = $cDetails;
                }
                //print_r($response);
                curl_close($cl);
                echo json_encode($cDetailData[0]);
            }else{
                echo json_encode(null);
            }

        }
    }
}
