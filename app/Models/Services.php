<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Services extends Model
{
	protected $table='t_applications';
	protected $primaryKey = 'application_no';
	public $incrementing=false;
	public $timestamps = false;

	public function setLicenseDateAttribute($value)
    {

        $this->attributes['license_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getLicenseDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}

	public function setDobAttribute($value)
    {

        $this->attributes['dob'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getDobAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}

	public function setDrawingDateAttribute($value)
    {

        $this->attributes['drawing_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getDrawingDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}

	public function setFromDateAttribute($value)
    {

        $this->attributes['from_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getFromDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}

public function setToDateAttribute($value)
    {

        $this->attributes['to_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getToDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}
	public function setValidatyDateAttribute($value)
    {

        $this->attributes['validity_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getValidatyDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}
	
	public static function getServiceLists($request){
		$moduleId=$request->moduleId;
		$query=DB::table("t_module_service_mapping as t1")
				->join('t_services as t2', 't2.id', '=', 't1.service_id')
				->select('t1.page_link', 't2.name')
				->where('t1.module_id', $moduleId)
				->get()
				->pluck("name","page_link");
		return $query;
	}
	public static function getIdInfo($page_link){
		$idInfos=DB::table('t_module_service_mapping as t1')
					->join('t_services as t2', 't2.id', '=', 't1.service_id')
					->join('t_module_masters as t3', 't3.id', '=', 't1.module_id')
					->select('t1.module_id','t1.service_id','t2.name','t3.module_name')
					->where('t1.page_link',$page_link)
					->first();
		return $idInfos;
	}

	//generate application_no
	public function generateApplNo($request)
	{
		$serviceId=$request->service_id;
		$moduleId=$request->module_id;
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

	public static function getTouristHotelDetails($licenseNo){
		 $query=DB::table('t_tourist_standard_dtls as t1')
		->leftjoin('t_star_categories as t2','t2.id','=','t1.star_category_id')
		->leftjoin('t_village_masters as t3','t3.id','=','t1.village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->select('t1.*','t3.village_name','t4.gewog_name','t2.star_category_name','t4.dzongkhag_id')
		->where('t1.license_no',$licenseNo)
		->where('t1.is_active','Y')
		->first(); 
		return $query;
	}
	public static function getTechCleranceDtls($dispatch_no){
		$query=DB::table('t_technical_clearances as t1')
	   ->leftjoin('t_village_masters as t2','t2.id','=','t1.village_id')
	   ->leftjoin('t_gewog_masters as t3','t3.id','=','t2.gewog_id')
	   ->select('t1.*','t2.gewog_id','t2.village_name','t3.gewog_name','t3.dzongkhag_id')
	   ->where('t1.dispatch_no',$dispatch_no)
	   ->first(); 
	   return $query;
   }
	public static function getVillageHomeStayDetails($cidNo){
		$query=DB::table('t_tourist_standard_dtls as t1')
	   ->leftjoin('t_chiwog_masters as t2','t2.id','=','t1.chiwog_id')
	   ->leftjoin('t_village_masters as t3','t3.id','=','t1.village_id')
	   ->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
	   ->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
	   ->select('t1.*','t2.chiwog_name','t3.village_name','t3.gewog_id','t4.gewog_name','t4.dzongkhag_id','t5.dzongkhag_name')
	   ->where('t1.cid_no',$cidNo)
	   ->where('t1.is_active','Y')
	   ->first(); 
	   return $query;
   }
	public function insertDetails($tableName,$data){
		 $flag=DB::table($tableName)->insert($data);	
		 return $flag;
		}

	public function updateDocumentDetails($documentId,$application_no){
		if(isset($documentId)){
			foreach($documentId as $key => $value)
			{
				$data = array(
					'application_no' => $application_no
				);
				DB::table('t_documents')->where('id', $documentId[$key])->update($data);
			}
		}
	}

	public static function getApplicantDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_chiwog_masters as t2','t2.id','=','t1.chiwog_id')
		->leftjoin('t_village_masters as t4','t4.id','=','t1.establishment_village_id')
		->leftjoin('t_gewog_masters as t3','t4.gewog_id','=','t3.id')
		->leftjoin('t_village_masters as t7','t7.id','=','t1.permanent_village_id')
		->leftjoin('t_gewog_masters as t8','t7.gewog_id','=','t8.id')
		->leftjoin('t_dzongkhag_masters as t9','t9.id','=','t8.dzongkhag_id')
		->leftjoin('t_module_masters as t5','t5.id','=','t1.module_id')
		->leftjoin('t_services as t6','t6.id','=','t1.service_id')
		->select('t1.*',
				DB::raw('DATE_FORMAT(t1.dob,"%d/%m/%Y") as dob'), 
				DB::raw('DATE_FORMAT(t1.tentative_cons,"%d/%m/%Y") as tentative_cons'), 
				DB::raw('DATE_FORMAT(t1.tentative_com,"%d/%m/%Y") as tentative_com'), 
				DB::raw('DATE_FORMAT(t1.drawing_date,"%d/%m/%Y") as drawing_date'), 
				DB::raw('DATE_FORMAT(t1.license_date,"%d/%m/%Y") as license_date'), 
				DB::raw('DATE_FORMAT(t1.validity_date,"%d/%m/%Y") as validity_date'), 
				DB::raw('DATE_FORMAT(t1.from_date,"%d/%m/%Y") as from_date'), 
				DB::raw('DATE_FORMAT(t1.from_date,"%d/%m/%Y") as to_date'), 
				't3.dzongkhag_id','t3.gewog_name','t2.chiwog_name','t4.village_name','t4.gewog_id','t5.module_name','t6.name','t8.dzongkhag_id as permanent_dzongkhag_id','t9.dzongkhag_name as permanent_dzongkhag_name',
				't8.gewog_name as permanent_gewog_name','t7.village_name as permanent_village_name')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getTONameOwnerLocationChangeDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_chiwog_masters as t2','t2.id','=','t1.chiwog_id')
		->leftjoin('t_village_masters as t4','t4.id','=','t1.establishment_village_id')
		->leftjoin('t_gewog_masters as t3','t4.gewog_id','=','t3.id')
		->leftjoin('t_village_masters as t7','t7.id','=','t1.new_village_id')
		->leftjoin('t_gewog_masters as t8','t7.gewog_id','=','t8.id')
		->leftjoin('t_module_masters as t5','t5.id','=','t1.module_id')
		->leftjoin('t_services as t6','t6.id','=','t1.service_id')
		->select('t1.*',DB::raw('DATE_FORMAT(t1.license_date,"%d/%m/%Y") as license_date'), 
			't3.dzongkhag_id','t3.gewog_name','t2.chiwog_name','t4.village_name','t4.gewog_id','t5.module_name','t6.name','t8.dzongkhag_id as new_dzongkhag_id',
			't8.gewog_name as new_gewog_name','t7.village_name as new_village_name')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getApplicantDetailsForTravelFairs($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_event_dtls as t2','t2.id','=','t1.event_id')
		->leftjoin('t_village_masters as t3','t3.id','=','t2.village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->select('t1.service_id','t1.module_id','t1.application_no','t1.applicant_name','t1.cid_no','t1.contact_no','t1.email',
			't1.company_title_name','t1.number', 't1.application_type_id','t3.village_name','t4.gewog_name','t4.dzongkhag_id',
			't1.webpage_url','t2.*',
			DB::raw('DATE_FORMAT(t2.last_date,"%d/%m/%Y") as last_date'), 
			DB::raw('DATE_FORMAT(t2.start_date,"%d/%m/%Y") as start_date'),
			DB::raw('DATE_FORMAT(t2.end_date,"%d/%m/%Y") as end_date')
		    )
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getRoomDetails($applicationNo){
		$query=DB::table('t_room_applications as t1')
		->leftjoin('t_applications as t3','t3.application_no','=','t1.application_no')
		->select('t3.application_no','t1.id','t1.room_type_id','t1.room_no')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getMembersDetails($applicationNo){
		$query=DB::table('t_member_applications as t1')
		->leftjoin('t_applications as t3','t3.application_no','=','t1.application_no')
		->leftjoin('t_dropdown_masters as t2','t2.id','=','t1.relation_type_id')
		->select('t1.id','t1.member_name','t1.relation_type_id','t1.member_dob','t1.member_gender')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getStaffDetails($applicationNo){
		$query=DB::table('t_staff_applications as t1')
		->leftjoin('t_applications as t4','t4.application_no','=','t1.application_no')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getDocumentDetails($applicationNo){
		$query=DB::table('t_documents as t1')
		->leftjoin('t_applications as t2','t2.application_no','=','t1.application_no')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;

	}
	public static function getOfficeEquipmentDetails($equipmentType){
		$query=DB::table('t_equipments as t1')
		->select('t1.id','t1.equipment_name','t1.equipment_type')
		->where('t1.equipment_type',$equipmentType)
		->get();
		return $query;
	}

	public static function getTravelEventFairDetails(){
		$sql = \DB::select('
						SELECT a.*,
						b.dropdown_name
						FROM t_event_dtls a
						LEFT JOIN t_dropdown_lists b ON a.id=b.id
						WHERE a.last_date >= CURDATE();
						');
		return $sql;
	} 
	public static function getEventRegisteredDetails($eventId){
		$query=\DB::table('t_event_dtls as t1')
		->leftjoin('t_dropdown_lists as t2','t2.id','=','t1.country_id')
		->leftjoin('t_village_masters as t3','t3.id','=','t1.village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
		->select('t1.*','t2.dropdown_name','t3.village_name','t4.gewog_name','t5.dzongkhag_name')
		->where('t1.id',$eventId)
		->first();
	return $query;
}  
	
	public static function getPartnerInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_partner_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_village_masters as t3','t3.id','=','t2.partner_village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
		->select('t2.id','t2.partner_name','t2.partner_email','t2.partner_cid_no','t2.partner_gender',DB::raw('DATE_FORMAT(t2.partner_dob,"%d/%m/%Y") as partner_dob'), 
		't2.partner_village_id','t3.village_name','t3.gewog_id','t4.gewog_name','t4.dzongkhag_id')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getTourismIndustryPartnerDtls($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_partner_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_event_dtls as t6','t6.id','=','t2.event_id')
		->leftjoin('t_village_masters as t3','t3.id','=','t6.village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
		->leftjoin('t_dropdown_lists as t7','t7.id','=','t6.country_id')
		->select('t2.*','t6.*','t3.village_name','t4.gewog_name','t5.dzongkhag_name','t7.dropdown_name')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}
	public static function getProductInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_product_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_village_masters as t3','t3.id','=','t2.village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
		->leftjoin('t_product_types_master as t6','t6.id','=','t2.product_type_id')
		->select('t2.*',
				DB::raw('DATE_FORMAT(t2.start_date,"%d/%m/%Y") as start_date'), 
				DB::raw('DATE_FORMAT(t2.end_date,"%d/%m/%Y") as end_date'), 
		       't3.village_name','t3.gewog_id','t4.dzongkhag_id','t4.gewog_name','t5.dzongkhag_name','t6.product_name','t6.dropdown_id')
		->where('t2.application_no',$applicationNo)
		->first();
		return $query;
	}
	public static function getChannelInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_channel_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_channel_types as t3','t2.channel_type_id','=','t3.id')
		->select('t2.channel_name','t2.channel_type_id','t2.circulation','t2.target_audience','t3.channel_type')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getChannelCoverageInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_dist_channel_applications as t2','t2.application_no','=','t1.application_no')
		->select('t2.area_coverage','t2.channel_name','t2.channel_link','t2.channel_type_id','t2.intended_date')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getMarketingDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_market_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_country_masters as t3','t3.id','=','t2.country_id')
		->select('t2.country_id','t2.city')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}
	public static function getMarketingActivityDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_activity_applications as t2','t2.application_no','=','t1.application_no')
		->select('t2.activities')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}
	public static function getLastInsertedId($tableName, $data){
		 DB::table($tableName)->insert($data);
		 $id =DB::getPdo()->lastInsertId();
		return $id;
	}
	public static function updateOrSaveDetails($tableName, $data, $id){
		$flag =\DB::table($tableName)->updateOrInsert($id,$data);
		return $flag;
	}
	public static function saveTouristStandardHotelDtlsAudit($license_no){
        $status = DB::insert('INSERT INTO t_tourist_standard_dtls_audit(
			tourist_standard_id,
			module_id,
			cid_no,
			owner_name,
			license_no,
			license_date,
			tourist_standard_name,
			contact_no,
			email,
			address,
			fax,
			webpage_url,
			bed_no,
			thram_no,
			house_no,
			town_distance,
			road_distance,
			`condition`,
			village_id,
			chiwog_id,
			star_category_id,
			inspection_date,
			validaty_date,
			updated_at,
			created_at,
			is_active
			)
			SELECT 
			id,
			module_id,
			cid_no,
			owner_name,
			license_no,
			license_date,
			tourist_standard_name,
			contact_no,
			email,
			address,
			fax,
			webpage_url,
			bed_no,
			thram_no,
			house_no,
			town_distance,
			road_distance,
			`condition`,
			village_id,
			chiwog_id,
			star_category_id,
			inspection_date,
			validaty_date,
			updated_at,
			NOW(),
			is_active
			FROM t_tourist_standard_dtls
			WHERE license_no = ? ', [$license_no]);
        return $status;
	}



	public static function saveHomeStayDtlsAudit($cid_no){
		$status = DB::insert('INSERT INTO t_tourist_standard_dtls_audit(
			tourist_standard_id,
			module_id,
			cid_no,
			owner_name,
			license_no,
			license_date,
			tourist_standard_name,
			contact_no,
			email,
			address,
			fax,
			webpage_url,
			bed_no,
			thram_no,
			house_no,
			town_distance,
			road_distance,
			`condition`,
			village_id,
			chiwog_id,
			star_category_id,
			inspection_date,
			validaty_date,
			updated_at,
			created_at,
			is_active
			)
			SELECT 
			id,
			module_id,
			cid_no,
			owner_name,
			license_no,
			license_date,
			tourist_standard_name,
			contact_no,
			email,
			address,
			fax,
			webpage_url,
			bed_no,
			thram_no,
			house_no,
			town_distance,
			road_distance,
			`condition`,
			village_id,
			chiwog_id,
			star_category_id,
			inspection_date,
			validaty_date,
			updated_at,
			NOW(),
			is_active
			FROM t_tourist_standard_dtls
			WHERE cid_no = ? ', [$cid_no]);
        return $status;
	}

	public static function saveWorkPermitDtlsAudit($dispatch_no){
		$status = DB::insert('INSERT INTO t_work_permit_dtls_audit(
			work_permit_id,
			application_type_id,
			license_no,
			company_name,
			cid_no,
			email,
			total_worker,
			country_id,
			from_date,
			village_id,
			to_date,
			dispatch_no,
			created_at,
			updated_at
			)
			SELECT 
			id,
			application_type_id,
			license_no,
			company_name,
			cid_no,
			email,
			total_worker,
			country_id,
			from_date,
			village_id,
			to_date,
			dispatch_no,
			NOW(),
			updated_at
			FROM t_work_permit_dtls
			WHERE dispatch_no = ? ', [$dispatch_no]);
        return $status;
	}

	public static function saveForeignWorkerDtlsAudit($passport_no){
		$status = DB::insert('INSERT INTO t_foreign_worker_dtls_audit(
				foreign_worker_id,
				work_permit_id,
				passport_no,
				name,
				start_date,
				end_date,
				nationality,
				created_at,
				updated_at
				)
				SELECT 
				id,
				work_permit_id,
				passport_no,
				name,
				start_date,
				end_date,
				nationality,
				now(),
				updated_at
				FROM t_foreign_worker_dtls
				WHERE passport_no = ? ', [$passport_no]);
        return $status;
	}
	public static function saveTechnicalClearanceDtlsAudit($dispatch_no){
        $status = DB::insert('INSERT INTO t_technical_clearances_audit(
			clearance_id,
			dispatch_no,
			application_no,
			purpose_id,
			cid_no,
			name,
			contact_no,
			village_id,
			accomodation_type_id,
			proposed_rooms_no,
			tentative_cons,
			tentative_com,
			drawing_date,
			validaty_date,
			email,
			submitted_by,
			created_at,
			updated_at
			)
			SELECT 
			id,
			dispatch_no,
			application_no,
			purpose_id,
			cid_no,
			name,
			contact_no,
			village_id,
			accomodation_type_id,
			proposed_rooms_no,
			tentative_cons,
			tentative_com,
			drawing_date,
			validaty_date,
			email,
			submitted_by,
			NOW(),
			updated_at
			FROM t_technical_clearances
			WHERE dispatch_no = ? ', [$dispatch_no]);
        return $status;
	}
	
	public static function updateApplicantDtls($tableName,$fielddName,$para,$data){
		$status=DB::table($tableName)
              ->where($fielddName,$para)
			  ->update($data);
		return $status;
	}
	public static function saveTourOperatorDtlsAudit($license_no){
        $status = DB::insert('INSERT INTO t_operator_dtls_audit(
			operator_dtls_id,
			cid_no,
			name,
			contact_no,
			email,
			license_no,
			license_date,
			company_name,
			location,
			address,
			letter_sample,
			updated_at,
			created_at,
			is_active
			)
			SELECT 
			id,
			cid_no,
			name,
			contact_no,
			email,
			license_no,
			license_date,
			company_name,
			location,
			address,
			letter_sample,
			updated_at,
			NOW(),
			is_active
			FROM t_operator_dtls
			WHERE license_no = ? ', [$license_no]);
        return $status;
	}

	public static function saveTourOperatorClearancesDtlsAudit($license_no){
        $status = DB::insert('INSERT INTO t_operator_clearances_audit(
			operator_clearance_id,
			application_type_id,
			cid_no,
			NAME,
			gender,
			dob,
			email,
			license_no,
			applicant_flat_no,
			applicant_building_no,
			applicant_location,
			company_name,
			company_name_one,
			company_name_two,
			village_id,
			location,
			flat_no,
			building_no,
			postal_address,
			contact_no,
			reference_no,
			remarks,
			validity_date,
			created_at,
			updated_at
			)
			SELECT 
			id,
			application_type_id,
			cid_no,
			NAME,
			gender,
			dob,
			email,
			license_no,
			applicant_flat_no,
			applicant_building_no,
			applicant_location,
			company_name,
			company_name_one,
			company_name_two,
			village_id,
			location,
			flat_no,
			building_no,
			postal_address,
			contact_no,
			reference_no,
			remarks,
			validity_date,
			created_at,
			NOW(),
			FROM t_operator_clearances
			WHERE license_no = ? ', [$license_no]);
        return $status;
	}

	public static function getGrievanceRedressalList(){
		$query=DB::table('t_grievance_applications as t1')
		->select('t1.application_no','t1.complainant_name','t1.complainant_mobile_no','t1.date')
		->paginate(10);
		return $query;
	}

	public static function getGrievanceDetails($applicationNo){
		$query=DB::table('t_grievance_applications as t1')
		->leftjoin('t_workflow_dtls as t2','t2.application_no','=','t1.application_no')
		->select('t1.*',\DB::raw('DATE_FORMAT(t2.created_at,"%Y-%m-%d") as created_at'),'t2.remarks')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getGrievanceDocumentDetails($applicationNo){
		$query=DB::table('t_documents as t1')
		->leftjoin('t_grievance_applications as t2','t2.application_no','=','t1.application_no')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;

	}
	public static function checkCompanyNameExists($companyName){
        $query=\DB::table('t_operator_clearances as t1')
                    ->where('t1.company_name',$companyName)
                    ->exists();
        return  $query;
	}
	
	public static function getTotalApprovedApplication(){
		$query=\DB::table('t_workflow_dtls as t1')
		->leftjoin('t_task_dtls as t2','t2.application_no','=','t1.application_no')
		->select(DB::raw('COUNT(t1.application_no) as totalcount'))
		->where('t1.status_id','3')
		->where('t2.status_id','7')
        ->get();		
        return  $query;
	}
	public static function getTotalRejectApplication(){
		$query=\DB::table('t_workflow_dtls as t1')
		->select(DB::raw('COUNT(t1.application_no) as totalreject'))
		->where('t1.status_id','4')
		->get();
		return  $query;
	}

	public static function getApplicationSummaryData($roles){
	$query=\DB::select("
				SELECT
				t1.totalapproved, 
				t1.totalrejected ,
				(t1.totalapproved + t1.totalrejected ) totalapplication
				FROM 
				(SELECT(SELECT
				COUNT(a.application_no)
				FROM t_workflow_dtls a
				LEFT JOIN t_task_dtls b ON a.application_no=b.application_no
				LEFT JOIN t_role_privileges c ON b.assigned_priv_id=c.system_sub_menu_id
				WHERE a.status_id='3' AND b.status_id='7' AND c.role_id='".$roles."') AS totalapproved,
				(SELECT
				COUNT(a.application_no)
				FROM t_workflow_dtls a
				LEFT JOIN t_task_dtls b ON a.application_no=b.application_no
				LEFT JOIN t_role_privileges c ON b.assigned_priv_id=c.system_sub_menu_id
				WHERE a.status_id='4' AND c.role_id='') AS totalrejected ) t1;
		 ");
	return $query;	
	}
	public static function 	getAppListForRecoomendationLetter(){
		$query=\DB::select("
			SELECT
			a.application_no,
			e.name,
			f.module_name,
			a.cid_no,
			a.company_title_name,
			a.owner_name,
			d.status_name
			FROM t_applications a
			LEFT JOIN t_workflow_dtls b ON a.application_no=b.application_no
			LEFT JOIN t_task_dtls c ON a.application_no=c.application_no
			LEFT JOIN t_status_masters d ON b.status_id=d.id
			LEFT JOIN t_services e ON a.service_id=e.id
			LEFT JOIN t_module_masters f ON a.module_id=f.id
			WHERE a.service_id='12' AND
			b.status_id='3' AND c.status_id='7';
			");
		return $query;	
		}


		public static function 	printRecoomendationLetter($applicationNo){
			$query=DB::table('t_applications as a')
			->leftjoin('t_workflow_dtls as b','b.application_no','=','a.application_no')
			->leftjoin('t_task_dtls as c','c.application_no','=','a.application_no')
			->leftjoin('t_status_masters as d','d.id','=','b.status_id')
			->leftjoin('t_services as e','e.id','=','a.service_id')
			->leftjoin('t_module_masters as f','f.id','=','a.module_id')
			->select('a.application_no','e.name','f.module_name','a.cid_no','a.company_title_name','a.owner_name','d.status_name','a.letter_type_id','a.license_date')
			->where('a.application_no',$applicationNo)
			->where('a.service_id','12')
			->where('b.status_id','3')
			->where('c.status_id','7')
			->first();
			return $query;
			}

		public static function checkDispatchNumber($tableName,$fielddName,$para){
			$status=\DB::table($tableName)
			  ->where($fielddName,$para)
			  ->exists();
	 	    return $status;
		}
		public static function getWorkPermitDtls($dispatch_no){
			$query=\DB::table('t_work_permit_dtls as t1')
			       ->leftjoin('t_village_masters as t2','t2.id','=','t1.village_id')
		           ->leftjoin('t_gewog_masters as t3','t3.id','=','t2.gewog_id')
		           ->leftjoin('t_dzongkhag_masters as t4','t4.id','=','t3.dzongkhag_id')
				   ->select('t1.license_no','t1.company_name','t1.cid_no','t1.email','t1.total_worker','t1.country_id','t1.from_date','t1.village_id',
				   't1.to_date','t2.gewog_id','t3.dzongkhag_id')
				   ->where('t1.dispatch_no',$dispatch_no)
				   ->first();
			return $query;
		}
		
		public static function getIndividaulForeignWorkerDtls($passport_no){
			$query=\DB::table('t_foreign_worker_dtls as t1')
				   ->select('t1.*')
				   ->where('t1.passport_no',$passport_no)
				   ->first();
			return $query;
		}
		public static function deleteDataRecord($recordId,$tablename){
		 $query=\DB::table($tablename)
					->where('id',$recordId)
					->delete();
		 return $query;
		}

		public static function getCheckedRecord($applicationNo){
			$query=\DB::table('t_checklist_applications as t1')
						->select('t1.id','t1.checklist_id','t1.assessor_score_point','t1.assessor_rating')
						->where('application_no',$applicationNo)
						->get();
           return $query;
		}

		public static function getDivisonCode($serviceId){
			$query=\DB::table('t_services as a')
			->leftjoin('t_divisions as b','b.id','=','a.division_id')
			->select('b.code')
			->where('a.id',$serviceId)
			->first();
           return $query;
		}

		public static function getForeignWorkerDtls($applicationNo){
			$query=\DB::table('t_foreign_worker_applications as a')
			->select('a.*')
			->get();
           return $query;
		}

		public static function getHotelTechnicalClearanceLetterContent($application_no,$service_id,$module_id){
			$query=\DB::table('t_applications as a')
					->leftjoin('t_workflow_dtls as b','b.application_no','=','a.application_no')
					->leftjoin('t_technical_clearances as c','c.application_no','=' ,'a.application_no')
					->leftjoin('t_dropdown_lists as d','d.id','=', 'c.accomodation_type_id')
					->leftjoin('t_letter_masters as e','e.service_id','=','a.service_id')
					->leftjoin('t_village_masters as f' ,'f.id' ,'=','c.village_id')
					->leftjoin('t_gewog_masters as g','g.id', '=','f.gewog_id')
					->leftjoin('t_dzongkhag_masters as h','h.id','=','g.dzongkhag_id')
					->leftjoin('t_technical_clearances_audit as j','j.clearance_id','=','c.id')
					->select('a.application_no','c.dispatch_no','c.name','c.cid_no','c.proposed_rooms_no','d.dropdown_name','e.*','c.purpose_id',DB::raw('DATE_FORMAT(b.created_at,"%d/%m/%Y") as submit_date'),'j.name as old_owner',
					'f.village_name','g.gewog_name','h.dzongkhag_name',DB::raw('DATE_FORMAT(c.validaty_date,"%d/%m/%Y") as validaty_date'))
					->where('b.status_id','3')
					->where('a.application_no',$application_no)
					->where('e.service_id',$service_id)
					->where('e.module_id',$module_id)
					->first();
			return $query;	
		}

		public static function getOperatorLicenseClearanceLetterContent($application_no,$service_id,$module_id){
			$query=\DB::table('t_applications as a')
					->leftjoin('t_workflow_dtls as b','b.application_no','=','a.application_no')
					->leftjoin('t_operator_clearances as c','c.application_type_id','=' ,'a.application_type_id')
					->leftjoin('t_letter_masters as d','d.application_type_id','=','c.application_type_id')
					->leftjoin('t_village_masters as e' ,'e.id' ,'=','c.village_id')
					->leftjoin('t_gewog_masters as f','f.id', '=','e.gewog_id')
					->leftjoin('t_dzongkhag_masters as g','g.id','=','f.dzongkhag_id')
					->select('a.application_no','c.name','c.cid_no','c.email','c.license_no','c.contact_no','d.*',
					'e.village_name','f.gewog_name','g.dzongkhag_name',DB::raw('DATE_FORMAT(c.validity_date,"%d/%m/%Y") as validaty_date'))
					->where('b.status_id','3')
					->where('a.application_no',$application_no)
					->where('d.service_id',$service_id)
					->where('d.module_id',$module_id)
					->first();
			return $query;	
		}

		public static function getcertificationContent($application_no,$service_id,$module_id){
			$query=\DB::table('t_applications as a')
						->leftjoin('t_workflow_dtls as b','b.application_no','=','a.application_no')
						->leftjoin('t_tourist_standard_dtls as c','c.module_id','=' ,'a.module_id')
						->leftjoin('t_village_masters as d','d.id','=', 'c.village_id')
						->leftjoin('t_gewog_masters as e','e.id','=','d.gewog_id')
						->leftjoin('t_dzongkhag_masters as f' ,'f.id' ,'=','e.dzongkhag_id')
						->select('c.star_category_id','c.tourist_standard_name','c.cid_no','c.owner_name','d.village_name','e.gewog_name','f.dzongkhag_name',DB::raw('DATE_FORMAT(c.validaty_date,"%D %M,%Y") as validaty_date'))
						->where('b.status_id','3')
						->where('a.application_no',$application_no)
						->where('a.service_id',$service_id)
						->where('a.module_id',$module_id)
						->first();
			return $query;
		}

		public static function getChapterId($application_no,$moduleId, $starCategoryId){
			$sql = \DB::table('t_checklist_applications as a')
						->leftJoin('t_check_list_standards as b','b.id','=','a.checklist_id')
						->leftJoin('t_check_list_areas as c','c.id','=','b.checklist_area_id')
						->leftJoin('t_check_list_chapters as d','d.id','=','c.checklist_ch_id')
						->leftJoin('t_check_list_standard_mappings as e','e.checklist_id','=','b.id')
						->select(\DB::raw('DISTINCT(c.checklist_ch_id) as chapterId'))
						->where('a.application_no',$application_no)
						->where('d.module_id',$moduleId)
						->where('e.star_category_id',$starCategoryId)
						->pluck('chapterId');
			return $sql;
		}

		public static function getTentedAccomChapterId($application_no,$moduleId){
			$sql = \DB::table('t_checklist_applications as a')
						->leftJoin('t_check_list_standards as b','b.id','=','a.checklist_id')
						->leftJoin('t_check_list_areas as c','c.id','=','b.checklist_area_id')
						->leftJoin('t_check_list_chapters as d','d.id','=','c.checklist_ch_id')
						->leftJoin('t_check_list_standard_mappings as e','e.checklist_id','=','b.id')
						->select(\DB::raw('DISTINCT(c.checklist_ch_id) as chapterId'))
						->where('a.application_no',$application_no)
						->where('d.module_id',$moduleId)
						->pluck('chapterId');
			return $sql;
		}
}
