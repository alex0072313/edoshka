<?php

namespace App\Providers;

use App\Category;
use App\Dish;
use App\Policies\CategoryPolicy;
use App\Policies\DishPolicy;
use App\Policies\RestaurantPolicy;
use App\Restaurant;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Dish::class    => DishPolicy::class,
        Restaurant::class    => RestaurantPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
