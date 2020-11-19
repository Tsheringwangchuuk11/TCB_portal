<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDetails extends Model
{
    protected $table='t_task_dtls';

    public static function getAssignPrivId($serviceId, $orderBy)
    {
       $query=\DB::table('t_system_sub_menus as t1')
                 ->select('id')
                 ->where('service_id',$serviceId)
                 ->where('display_order', $orderBy)
                 ->first();
        return $query;
    }
    public static function getTasklists($priviligeIds, $statusId, $userId, $location_id,$tableName){
        $query = \DB::table('t_task_dtls')
            ->leftJoin('t_workflow_dtls', 't_task_dtls.application_no', '=', 't_workflow_dtls.application_no')
            ->leftJoin($tableName,'t_task_dtls.application_no','=',$tableName.'.application_no')
            ->leftJoin('t_module_masters',$tableName.'.module_id','=','t_module_masters.id')
            ->leftJoin('t_services',$tableName.'.service_id','=','t_services.id')
            ->leftJoin('t_status_masters','t_workflow_dtls.status_id','=','t_status_masters.id');
        if ($location_id != 0){
            $query  ->leftJoin('t_village_masters',$tableName.'.establishment_village_id','=','t_village_masters.id')
                    ->leftJoin('t_gewog_masters','t_village_masters.gewog_id','=','t_gewog_masters.id')
                    ->where('t_gewog_masters.dzongkhag_id', '=', $location_id);
        }
        $query->whereIn('t_task_dtls.assigned_priv_id',$priviligeIds)
            ->where('t_task_dtls.status_id','=',$statusId);
        if ($userId != 0){
            $query->where('t_task_dtls.user_id', '=', $userId);
        }
        $tasklistDtls = $query->orderBy('t_workflow_dtls.created_at','asc')
                                ->select('t_task_dtls.application_no', 't_workflow_dtls.created_at',$tableName.'.module_id','t_module_masters.module_name',$tableName.'.service_id','t_services.name', 't_status_masters.status_name')
                                ->get();     
        return $tasklistDtls;
    }
    public static function savedTaskDtlsAudit($applicationNo){
        $taskDtls = \DB::insert("insert into t_task_dtls_audits (
                                      task_id,
                                      application_no,
                                      user_id,
                                      assigned_priv_id,
                                      status_id,
                                      updated_at,
                                      created_at
                                    ) 
                                    select 
                                      id,
                                      application_no,
                                      user_id,
                                      assigned_priv_id,
                                      status_id,
                                      updated_at,
                                      NOW()  
                                    from
                                      t_task_dtls 
                                    where application_no = ? ", [$applicationNo]);
        return $taskDtls;
    }
}
