<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{    
    
    protected $fillable = array('eapi_user', 'mobile_number', 'amount', 'date_time', 'transaction_date');

    public function setTransactionDateAttribute($value)
    {
        $this->attributes['transaction_date'] = date('Y-m-d', strtotime($value));
    }

    public function getTransactionDateAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }
}
