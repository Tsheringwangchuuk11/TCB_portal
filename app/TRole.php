<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TRole extends Model
{
    protected $table = 't_roles';
    protected $guarded = ['id'];

    /** Relations */
    public function users()
    {
        return $this->belongsToMany(User::class, 't_user_roles', 'role_id', 'user_id')->withPivot('created_by', 'updated_by')->withTimestamps();
    }

    public function rolePermissions()
    {
        return $this->hasMany(TRolePermission::class);
    }
}
