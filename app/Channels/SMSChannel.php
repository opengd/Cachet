<?php

namespace CachetHQ\Cachet\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

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

        $client = new Client();
        $res = $client->request('GET', config('sms.url'), [
        'query' => [
                'username' => config('sms.username'),
                'password' => config('sms.password'),
                'from' => config('sms.from'),
                'to'=> $to,
                'text' => $message->content
        ]
        ]);

        Log::info($to . ":Send SMS:" . $message->content . ":Response:" . serialize($res));
    }
}