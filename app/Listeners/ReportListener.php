<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
/* use Illuminate\Support\Facades\Notification; */
use App\Notifications\ReportNotification;
use App\Models\User;

class ReportListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::findOrFail(1);
        $user->notify(new ReportNotification($event->time));
        /* Notification::send($user, new ReportNotification($event->time)); */
    }
}
