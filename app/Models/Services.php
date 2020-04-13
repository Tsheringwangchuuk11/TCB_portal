<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Services extends Model
{

	public static function getServiceLists($request){
		$moduleId=$request->moduleId;
		$query=DB::table("t_module_service_mapping as t1")
				->join('t_service_master as t2', 't2.service_id', '=', 't1.service_id')
				->select('t1.page_link', 't2.service_name')
				->where('module_id', $moduleId)
				->get()
				->pluck("service_name","page_link");
		return $query;

	}
	public static function getIdInfo($page_link){
		$idInfos=DB::table('t_module_service_mapping as t1')
					->join('t_service_master as t2', 't2.service_id', '=', 't1.service_id')
					->join('t_module_master as t3', 't3.module_id', '=', 't1.module_id')
					->select('t1.module_id','t1.service_id','t2.service_name','t3.module_name')
					->where('t1.page_link',$page_link)
					->get();
		return $idInfos;
	}

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
	
//insert into t_room_application
		       
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
//insert into t_staff_application
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
				
//insert into t_checklist_application
		
	}

	public static function getChapterList($id)
	{
		$checklistchapter = DB::table('t_checklist_chapter')
			->select('checklist_ch_id', 'checklist_ch_name')
			->where('module_id', $id)
			->get();
		return $checklistchapter;
	}

	public static function getCheckListAreas($id)
	{
		$area = DB::table('t_checklist_area as t1')
					->leftJoin('t_checklist_standard as t2', 't2.checklist_area_id', '=', 't1.checklist_area_id')
					->select('t1.checklist_area_id','t1.checklist_name', DB::raw("COUNT('t2.checklist_area_id') as count1"))
					->where('t1.checklist_ch_id', $id)
					->groupBy('t1.checklist_area_id', 't1.checklist_name')
					->get();
        return $area;
	}

	public static function getCheckListStandards($id)
	{
		$standard = DB::table('t_checklist_standard as t1')
					->select('t1.checklist_id','t1.checklist_standard')
					->where('t1.checklist_area_id', $id)
					->get();
        return $standard;
	}


	public static function getCheckListChapter($request){
		$moduleId = $request->module_id;
		$starCategoryId = $request->star_category_id;
		$chapter = DB::table('t_checklist_chapter as t1')
		            ->leftJoin('t_star_category as t2', 't1.module_id', '=', 't2.module_id')
					->select('t1.checklist_ch_id','t1.checklist_ch_name')
					->where('t2.star_category_id', $starCategoryId)
					->where('t1.module_id',$moduleId)
					->get();
        return $chapter;
	}	
	
	public static function getChapterArea($chapterId,$starCategoryId){
		$query = DB::table('t_checklist_standard_mapping as t1')
					->leftjoin('t_checklist_standard as t2','t1.checklist_id','=','t2.checklist_id')
					->leftjoin('t_checklist_area as t3','t2.checklist_area_id','=','t3.checklist_area_id')
					->select(DB::raw('count(t2.checklist_area_id) as count'),'t2.checklist_area_id','t3.checklist_area','t3.checklist_ch_id')
					->where('t1.star_category_id', $starCategoryId)
					->where('t3.checklist_ch_id',$chapterId)
					->groupBy('t2.checklist_area_id','t3.checklist_area','t3.checklist_ch_id')
					->get();
        return $query;
	}
	public static function getStandards($starCategoryId,$checkListAreaId){
		$query =DB::table('t_checklist_standard as t1')
                    ->leftjoin('t_checklist_standard_mapping as t2','t1.checklist_id','=','t2.checklist_id')
                    ->leftjoin('t_basic_standard as t3','t2.standard_id','=','t3.standard_id')
                    ->select('t3.standard_id','t1.checklist_id','t1.checklist_standard','t1.checklist_pts', 't3.standard_code','t1.checklist_area_id')
					->where('t2.star_category_id', $starCategoryId)
					->where('t1.checklist_area_id',$checkListAreaId)
					->get();
        return  $query;
	}
}
