<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDetails extends Model
{
    protected $table='t_task_dtls';
    
    public static function getAssignPrivId($serviceId)
    {
       $query=\DB::table('t_system_sub_menus as t1')
                 ->select('id')
                 ->where('service_id',$serviceId)
                 ->get();
        return $query;
    }
}
