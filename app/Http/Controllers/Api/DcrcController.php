<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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

    public function getHotelsList(Request $request) {
        $hotelsList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'");
        
        $results = [];
        foreach($hotelsList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }
 
    public function getHotelDetails($hotel_id) {
        $hotelsList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'", ['a.id' => $hotel_id]);
        
        $results = [];
        foreach($hotelsList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    public function getHotelCategoryList($category_id) {
        $hotelsList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'", ['a.star_category_id' => $category_id]);
        
        $results = [];
        foreach($hotelsList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    public function getHotelRegionList($region_id) {
        $hotelsList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'", ['a.region_id' => $region_id]);
        
        $results = [];
        foreach($hotelsList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    //Home Stays Api Details
    public function getHomeStayList(Request $request) {
        $homeStayList = DB::select("SELECT
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        i.id AS region_id,
        i.region_name,
        a.company_title_name AS Home_Stay_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        LEFT JOIN t_region_masters i ON a.region_id = i.id
        WHERE c.status_id = '3' AND a.module_id = '2'");
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    public function getHomeStayDetails($home_stay_id) {
        $homeStayList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'", ['a.id' => $home_stay_id]);
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    public function getHomeStayRegionList($region_id) {
        $homeStayList = DB::select("SELECT 
        a.star_category_id,
        b.star_category_name,
        a.company_title_name AS Hotel_Name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_star_categories` b ON a.star_category_id = b.id
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        WHERE c.status_id = '3' AND a.module_id = '1'", ['a.id' => $region_id]);
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);

    }

    //Tented Accomadation Api
    public function getTentedAccList(Request $request) {
        $homeStayList = DB::select("SELECT
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        i.id AS region_id,
        i.region_name,
        a.company_title_name AS tented_accomodation_name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        LEFT JOIN t_region_masters i ON a.region_id = i.id
        WHERE c.status_id = '3' AND a.module_id = '9'");
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);
    }

    public function getTentedAccDetails($tented_acc_id) {
        $homeStayList = DB::select("SELECT
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        i.id AS region_id,
        i.region_name,
        a.company_title_name AS tented_accomodation_name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        LEFT JOIN t_region_masters i ON a.region_id = i.id
        WHERE c.status_id = '3' AND a.module_id = '9'", ['a.id' => $tented_acc_id]);
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);

    }

    public function getTentedAccRegionList($region_id) {
        $homeStayList = DB::select("SELECT
        g.id AS dongkhag_id,
        g.dzongkhag_name,
        i.id AS region_id,
        i.region_name,
        a.company_title_name AS tented_accomodation_name,
        a.webpage_url AS website,
        a.email,
        a.contact_no,
        d.upload_url,
        a.brief_description,
        MAX(h.cost) AS maximum_charge,
        MIN(h.cost) AS minimum_charge,
        a.whatsapp
        FROM `t_applications` a 
        LEFT JOIN `t_workflow_dtls` c ON a.application_no = c.application_no
        LEFT JOIN `t_documents` d ON a.application_no = d.application_no
        LEFT JOIN t_village_masters e ON a.establishment_village_id = e.id
        LEFT JOIN t_gewog_masters f ON e.gewog_id = f.id
        LEFT JOIN t_dzongkhag_masters g ON f.dzongkhag_id = g.id
        LEFT JOIN t_room_applications h ON a.application_no = h.application_no
        LEFT JOIN t_region_masters i ON a.region_id = i.id
        WHERE c.status_id = '3' AND a.module_id = '9'", ['a.region_id' => $region_id]);
        
        $results = [];
        foreach($homeStayList as $rav){
           $rav->hotel_image = base64_encode($rav->upload_url);
           array_push($results, $rav);
        } 
        return response()->json($results);

    }

    //Motor Cycle Rental Api
    public function getMotorCycleList(Request $request) {

    }

    public function getMotorCycleDetails(Request $request) {

    }

    public function getMotorCycleRegionList(Request $request) {

    }

    //Car Rental Api
    public function getCarRentalList(Request $request) {

    }

    public function getCarRentalDetails(Request $request) {

    }

    public function getCarRentalRegionList(Request $request) {

    }

    //Bus Rental Api
    public function getBusRentalList(Request $request) {

    }

    public function getBusRentalDetails(Request $request) {

    }

    public function getBusRentalRegionList(Request $request) {

    }
}
