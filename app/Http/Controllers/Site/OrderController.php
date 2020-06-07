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
        $cart_total = \Cart::getTotal();

        $restaurants = [];
        $prices = [];
        $user_orders = [];
        foreach ($dishes = request('dishes') as $dish_id => $quantity) {
            $dish = Dish::find($dish_id);

            $prices[$dish_id] = request('dishes_prices')[$dish_id];

            $restaurants[$dish->restaurant_id][$dish_id] = $quantity;
        }

        $val_r = [
            'phone' => 'required|phone_number',
            'accept_policy' => 'required',
        ];

        $val_v = [
            'phone.required' => 'Необходимо указать телефон!',
            'phone.phone_number' => 'Телефон указан не верно!',
            'accept_policy.required' => 'Необходимо согласиться с политикой конфиденциальности!',
        ];

        if(count($restaurants) > 1){
            $val_r['accept_usl'] = 'required';
            $val_v['accept_usl.required'] = 'Необходимо согласиться с условиями заказа!';
        }

        $validate = \Validator::make(request()->all(), $val_r, $val_v);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }

        //Привязываем к юзеру
        if (auth()->user()) {
            request()->request->add(['user_id' => auth()->id()]);

            //Добавляем баллы
            //auth()->user()->addBalls($cart_total);
        }

        foreach ($restaurants as $restaurant_id => $dishes) {
            $restaurant = Restaurant::find($restaurant_id);

            $order = $restaurant->orders()->create(request()->all());

            $sync_data = [];
            $dishes_variants = request('dishes_variants');
            foreach ($dishes as $dish_id => $quantity) {
                $variants = isset($dishes_variants[$dish_id]) ? $dishes_variants[$dish_id] : '';

                $sync_data[$dish_id] = ['quantity' => $quantity, 'price' => $prices[$dish_id], 'variants' => $variants, 'total_price' => $prices[$dish_id] * $quantity];
            }
            $order->dishes()->sync($sync_data);

            $restaurant->boss->notify(new \App\Notifications\Order($restaurant->boss, $order, $restaurant));

            //Дублируем мне
            //$admin = User::getAdmin();
            //$admin->notify(new \App\Notifications\Order($admin, $order, $restaurant));

            $user_orders[] = $order->id;
        }

        \Cart::clear();

        $redirect = null;
        //Регистрация юзера

        $login_msg = '';

        if (!auth()->user()) {

            if ($reg_type = request('reg_type')) {
                switch ($reg_type) {
                    case 'phone':
                        if ($phone = valid_phone(request('phone'))) {

                            if ($email = request('email')) {
                                $new_email = $email;
                            }  else {
                                $new_email = $phone . '@edoshka.ru';
                            }

                            if (!$user = User::where('email', '=', $new_email)->orWhere('phone', '=', $phone)->first()) {
                                $user = new User();

                                $user->email = $new_email;
                                $user->phone = $phone;
                                $user->name = request('name') ? request('name') : '';
                                $user->image = '';
                                $user->provider_id = '';

                                $new_password = str_random(6);
                                $user->password = \Hash::make($new_password);
                                $user->provider = 'phone';
                                $user->save();
                                $user->assignRole('customer');
                            }

                            \Auth::login($user, true);

                            //Добавляем баллы
                            //$user->addBalls($cart_total);

                            foreach ($user_orders as $order_id) {
                                Order::find($order_id)->update(['user_id' => $user->id]);
                            }

                            $login_msg = '<div class="text-center mt-3"><b>Для входа на сайт</b>:';
                            $login_msg .= '<br>Логин: ' . $user->phone;
                            $login_msg .= '<br>Пароль: ' . $new_password.'</div>';

                            //send_sms($text, $phone);

                            $redirect = url()->previous();
                        }
                        break;
                    case 'email':
                        if ($email = request('email')) {
                            $phone = valid_phone(request('phone'));

                            if (!$user = User::where('email', '=', $email)->orWhere('phone', '=', $phone)->first()) {
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
                                $user->notify(new \App\Notifications\NewCustomer($user, $new_password));
                            }

                            \Auth::login($user, true);

                            //Добавляем баллы
                            //$user->addBalls($cart_total);

                            foreach ($user_orders as $order_id) {
                                Order::find($order_id)->update(['user_id' => $user->id]);
                            }

                            $redirect = url()->previous();

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

        return response()->json(['success' => ['title' => 'Заказ принят', 'text' => 'Мы перезвоним Вам для уточнения заказа в ближайшее время!'.$login_msg], 'redirect' => $redirect]);
    }
}
