<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\sendLicenseRenewalNotification;
use App\Models\TouristStandardHotel;
class LicenseRenewalNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renew:licenseRenew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'license renew notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(TouristStandardHotel $standardhotel)
    {
        
        $users=\DB::table('t_tourist_standard_dtls as t1')
             ->select('t1.email','t1.owner_name','t1.validaty_date')
             ->whereRaw('t1.validaty_date = DATE_ADD(CURDATE(), INTERVAL 1 MONTH)')
             ->get();
             if($users!=null){
                 foreach ($users as $user) {
                    $email=$user->email;
                    $name=$user->owner_name;
                    $validatydate=$user->validaty_date;
                    $standardhotel->sendLicenseRenewalNotificationToEndUsers($email,$name,$validatydate);
                    $this->info('Email Send sucessfully');
                }
             }
    }
}
