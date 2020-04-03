<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 't_users';
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['last_login'];

    const IS_ACTIVE = 1;

    //Relationships
    public function roles()
    {
        return $this->belongsToMany(TRole::class, 't_user_roles', 'user_id', 'role_id');
    }

    public function userLogs()
    {
        return $this->hasMany(TUserLog::class, 'user_id');
    }

    public function isActive()
    {
        return $this->is_active == self::IS_ACTIVE;
    }

    //Notifications
    public function sendPasswordResetNotification($token)
    {
        $when = Carbon::now()->addMinutes(2);
        $this->notify((new SendPasswordResetLink($token))->delay($when));
    }

    //new user link for verifications
    public function sendNewUserCredentialNotification($password)
    {
        $when = Carbon::now()->addMinutes(1);
        $this->notify((new SendLoginDetail($password))->delay($when));
    }

    //Attributes
    public function getLastLoginAttribute($value)
    {
        return $value ? date('d-m-Y | H : i', strtotime($value)) : null;
    }

    //Scopes and filters
    public function scopeFilter($query, $request)
    {
        if ($request->has('email') && $request->query('email') != '') {
            $query->where('email', 'LIKE', $request->query('email') . '%');
        }

        if ($request->has('name') && $request->query('name') != '') {
            $query->where('name', 'LIKE', $request->query('name') . '%');
        }
    }
}
