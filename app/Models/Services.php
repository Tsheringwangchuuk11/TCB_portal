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

	public static function getOwnerShipDetails($licenseNo){
		$query=DB::table('t_applications as t1')
		->leftjoin('t_star_categories as t2','t2.id','=','t1.star_category_id')
		->where('t1.license_no',$licenseNo)
		->first();
		return $query;
	}
	
	public function insertIntoRoomApplication($roomAppData){
		
		DB::table('t_room_applications')->insert($roomAppData);
	}

	public function insertIntoStaffApplication($staffAppData){

		DB::table('t_staff_applications')->insert($staffAppData);		
	}
	
	public function insertIntoCheckListApplication($membersDetailsData){

		DB::table('t_checklist_applications')->insert($membersDetailsData);		
	}

	public function insertMemberApplication($checklistData){

		DB::table('t_member_applications')->insert($checklistData);		
	}

    public function insertPartnerApplication($partnerDetailsData){

		DB::table('t_partner_applications')->insert($partnerDetailsData);		
	}
	 
	public function insertCompanyInfo($companyInfoDetailsData){

		DB::table('t_company_infomations')->insert($companyInfoDetailsData);		

	}
	 public function insertOfficeApplication($officeInfoData){

		DB::table('t_office_applications')->insert($officeInfoData);		

	 }

	 public function insertOfficeEquipmentApplication($officeEquipmentData){

		DB::table('t_equipment_applications')->insert($officeEquipmentData);		

	 }

	 public function insertEmploymentApplication($employmentData){

		DB::table('t_employment_applications')->insert($employmentData);		

	 }

	 public function insertTransportationApplication($transportationData){

		DB::table('t_transport_applications')->insert($transportationData);		

	 }
	 public function insertOrganizerInfo($organizerInfoData){

		DB::table('t_organizer_applications')->insert($organizerInfoData);		

	 }
	 public function insertEventItemsApplication($eventItemData){

		DB::table('t_item_applications')->insert($eventItemData);		

	 }

	 public function insertProductItemsApplication($productItemData){

		DB::table('t_product_applications')->insert($productItemData);		

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
		->leftjoin('t_star_categories as t2','t2.id','=','t1.star_category_id')
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

	public static function getOfficeInfoDetails(){
		$query=DB::table('t_offices as t1')
		->select('t1.id','t1.office_name')
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
	public static function getEmploymentDetails(){
		$query=DB::table('t_employments as t1')
		->select('t1.id','t1.employment_name')
		->get();
		return $query;
	}

	public static function getTransportationDetails(){
		$query=DB::table('t_vehicles as t1')
		->select('t1.id','t1.vehicle_name')
		->get();
		return $query;
	}
}
