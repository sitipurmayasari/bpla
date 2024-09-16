<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $ekpor;
    public $message;
    public function __construct($ekpor,$message)
    {
        $this->ekpor = $ekpor;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'request_id' => $this->ekpor->id,
            'request_number' => $this->ekpor->request_number,
            'created_at' => $this->ekpor->created_at,
            'user_id' => $this->ekpor->user_id,
            'company' => $this->ekpor->company->name,
            'message' => $this->message,
        ];
    }
}
