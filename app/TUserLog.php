<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TUserLog extends Model
{
    protected $table = 't_user_logs';
    protected $guarded = ['id'];

    //relationships
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
