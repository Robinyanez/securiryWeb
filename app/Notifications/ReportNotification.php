<?php

namespace App\Notifications;

use App\Models\Time;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Auth;

class ReportNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Time $time)
    {
        $this->time = $time;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'date'      => $this->time->date->diffForHumans(),
            'time'      => $this->time->time->diffForHumans(),
            'date_time' => $this->time->date_time->diffForHumans(),
            'type'      => $this->time->type,
            'lat'       => $this->time->lat,
            'lng'       => $this->time->lng,
            'user_name'   => Auth::user()->name,
        ];
    }
}
