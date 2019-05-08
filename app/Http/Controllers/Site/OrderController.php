<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Notifications\NewOrder;
use App\Order;
use App\Restaurant;
use App\User;

class OrderController extends Controller
{
    public function send()
    {

        $response = [];

        $validate = \Validator::make(request()->all(), [
            'phone' => 'required|phone_number',
            'accept_policy' => 'required'
        ], [
            'phone.required' => 'Необходимо указать телефон!',
            'phone.phone_number' => 'Телефон указан не верно!',
            'accept_policy.required' => 'Необходимо согласиться с политикой конфиденциальности!',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        //return response()->json(request()->all());

        $restaurants = [];
        $prices = [];
        $user_orders = [];
        foreach ($dishes = request('dishes') as $dish_id => $quantity){
            $dish = Dish::find($dish_id);

            $prices[$dish_id] = request('dishes_prices')[$dish_id];

            $restaurants[$dish->restaurant_id][$dish_id] = $quantity;
        }

        //Привязываем к юзеру
        if(auth()->user()){
            request()->request->add(['user_id'=>auth()->id()]);

            //Добавляем баллы
            auth()->user()->addBalls(\Cart::getTotal());
        }

        foreach ($restaurants as $restaurant_id => $dishes){
            $restaurant = Restaurant::find($restaurant_id);

            $order = $restaurant->orders()->create(request()->all());

            $sync_data = [];
            $dishes_variants = request('dishes_variants');
            foreach ($dishes as $dish_id => $quantity){
                $variants = isset($dishes_variants[$dish_id]) ? $dishes_variants[$dish_id] : '';

                $sync_data[$dish_id] = ['quantity'=>$quantity, 'price'=>$prices[$dish_id], 'variants'=>$variants, 'total_price'=>$prices[$dish_id] * $quantity];
            }
            $order->dishes()->sync($sync_data);

            foreach ($restaurant->users as $user){
                //$user->notify(new NewOrder($user, $order));
                $user->notify(new \App\Notifications\Order($user, $order));
            }

            //Дублируем мне
            $admin = User::getAdmin();
            $admin->notify(new \App\Notifications\Order($admin, $order));

            $user_orders[] = $order->id;
        }

        \Cart::clear();

        $redirect = null;

        //Регистрация юзера
        if(!auth()->user()){

            if($reg_type = request('reg_type')){
                switch ($reg_type){
                    case 'phone':
                        if($phone = valid_phone(request('phone'))){
                            $user = new User();

                            if($email = request('email')){
                                $user->email = $email;
                            }else{
                                $user->email = $phone.'@edoshka.ru';
                            }
                            $user->phone = $phone;

                            $user->name = request('name') ? request('name') : '';

                            $user->image = '';
                            $user->provider_id = '';

                            $new_password = str_random(6);
                            $user->password = \Hash::make($new_password);
                            $user->provider = 'phone';
                            $user->save();
                            $user->assignRole('customer');
                            \Auth::login($user, true);

                            foreach ($user_orders as $order_id){
                                Order::find($order_id)->update(['user_id'=>$user->id]);
                            }

                            $text = 'Edoshka.ru - Вы зарегистрированы!'."\r\n";
                            $text .= 'Логин: '.$user->phone."\r\n";
                            $text .= 'Пароль: '.$new_password."\r\n";

                            send_sms($text, $phone);

                            $redirect = url()->previous();
                        }
                    break;

                    case 'email':
                        if($email = request('email')){
                            $phone = valid_phone(request('phone'));
                            if(!User::where('email', '=', $email)->orWhere('phone', '=', $phone)->count()){

                                $user = new User();
                                $user->email = $email;
                                $user->phone = $phone;
                                $user->name = request('name') ? request('name') : '';

                                $user->image = '';
                                $user->provider_id = '';

                                $new_password = str_random(6);
                                $user->password = \Hash::make($new_password);
                                $user->provider = 'email';

                                $user->save();
                                $user->assignRole('customer');
                                \Auth::login($user, true);

                                foreach ($user_orders as $order_id){
                                    Order::find($order_id)->update(['user_id'=>$user->id]);
                                }

                                $user->notify(new \App\Notifications\NewCustomer($user, $new_password));
                                $redirect = url()->previous();
                            }
                        }
                    break;
                    case 'vkontakte':
                    case 'instagram':
                    case 'facebook':
                    case 'google':
                        session(['user_orders' => $user_orders]);
                        $redirect = route('login_soc', $reg_type);
                    break;
                }
            }
        }

        return response()->json(['success'=>['title'=>'Заказ принят', 'text'=>'Мы перезвоним Вам для уточнения заказа в ближайшее время!'], 'redirect' => $redirect]);
    }
}
