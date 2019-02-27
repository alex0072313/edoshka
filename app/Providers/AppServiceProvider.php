<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function() {
            $user = (object)[];
            if($user = Auth::user()){
                $user = $user;
            }
            View::share('user', $user);
        });

        View::composer('admin.*', function() {
            $restaurant = (object)[];
            if($restaurant = Auth::user()->restaurant){
                $restaurant = $restaurant;
            }
            View::share('restaurant', $restaurant);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
