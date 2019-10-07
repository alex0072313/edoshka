<?php

namespace App\Http\Middleware;

use App\Town;
use Closure;

class CheckSubdomainHome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $stop = false;
        //Проверяем город
        if(count($domain = explode('.', request()->getHost())) > 2){
            $stop = true;
            if($town = Town::where('alias', '=', $domain[0])->first()){

                switch (request()->route()->getName()){

                    case 'site.home':
                        $stop = false;
                    break;

                    case 'site.category':
                        $stop = false;
                    break;

                    case 'site.restaurant':
                        if($restaurant = request()->route('restaurant_alias')){
                            if($restaurant->town_id == $town->id){
                                $stop = false;
                            }else{
                                return abort(404);
                            }
                        }
                    break;

                }

            }
        }

        return $stop ? redirect(\Config::get('app.url')) : $next($request);
    }
}
