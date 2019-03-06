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
            $view_name = str_replace('.', '-', str_replace('.', '-', $view->getName()));
            view()->share('view_name', $view_name);
        });
        view()->composer(['site.*', 'layouts.site'], function ($view) {
            $helpmsgs_on_page = Helpmsg::getByPage(str_replace('.', '-', $view->getName()));
            View::share( 'helpmsgs_on_page', $helpmsgs_on_page);
        });
        \Blade::directive('helpmsg', function ($name) {
            return "<?php 
            if(isset(\$helpmsgs_on_page['{$name}'])){
                \$config = \$helpmsgs_on_page['{$name}'];
            }else{
                \$config = [
                    'id'=> 0,
                    'value'=> '',
                    'name'=> '{$name}',
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
