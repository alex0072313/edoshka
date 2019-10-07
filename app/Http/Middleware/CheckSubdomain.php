<?php

namespace App\Http\Middleware;

use App\Town;
use Closure;

class CheckSubdomain
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
        $gohome = $abort = false;
        $town_subdomain = $town = null;

        if(count($domain = explode('.', request()->getHost())) > 2){
            if($town = Town::where('alias', '=', $domain[0])->first()){
                $town_subdomain = $town;
            }else{
                $gohome = true;
            }
        }else{
            $town = Town::find(1); //Геленджик
        }

        if($gohome) return redirect(\Config::get('app.url'));

        switch (request()->route()->getName()){
            case 'site.restaurant':
                if($restaurant = request()->route('restaurant_alias')){
                    if( (!$town_subdomain && $town && ($restaurant->town_id != $town->id)) || ($town_subdomain && ($restaurant->town_id != $town_subdomain->id)) ){
                        $abort = true;
                    }
                }else{
                    $abort = true;
                }
            break;
        }

        return $abort ? abort(404) : $next($request);

//        $stop = false;
//        //Проверяем город
//        if(count($domain = explode('.', request()->getHost())) > 2){
//            $stop = true;
//            if($town = Town::where('alias', '=', $domain[0])->first()){
//
//                switch (request()->route()->getName()){
//
//                    case 'site.home':
//                        $stop = false;
//                    break;
//
//                    case 'site.category':
//                        $stop = false;
//                    break;
//
//                    case 'site.restaurant':
//                        if($restaurant = request()->route('restaurant_alias')){
//                            if($restaurant->town_id == $town->id){
//                                $stop = false;
//                            }else{
//                                return abort(404);
//                            }
//                        }
//                    break;
//
//                }
//
//            }
//        }
//
//
//        return $stop ? redirect(\Config::get('app.url')) : $next($request);

    }
}
