<?php

namespace App\Notifications;

use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;
use Illuminate\Notifications\Notification;

class SmsOrder extends Notification{

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->from('+79282561605')
            ->content($this->text);
    }

    public function routeNotificationForTwilio()
    {
        return '+79282561605';
    }
}
