<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendLicenseRenewalNotification extends Notification
{
    use Queueable;
     public $email;
     public $name;
     public $validatydate;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email,$name,$validatydate)
    {
        $this->email = $email;
        $this->name = $name;
        $this->validatydate= $validatydate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Renewal Of Registration Certificate')
                ->greeting('Greetings' .$notifiable->name)
                ->line('Your registration certificate  will validet till' .$notifiable->validaty_date .' and expired soon ,Please renew your registration certificate')
                ->action('Click to Renew', url('http://localhost/127.0.0.1'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        
        ];
    }
}
