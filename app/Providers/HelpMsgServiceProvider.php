<?php

namespace App\Providers;

use App\Helpmsg;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class HelpMsgServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        view()->composer('*', function($view){
            if (!strstr($view->getName(), 'site.includes')) {
                $view_name = str_replace('.', '-', str_replace('.', '-', $view->getName()));
                view()->share('view_name', $view_name);
            }
        });

        $helpmsgs = Helpmsg::all();

        view()->composer('*', function ($view) use ($helpmsgs) {
            $helpmsgs_on_page = $helpmsgs
                //->where('page', '=', str_replace('.', '-', $view->getName()))
                ->keyBy('name')
                ->map(function ($helpmsg){
                    return $helpmsg->value;
                })
                ->toArray();

            \View::share('helpmsgs_on_page', $helpmsgs_on_page);

        });

        \Blade::directive('helpmsg', function ($val) {
            return "<?php 
            \$name = $val;
            \$value = '';
            if(isset(\$helpmsgs_on_page[\$name])){
                \$value = \$helpmsgs_on_page[\$name];
            }
            echo \$__env->make('site.includes.helpmsg', ['name' => \$name, 'value' => \$value, 'page' => \$view_name])->render(); 
            ?>";
        });
    }
}
