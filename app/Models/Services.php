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
		->leftjoin('t_locations as t3','t3.id','=','t1.village_id')
		->where('t1.license_no',$licenseNo)
		->where('t1.is_active','Y')
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

	public static function getTourOperatorDetails($licenseNo){
		 $query=DB::table('t_operator_dtls as t1')
		->where('t1.license_no',$licenseNo)
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
		->leftjoin('t_gewog_masters as t3','t1.gewog_id','=','t3.id')
		->leftjoin('t_chiwog_masters as t2','t2.id','=','t1.chiwog_id')
		->leftjoin('t_village_masters as t4','t4.id','=','t1.village_id')
		->select('t1.*','t3.dzongkhag_id','t3.gewog_name','t2.chiwog_name','t4.village_name')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getApplicantDetailsForTravelFairs($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_event_dtls as t2','t2.id','=','t1.event_id')
		->select('t1.service_id','t1.module_id','t1.application_no','t1.applicant_name','t1.cid_no','t1.contact_no','t1.email','t1.company_title_name','t1.date','t2.*')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getRoomDetails($applicationNo){
		$query=DB::table('t_room_applications as t1')
		->leftjoin('t_applications as t3','t3.application_no','=','t1.application_no')
		->leftjoin('t_room_types as t2','t2.id','=','t1.room_type_id')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getMembersDetails($applicationNo){
		$query=DB::table('t_member_applications as t1')
		->leftjoin('t_applications as t3','t3.application_no','=','t1.application_no')
		->leftjoin('t_relation_types as t2','t2.id','=','t1.relation_type_id')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getStaffDetails($applicationNo){
		$query=DB::table('t_staff_applications as t1')
		->leftjoin('t_applications as t4','t4.application_no','=','t1.application_no')
		->leftjoin('t_staff_areas as t2','t2.id','=','t1.staff_area_id')
		->leftjoin('t_hotel_divisions as t3','t3.id','=','t1.hotel_div_id')
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
		SELECT a.id,a.event_name FROM t_event_dtls a WHERE a.last_date >= CURDATE();');
		return $sql;
	}  
	
	public static function getPartnerInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_partner_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_village_masters as t3','t3.id','=','t2.partner_village_id')
		->leftjoin('t_gewog_masters as t4','t4.id','=','t3.gewog_id')
		->leftjoin('t_dzongkhag_masters as t5','t5.id','=','t4.dzongkhag_id')
		->select('t2.partner_name','t2.partner_cid_no','t2.partner_gender','t2.partner_dob','t2.partner_flat_no',
		't2.partner_building_no','t2.partner_location','t2.partner_village_id','t3.village_name','t3.gewog_id','t4.gewog_name','t4.dzongkhag_id')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}

	public static function getProductInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_product_applications as t2','t2.application_no','=','t1.application_no')
		->select('t2.type','t2.location','t2.objective','t2.product_des','t2.project_cost',
		't2.timeline','t2.contribution')
		->where('t1.application_no',$applicationNo)
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
	
	public static function getOrganizerInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_organizer_applications as t2','t2.application_no','=','t1.application_no')
		->select('t2.id','t2.organizer_name','t2.organizer_address','t2.organizer_phone','t2.organizer_email','t2.organizer_type','t2.amount_requested')
		->where('t1.application_no',$applicationNo)
		->first();
		return $query;
	}
	public static function getItemInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_item_applications as t2','t2.application_no','=','t1.application_no')
		->select('t2.id','t2.items_name','t2.item_costs')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getOfficeInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_office_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_offices as t3','t2.office_id','=','t3.id')
		->select('t2.id','t2.office_id','t2.office_status','t3.office_name')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}
	public static function 	getOfficeEquipmentInfoDetails($applicationNo,$equipmentType){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_equipment_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_equipments as t3','t2.equipment_id','=','t3.id')
		->select('t2.id','t2.equipment_id','t2.equipment_status','t3.equipment_type','t3.equipment_name')
		->where('t1.application_no',$applicationNo)
		->where('t3.equipment_type',$equipmentType)
		->get();
		return $query;
	}

	public static function getEmploymentInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_employment_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_employments as t3','t2.employment_id','=','t3.id')
		->select('t2.id','t2.employment_id','t2.employment_status','t2.nationality','t3.employment_name')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getTransportationInfoDetails($applicationNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_transport_applications as t2','t2.application_no','=','t1.application_no')
		->leftjoin('t_vehicles as t3','t2.vehicle_id','=','t3.id')
		->select('t2.id','t2.vehicle_id','t2.transport_status','t2.fitness','t3.vehicle_name')
		->where('t1.application_no',$applicationNo)
		->get();
		return $query;
	}

	public static function getLastInsertedId($tableName, $data){
		 DB::table($tableName)->insert($data);
		 $id =DB::getPdo()->lastInsertId();
		return $id;
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
	
	public static function updateApplicantDtls($tableName,$filedName,$para,$data){
		$status=DB::table($tableName)
              ->where($filedName, $para)
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

	public static function getGrievanceRedressalList(){
		$query=DB::table('t_grievance_applications as t1')
		->select('t1.application_no','t1.complainant_name','t1.complainant_mobile_no','t1.date')
		->paginate(10);
		return $query;
	}

	public static function getGrievanceDetails($applicationNo){
		$query=DB::table('t_grievance_applications as t1')
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
				WHERE a.status_id='4' AND c.role_id='".$roles."') AS totalrejected ) t1;
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
}
