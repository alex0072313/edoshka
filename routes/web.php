<?php

Route::get('/', 'Site\HomeController@index')->name('site.home');
Route::get('/cat', 'Site\CategoryController@index')->name('site.category');
Route::get('/rest', 'Site\RestaurantController@index')->name('site.restaurant');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', 'Admin\HomeController@index')->name('home');

    //Профиль
    Route::match(['get', 'post'], '/profile', 'Admin\ProfileController@index')->name('profile');

    //Категории блюд
    Route::get('/categories/{category}/destroy', 'Admin\CategoryController@destroy')->name('categories.destroy');
    Route::resource('categories', 'Admin\CategoryController')->except(['destroy', 'show']);

    //Блюда
    Route::get('dishes/create', 'Admin\DishesController@create')->name('dishes.create');
    Route::get('dishes/{category_str_id?}', 'Admin\DishesController@index')->name('dishes.index');
    Route::get('dishes/{category_str_id}/create', 'Admin\DishesController@create')->name('dishes.create_in_cat');
    Route::get('dishes/{dish_str_id}/destroy', 'Admin\DishesController@destroy')->name('dishes.destroy');
    Route::resource('dishes', 'Admin\DishesController')
        ->except(['index', 'create', 'destroy'])
        ->parameters([
            'dishes' => 'dish_str_id'
        ]);

    //Пользователи
    Route::get('/users/{user}/destroy', 'Admin\UserController@destroy')->name('users.destroy');
    Route::resource('users', 'Admin\UserController')->except('destroy');

    //Выход с кабинета
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    //Директор
    Route::group(['middleware' => ['role:boss|megaroot']], function () {
        //Рестораны
        Route::get('/restaurants/{restaurant}/destroy', 'Admin\RestaurantController@destroy')->name('restaurants.destroy');
        Route::resource('restaurants', 'Admin\RestaurantController')->except('destroy');
    });

    //Мегарут
    Route::group(['middleware' => ['role:megaroot']], function () {
        //Города
        Route::get('/towns/{town}/destroy', 'Admin\TownsController@destroy')->name('towns.destroy');
        Route::resource('towns', 'Admin\TownsController')->except('destroy');

        //Маркеры для блюд
        Route::get('/markers/{marker}/destroy', 'Admin\MarkersController@destroy')->name('markers.destroy');
        Route::resource('markers', 'Admin\MarkersController')->except('destroy');
    });
});

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();
});
