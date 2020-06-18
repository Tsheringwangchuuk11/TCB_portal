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

    public static function getEndUserApplicationDtls(){
        $applicationDtls = \DB::table('t_workflow_dtls')
                                ->leftJoin('t_applications','t_workflow_dtls.application_no','=','t_applications.application_no')
                                ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id')
                                ->leftJoin('t_module_masters','t_applications.module_id','=','t_module_masters.id')
                                ->leftJoin('t_services','t_applications.service_id','=','t_services.id')
                                ->orderBy('t_workflow_dtls.created_at', 'asc')
                                ->select('t_workflow_dtls.application_no','t_applications.module_id','t_module_masters.module_name','t_applications.service_id','t_services.name','t_workflow_dtls.created_at','t_status_masters.status_name','t_workflow_dtls.updated_at','t_workflow_dtls.remarks')
                                ->get();
        return $applicationDtls;
    }
}
