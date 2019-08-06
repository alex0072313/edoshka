<?php

namespace App\Notifications;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramOrder extends Notification
{
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    // public function toTelegram($notifiable)
    // {
    //     $url = url('/invoice/' . $this->invoice->id);

    //     return TelegramMessage::create()
    //         ->to($this->user->telegram_user_id) // Optional.
    //         ->content("*HELLO!* \n One of your invoices has been paid!") // Markdown supported.
    //         ->button('View Invoice', $url); // Inline Button
    // }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to('-1001289286904')
            ->content("*HELLO!* \n One of your invoices has been paid!");
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }

}