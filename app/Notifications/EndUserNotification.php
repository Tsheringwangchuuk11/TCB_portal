<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EndUserNotification extends Notification
{
    use Queueable;
    public $app_name;
    protected $application_no;
    protected $service_name;
    public $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $app_name,$application_no,$status_name,$service_name)
    {

        $this->email = $email;
        $this->app_name = $app_name;
        $this->application_no = $application_no;
        $this->status_name = $status_name;
        $this->service_name = $service_name;
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
            ->subject($this->service_name)
            ->greeting('Dear '. $this->app_name)
            ->line('Your application is successfully '.$this->status_name.'. The application is no. '.$this->application_no)
            ->action('Track Your Application', url(config('app.url')));

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
            //
        ];
    }
}
