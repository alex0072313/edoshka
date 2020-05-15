<?php

namespace App\Notifications;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramOrder extends Notification
{
    public function __construct($restaurant, $text = '')
    {
        $this->restaurant = $restaurant;
        $this->chat_id = $this->restaurant->telegram_chat_id;

        $boss_rest_cnt = $this->restaurant->boss()->restaurants()->count();

        if($boss_rest_cnt > 1){
            $text = 'Ресторан: '.$this->restaurant->name."\r\n".$text;
        }

        $this->text = str_replace(['`','*','_'], '-', $text);
    }

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
            ->to($this->chat_id)
            ->content($this->text);
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }

}
