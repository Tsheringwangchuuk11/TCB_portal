<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class OauthUser extends Authenticatable
{
    use Notifiable;
    protected $guard = 'oauth';
    protected $table = 't_oauth_access_tokens_dtls';
    protected $guarded=['id'];
}
