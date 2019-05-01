<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\SocialiteServiceProvider;
use Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $user      = User::where(['email' => $userSocial->getEmail()])->first();

        if($user){
            Auth::login($user);
        }else{
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
        }

        return redirect()->route('site.home');
    }
}
