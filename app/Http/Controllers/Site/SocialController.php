<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
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
            \Auth::login($user);
        }else{
            $user = new User;
            $user->name = $userSocial->getName();
            $user->password = \Hash::make($userSocial->getName().$userSocial->getEmail());
            $user->email = $email;
            $user->image = $userSocial->getAvatar();
            $user->provider_id = $userSocial->getId();
            $user->provider = $provider;

            $user->save();
            $user->assignRole('customer');

            \Auth::login($user);
        }

        return redirect('/');
    }
}
