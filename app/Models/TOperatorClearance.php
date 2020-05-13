<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TOperatorClearance extends Model
{
    protected $table='t_operator_clearances';
    protected $guarded = [];
    public function setDateOfBirthAttribute($value)
    {

        $this->attributes['dob'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function getDateOfBirthAttribute($value)
    {
		return $value ? date('d-m-Y', strtotime($value)) : null;
    }
    
    public function partnerDetails()
    {
        return $this->hasMany(PartnerDetails::class, 'operator_id');
    }
}
