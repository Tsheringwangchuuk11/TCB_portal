<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\sendLicenseRenewalNotification;

class TouristStandardHotel extends Model
{
    use Notifiable;
    protected $table='t_tourist_standard_dtls';

    public function routeNotificationForMail($notification)
    {
        return $notification->email;
    }

    public function sendLicenseRenewalNotificationToEndUsers($email,$name,$validatydate)
    {
        $when = Carbon::now()->addMinutes(1);
        $this->notify((new sendLicenseRenewalNotification($email,$name,$validatydate))->delay($when));
    }
}
