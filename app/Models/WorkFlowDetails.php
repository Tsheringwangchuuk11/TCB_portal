<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkFlowDetails extends Model
{
    protected $table='t_workflow_dtls';

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
}
