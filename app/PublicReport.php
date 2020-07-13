<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicReport extends Model
{
    public static function getReports($request)
    {


        $query = \DB::select("
            SELECT 
a.MainPurpose, 
SUM(IF(a.Mode_Entry='Air',1,0)) air, 
SUM(IF(a.Mode_Entry='Land',1,0)) land  
FROM t_admin_data a
WHERE a.MainPurpose<>'Paro'
GROUP BY a.MainPurpose;
        ");
        // dd($query);
        return $query;
    }
}
