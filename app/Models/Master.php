<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public static function getRoomTypesList(){
        $query=\DB::table('t_room_types as t1')
            ->select('t1.*')
            ->get();
            return $query;
    }
    
}
