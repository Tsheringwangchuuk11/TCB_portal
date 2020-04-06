<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TUserRole extends Model
{
    protected $table = 't_user_roles';
    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
