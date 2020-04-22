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
}
