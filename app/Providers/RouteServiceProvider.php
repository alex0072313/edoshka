<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Dish;
use App\Helpmsg;
use App\Restaurant;
use App\Town;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('category_alias', function ($value) {
            return Category::where('alias', $value)->firstorFail();
        });

        Route::bind('article_alias', function ($value) {
            return Article::where('alias', $value)->firstorFail();
        });

        Route::bind('restaurant_alias', function ($value) {
            return Restaurant::where('alias', $value)->firstorFail();
        });

        Route::bind('category_str_id', function ($value) {
            return Category::findOrFail(str_replace('category_', '', $value));
        });

        Route::bind('restaurant_str_id', function ($value) {
            return Restaurant::findOrFail(str_replace('restaurant_', '', $value));
        });

        Route::bind('dish_str_id', function ($value) {
            return Dish::findOrFail(str_replace('dish_', '', $value));
        });

        Route::bind('restaurant_id', function ($value) {
            return Restaurant::findOrFail($value);
        });

        Route::bind('present', function ($value) {
            return User::findOrFail($value);
        });

        $this->userAccess();

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function userAccess(){
        Route::bind('user', function ($value) {

            $user = User::whereId($value)->first();

            if($user) {
                if (!\Auth::user()->hasRole('megaroot')) {

                    if($user->hasRole('megaroot')){
                        return abort(403);
                    }

                    if(auth()->user()->hasRole('root')){
                        if(auth()->user()->usersOnPresent->where('id', '=', $user->id)->count()) return $user;
                    }

                    if (($user->id != \Auth::id()) && \Auth::user()->hasRole('boss')) {
                        if ($user->restaurant->id == \Auth::user()->restaurant->id) {
                            return $user;
                        }else{
                            return abort(404);
                        }
                    }elseif ($user->id == \Auth::id()){
                        return $user;
                    }else{
                        return abort(403);
                    }
                }else{
                    return $user;
                }
            }else {
                return abort(404);
            };
        });
    }
}
