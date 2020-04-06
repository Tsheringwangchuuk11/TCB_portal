<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use DB;

class ServiceModel extends Model
{

    //generate application_no
	private function generateApplNo($serviceId,$moduleId)
	{
		$lastApplNo = $this->getSequenceNo($serviceId);
		$applNo=$lastApplNo->last_application_no;
		$moduleIdLength=strlen($moduleId);
		$serviceIdLength=strlen($serviceId);
		$application_no = "";
		$newApplNo=$applNo+1;
		$sql=DB::table('t_application_last_serial_number as t1')
		->where('t1.service_id',$serviceId)
		->update(['t1.last_application_no' =>$newApplNo ]);
		$newApplNo=str_pad($newApplNo,7,0,STR_PAD_LEFT);
		
			if($moduleIdLength!=2){
				$application_no = "0";
				$application_no .= $moduleId;                
			}else{
				$application_no = $moduleId;
			}
			if($serviceIdLength!=2){
				$application_no .= "0";
				$application_no.= $serviceId; 
			}else{
				$application_no.= $serviceId; 
			}
		$application_no .= $newApplNo;
		return $application_no;
	}
	private function getSequenceNo($serviceId){
        $lastapplNo=DB::table('t_application_last_serial_number as t1')
        ->select('t1.last_application_no','t1.id')
        ->where('t1.service_id',$serviceId)
        ->orderBy('id', 'DESC')->first();
        return $lastapplNo;
	}
	 //accessors
     public function getLicense_dateAttribute($value){
		return date('m/d/Y', strtotime($value));
		}
	  //mututor
	  public function setLicense_dateAttribute($value){
		$this->attributes['dob'] = date('Y-m-d', strtotime($value));
		}
 
    //insert into t_application
	public function saveApplicantDetails($request){
		$serviceId=$request->service_id;
		$moduleId=$request->module_id;
		$application_no = $this->generateApplNo($serviceId,$moduleId);
		$service_id=$request->service_id;
		$module_id=$request->module_id;
		$cid_no=$request->cid_no;
		$name=$request->name;
		$name_one=$request->name_one;
		$name_two=$request->name_two;
		$proposed_location=$request->proposed_location;
		$location_id=$request->location_id;
		$contact_no=$request->contact_no;
		$tentative_cons=$request->tentative_cons;
		$tentative_com=$request->tentative_com;
		$drawing_date=$request->drawing_date;
		$email=$request->email;
		$star_category_id=$request->star_category_id;
		$license_no=$request->license_no;
		$owner=$request->owner;
		$address=$request->address;
		$internet_url=$request->internet_url;
		$bed_no=$request->bed_no;
		$thram_no=$request->thram_no;
		$house_no=$request->house_no;
		$town_distance=$request->town_distance;
		$road_distance=$request->road_distance;
		$condition=$request->condition;
		$validity_date=$request->validity_date;
		$flat_no=$request->flat_no;
		$building_no=$request->building_no;
		$license_date=$request->license_date;
		$fax=$request->fax;
		$submissiond_date=$request->submissiond_date;
		$save=DB::table('t_application')
				 ->insert(['application_no'=>$application_no,'module_id'=>$module_id,'service_id'=>$service_id,
						 'cid_no'=>$cid_no,'name'=>$name,'name_one'=>$name_one,'name_two'=>$name_two,
						 'proposed_location'=>$proposed_location,'location_id'=>$location_id,'contact_no'=>$contact_no,
						 'tentative_cons'=>$tentative_cons,'tentative_com'=>$tentative_com,'drawing_date'=>$drawing_date,
						 'email'=>$email,'star_category_id'=>$star_category_id,'license_no'=>$license_no,'license_date'=>$license_date,'owner'=>$owner,
						 'fax'=>$fax,'address'=>$address,'internet_url'=>$internet_url,'bed_no'=>$bed_no,'thram_no'=>$thram_no,
						 'house_no'=>$house_no,'town_distance'=>$town_distance,'road_distance'=>$road_distance,'condition'=>$condition,
						 'validity_date'=>$validity_date,'flat_no'=>$flat_no,'building_no'=>$building_no,'submissiond_date'=>now()]);
	
//insert into child table
		       
		$room_type_id=$request->room_type_id;
		$room_no=$request->room_no;
		if(isset($room_type_id)){
			foreach($room_type_id as $key => $value)
			{		
				$arrData = array( 
					'application_no' => $application_no,
					'room_type_id'   => $room_type_id[$key], 
					'room_no'        => $room_no[$key], 
				);
				DB::table('t_room_application')->insert($arrData);
			}
		}

		$staff_area_id=$request->staff_area_id;
		$hotel_div_id=$request->hotel_div_id;
		$staff_name=$request->staff_name;
		$staff_gender=$request->staff_gender;
		if(isset($staff_area_id)){
			foreach($staff_area_id as $key => $value)
			{		
				$arrData = array( 
					'application_no'  => $application_no,
					'staff_area_id'   => $staff_area_id[$key], 
					'hotel_div_id'    => $hotel_div_id[$key], 
					'staff_name'      => $staff_name[$key],
					'staff_gender'    => $staff_gender[$key], 
				);
				DB::table('t_staff_application')->insert($arrData);
			}
		}
				
		
	}


}
// ends ServiceModel
