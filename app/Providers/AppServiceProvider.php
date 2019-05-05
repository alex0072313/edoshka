<?php

namespace App\Providers;

use App\Helpmsg;
use Illuminate\Support\ServiceProvider;
use View;
use Auth;
use Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('phone_number', function($attribute, $value, $parameters)
        {
            return valid_phone($value) != null;
        });

        View::composer('*', function() {
            $user = (object)[];
            if($user = Auth::user()){
                $user = $user;
            }
            View::share('_user', $user);
        });

        View::composer('admin.*', function() {
            $restaurant = (object)[];
            if($restaurant = Auth::user()->restaurant){
                $restaurant = $restaurant;
            }
            View::share('_restaurant', $restaurant);
        });

        //Поля
        view()->composer('*', function($view){
            if (!strstr($view->getName(), 'site.includes')) {
                $view_name = str_replace('.', '-', str_replace('.', '-', $view->getName()));
                view()->share('view_name', $view_name);
            }
        });

        view()->composer(['site.*', 'layouts.site'], function ($view) {
            if (!strstr($view->getName(), 'site.includes')) {

                $helpmsgs_on_page = cache()->remember('helpmsgs_on_page_'.$view->getName(), 30, function () use ($view){
                    return Helpmsg::getByPage(str_replace('.', '-', $view->getName()));
                });

                View::share('helpmsgs_on_page', $helpmsgs_on_page);
            }
        });

        //Корзина
        view()->composer(['site.*', 'layouts.site'], function () {
            //\Cart::clear();
            $content = \Cart::getContent();

            $restaurants_out_worktime = [];
            $restaurants_sums = [];
            $restaurants_small_order = [];
            $restaurants_min_sum_order = [];

            foreach ($content as $dish){
                if(isset($dish->attributes['restaurant'])){
                    if($worktime = $dish->attributes['restaurant']->worktime){
                        if((strtotime(date('H:i')) < strtotime($worktime[0])) || (strtotime(date('H:i')) > strtotime($worktime[1]))){
                            $restaurants_out_worktime[] = $dish->attributes['restaurant'];
                        }
                    }
                    $restaurants_sums[$dish->attributes['restaurant']->id][] = $dish->price * $dish->quantity;
                    $restaurants_min_sum_order[$dish->attributes['restaurant']->id] = $dish->attributes['restaurant']->min_sum_order;
                }
            }

            foreach ($restaurants_sums as $id => $restaurants_sum){
                $sum = array_sum($restaurants_sum);
                if($sum < $restaurants_min_sum_order[$id]){
                    $restaurants_small_order[$id] = $restaurants_min_sum_order[$id];
                }
            }

            View::share( '_cart_restaurants_small_order', $restaurants_small_order);
            View::share( '_cart_restaurants_out_worktime', $restaurants_out_worktime);
            View::share( '_cart_content', $content);
            View::share( '_cart_total_q', \Cart::getTotalQuantity());
            View::share( '_cart_total_p', \Cart::getTotal());
        });

        \Blade::directive('helpmsg', function ($val) {
            return "<?php 
            \$name = $val;
            if(isset(\$helpmsgs_on_page[\$name])){
                \$config = \$helpmsgs_on_page[\$name];
            }else{
                \$config = [
                    'id'=> 0,
                    'value'=> '',
                    'name'=> \$name,
                ];
            }
            echo \$__env->make('site.includes.helpmsg', ['config' => \$config, 'page' => \$view_name])->render(); 
            ?>";
        });
        //

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
