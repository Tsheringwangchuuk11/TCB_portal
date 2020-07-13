<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 't_event_dtls';
    protected $guarded=['id'];
   /*  public function setStartDateAttribute($value)
    {

        $this->attributes['start_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getStartDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
    }
    
    public function setEndDateAttribute($value)
    {

        $this->attributes['end_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function geEndDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
    }
    public function setLastDateAttribute($value)
    {

        $this->attributes['last_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getLastDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
  } */
  
  public static function getEventDetails(){
    $query=\DB::table('t_event_dtls as t1')
          ->leftjoin('t_country_masters as t2','t2.id','=','t1.country_id')
          ->select('t1.*','t2.country_name')
          ->get();
		return $query;
  }
}
