<?php

namespace App\Providers;

use App\Helpmsg;
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

                $helpmsgs_on_page = cache()->remember('helpmsgs_on_page', 30, function () use ($view){
                    return Helpmsg::getByPage(str_replace('.', '-', $view->getName()));
                });

                View::share('helpmsgs_on_page', $helpmsgs_on_page);
            }
        });

        //Корзина
        view()->composer(['site.*', 'layouts.site'], function () {
            //\Cart::clear();
            View::share( '_cart_content', \Cart::getContent());
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
