<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TService extends Model
{
    protected $table = 't_services';
    protected $guarded = ['id'];

    //Relationships
    public function systemDivisions()
    {
        return $this->hasMany(TSystemSubMenu::class, 'division_id');
    }
}
