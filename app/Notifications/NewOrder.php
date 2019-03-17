<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
        $this->total_price = 0;

        foreach ($this->order->dishes as $dish){
            $this->total_price += $dish->pivot->total_price;
        }
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
        $mail = new MailMessage();

        $mail->subject('Новый заказ (ID: '.$this->order->id.') на сумму '.$this->total_price.' руб.');
        $mail->greeting('Ув. '.$this->user->name.', только что поступил новый заказ!');

        $mail->line('<b>Заказ (ID: '.$this->order->id.'):</b>');
        $msg = '';

        foreach ($this->order->dishes as $dish){
            $msg .= $dish->name.' x '. $dish->pivot->quantity.' ('.$dish->pivot->total_price.'руб.)<br>';
        }

        $mail->line($msg);

        $mail->action('Список заказов', route('admin.home'));

        $mail->line("---------------------------------");
        $mail->line("");

        $mail->line("<b>Данные пользователя:</b>");

        $msg = '';
        if($this->order->phone){
            $msg .= "<b>Телефон:</b> ".$this->order->phone;
        }
        if($this->order->name){
            $msg .= "<br>Имя: ".$this->order->name;
        }
        if($this->order->persons){
            $msg .= "<br>Кол-во персон: ".$this->order->persons;
        }
        if($this->order->email){
            $msg .= "<br>Email: ".$this->order->email;
        }
        if($this->order->street){
            $msg .= "<br>Улица: ".$this->order->street;
        }
        if($this->order->home){
            $msg .= "<br>Дом: ".$this->order->home;
        }
        if($this->order->dop){
            $msg .= "<br>Дополнительно: ".$this->order->dop;
        }

        $mail->line($msg);

        return $mail;
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
