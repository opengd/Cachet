<?php

namespace CachetHQ\Cachet\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SMSChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! ($to = $notifiable->routeNotificationFor('sms'))) {
            return;
        }

        $message = $notification->toSMS($notifiable);
   
        $request = \Illuminate\Http\Request::create(config('sms.url'), 
            'GET', [
                    'username' => config('sms.username'), 
                    'password' => config('sms.password'), 
                    'from' => config('sms.from'), 
                    'to'=> $to, 
                    'text' => $message->content
                ]);
        

        //Log::error($this->email . ":sendCreateIncidentSMSDirect: " . $incident->name);

        Log::error($to . ":Send SMS:" . $message->content . "#####" . serialize($request));
    }
}