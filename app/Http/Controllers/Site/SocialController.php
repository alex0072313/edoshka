<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Order;
use App\Repositories\UserRepository;
use App\User;
use Laravel\Socialite\SocialiteServiceProvider;
use Socialite;
use Spatie\Permission\Models\Role;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();

        if(!$email = $userSocial->getEmail()){
            $email = '';
            if(isset($userSocial->nickname) && !empty($userSocial->nickname)){
                $email .= $userSocial->nickname;
            }elseif ($userSocial->getId()){
                $email .= $userSocial->getId();
            }
            $email .= '_'.$provider.'@edoshka.ru';
        }

        $user = User::where(['email' => $email])->first();

        if($user){
            \Auth::login($user, true);
        }else{
            $user = new User;
            $user->name = $userSocial->getName();
            $user->password = \Hash::make($userSocial->getName().$userSocial->getEmail());
            $user->email = $email;
            $user->image = $userSocial->getAvatar();
            $user->provider_id = $userSocial->getId();
            $user->provider = $provider;

            $user->save();

            if($user->save()){
                if($url = $user->image){
                    $contents = file_get_contents($url);
                    $name = substr($url, strrpos($url, '/') + 1);
                    //\Storage::put('user_imgs/'.$user->id.'/temp.jpg', $contents);
                    UserRepository::createThumb($contents, $user, false);
                }
            }

            $user->assignRole('customer');

            \Auth::login($user, true);
        }

        if(session()->exists('user_orders')){
            $total = 0;
            foreach (session()->get('user_orders') as $order_id){
                $order = Order::find($order_id);
                $total += $order->totalPrice;
                $order->update(['user_id'=>$user->id]);
            }

            //Добавляем баллы
            auth()->user()->addBalls($total);

            session()->remove('user_orders');
        }

        return redirect()->back();
    }
}
