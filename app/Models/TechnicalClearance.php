<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalClearance extends Model
{
    protected $table='t_technical_clearances';
    protected $fillable = ['cid_no','name','contact_no','gewog_id','location','proposed_rooms_no','tentative_cons','tentative_com','drawing_date','email','submitted_by'];
    public function setDrawingDateAttribute($value)
    {

        $this->attributes['drawing_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getDrawingDateAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
	}
}
