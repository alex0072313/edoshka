<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Order extends Notification
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
        $data = [];

        $mail = new MailMessage();

        $mail->subject(config('app.url').': Новый заказ (ID: '.$this->order->id.') на сумму '.$this->total_price.' руб.');

        $data['order_id'] = $this->order->id;
        $data['orders_url'] = route('admin.home');
        $data['total_price'] = $this->total_price;

        $data['dishes'] = $this->order->dishes;

        if($this->order->phone){
            $data['phone'] = $this->order->phone;
        }
        if($this->order->name){
            $data['name'] = $this->order->name;
        }
        if($this->order->persons){
            $data['persons'] = $this->order->persons;
        }
        if($this->order->email){
            $data['email'] = $this->order->email;
        }
        if($this->order->street){
            $data['street'] = $this->order->street;
        }
        if($this->order->home){
            $data['home'] = $this->order->home;
        }
        if($this->order->dop){
            $data['dop'] = $this->order->dop;
        }

        return $mail->markdown('mail.order', $data);
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
