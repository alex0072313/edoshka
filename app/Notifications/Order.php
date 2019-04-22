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

        $mail->from(env('MAIL_USERNAME'));
        $subject = env('APP_NAME').': Новый заказ (ID: '.$this->order->id.') на сумму '.$this->total_price.' руб.';
        $mail->subject($subject);

        $sms = $subject;

        $data['order_id'] = $this->order->id;
        $data['orders_url'] = route('admin.home');
        $data['total_price'] = $this->total_price;

        $data['dishes'] = $this->order->dishes;

        $sms .= "\r\n".'--'."\r\n";
        foreach ($data['dishes'] as $dish){
            $sms .= $dish->name . ' '.($dish->pivot->variants ? $dish->pivot->variants : $dish->short_description).' ('.$dish->price.'р) '.$dish->pivot->quantity.'шт,'."\r\n";
        }
        $sms .= '--'."\r\n";

        if($this->order->phone){
            $data['phone'] = $this->order->phone;
            $sms .= 'Тел: '.$data['phone']."\r\n";
        }
        if($this->order->name){
            $data['name'] = $this->order->name;
            $sms .= 'Имя: '.$data['name']."\r\n";
        }
        if($this->order->persons){
            $data['persons'] = $this->order->persons;
            $sms .= 'Персон: '.$data['persons']."\r\n";
        }
        if($this->order->email){
            $data['email'] = $this->order->email;
            $sms .= 'Email: '.$data['email']."\r\n";
        }
        if($this->order->street){
            $data['street'] = $this->order->street;
            $sms .= 'Улица: '.$data['street']."\r\n";
        }
        if($this->order->home){
            $data['home'] = $this->order->home;
            $sms .= 'Дом: '.$data['home']."\r\n";
        }
        if($this->order->dop){
            $data['dop'] = $this->order->dop;
            $sms .= 'Доп: '.$data['dop']."\r\n";
        }

        if(!$this->user->hasRole('megaroot') && $this->user->phone /*&& (env('APP_ENV') != 'local') */){
            if($this->user->order_in_sms){
                $this->sms($sms);
            }else{
                $this->sms($subject);
            }
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

    protected function sms($text = '')
    {
        $client = new \Twilio\Rest\Client(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));
        if($this->user->phone){
            $client->messages->create(
                $this->user->phone,
                array(
                    'from' => getenv('TWILIO_FROM_PHONE'),
                    'body' => $text
                )
            );
        }

        if($this->user->phone2){
            $client->messages->create(
                $this->user->phone2,
                array(
                    'from' => getenv('TWILIO_FROM_PHONE'),
                    'body' => $text
                )
            );
        }

    }
}
