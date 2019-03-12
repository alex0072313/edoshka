<?php

Route::get('/', 'Site\HomeController@index')->name('site.home');
Route::get('/category/{category_alias}', 'Site\CategoryController@index')->name('site.category');
Route::get('/restaurant/{restaurant_alias}', 'Site\RestaurantController@index')->name('site.restaurant');

//Сохранение подукта в cookie
Route::post('/dishes_viewed_save/{id}', 'Site\SiteController@dishes_viewed_save')->name('site.dishes_viewed_save');

//Корзина
Route::post('/dishes_cart', 'Site\CartController@init')->name('site.dishes_cart');

//Оформление
Route::post('/send_order', 'Site\OrderController@send')->name('site.send_order');

//Админка
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

        //Слайды
        Route::get('/slides/{slide}/destroy', 'Admin\SlidesController@destroy')->name('slides.destroy');
        Route::resource('slides', 'Admin\SlidesController')->except('destroy');

        //Поля
        //Route::get('/helpmsgs/{page?}/{name?}', 'Admin\HelpmsgsController@destroy')->name('helpmsgs.destroy');

//        Route::get('/helpmsgs/{helpmsg_name}/edit', 'Admin\HelpmsgsController@edit')->name('helpmsgs.edit');
//        Route::resource('helpmsgs', 'Admin\HelpmsgsController')->except(['destroy', 'edit']);

        Route::get('/helpmsgs', 'Admin\HelpmsgsController@index')->name('helpmsgs.index');
        Route::get('/helpmsgs/{page?}/{name?}',  'Admin\HelpmsgsController@helpmsgEditForm')->name('helpmsgs.edit')->where('name','[\w-]+');
        Route::post('/helpmsgs', 'Admin\HelpmsgsController@helpmsgSave')->name('helpmsgs.save');

    });
});
////////////////////////////////////////////////////////

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();
});
