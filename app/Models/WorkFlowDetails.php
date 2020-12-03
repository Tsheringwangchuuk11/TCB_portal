<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkFlowDetails extends Model
{
    protected $table='t_workflow_dtls';
    protected $guarded = [];

    public function getUpdatedAtAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
	}
	
    public static function getStatus($status_name)
    {
       $query=\DB::table('t_status_masters as t1')
                 ->select('id')
                 ->where('status_name',$status_name)
                 ->first();
        return $query;
    }

    public static function getAssignedRoleForApp($serviceId)
    {
       $query=\DB::table('t_role_privileges as t1')
                 ->leftJoin('t_system_sub_menus as t2','t2.id','=','t1.system_sub_menu_id')
                 ->select('t1.role_id')
                 ->where('t2.service_id',$serviceId)
                 ->first();
        return $query;
    }
    public static function saveWorkFlowDtlsAudit($applicationNo){
        $status = \DB::insert('INSERT INTO t_workflow_dtls_audits (
                                  workflow_dtls_id,
                                  application_no,
                                  status_id,
                                  user_id,
                                  role_id,
                                  remarks,
                                  updated_at,
                                  created_at
                                ) 
                                SELECT 
                                  id,
                                  application_no,
                                  status_id,
                                  user_id,
                                  role_id,
                                  remarks,
                                  updated_at,
                                  NOW() 
                                FROM
                                  t_workflow_dtls 
                                WHERE application_no = ? ', [$applicationNo]);
        return $status;
    }

    public static function getEndUserApplicationDtls($userId){
			  $applicationDtls=\DB::SELECT('SELECT a.application_no,
			  a.module_id,
			  a.service_id,
			  d.module_name,
			  e.name,
			  c.id,
			  c.status_name,
			  DATE_FORMAT(b.created_at,"%d/%m/%Y") AS created_at,
			  DATE_FORMAT(b.updated_at,"%d/%m/%Y") AS updated_at,
        IF(DATE_ADD(DATE_FORMAT(b.updated_at,"%Y-%m-%d"),INTERVAL 1 MONTH) > CURRENT_DATE,"1","0") AS print_validity,
			  b.remarks
			  FROM 
			  (SELECT application_no,module_id,service_id FROM t_applications
			  UNION
			  SELECT application_no,module_id,service_id  FROM t_grievance_applications)a
			  LEFT JOIN t_workflow_dtls b ON a.application_no=b.application_no
			  LEFT JOIN t_status_masters c ON b.status_id=c.id
			  LEFT JOIN t_module_masters d ON a.module_id=d.id
			  LEFT JOIN t_services e ON a.service_id=e.id
			  WHERE b.user_id="'.$userId.'"
			  ORDER BY b.created_at
			  ');
        return $applicationDtls;
    }
}
