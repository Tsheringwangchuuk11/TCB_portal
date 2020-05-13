<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerDetails extends Model
{
    protected $table='t_partner_dtls';

    public function setPartnerDobAttribute($value)
    {
        
        $this->attributes['partner_dob'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getPartnerDobAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
    }

}
