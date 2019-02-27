<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Site\HomeController@index')->name('site.home');
Route::get('/cat', 'Site\CategoryController@index')->name('site.category');
Route::get('/rest', 'Site\RestaurantController@index')->name('site.restaurant');


Route::middleware('role:admin|boss')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', 'Admin\HomeController@index')->name('home');

    Route::match(['get', 'post'], '/profile', 'Admin\ProfileController@index')->name('profile'); //Профиль
    Route::match(['get', 'post'], '/restaurant', 'Admin\RestaurantController@index')->name('restaurant'); //Данные ресторана


    //Категории блюд
    Route::get('/categories/{category}/destroy', 'Admin\CategoryController@destroy')->name('categories.destroy');
    Route::resource('categories', 'Admin\CategoryController')
        ->except(['destroy', 'show']);
    //

    //Блюда и категории
    Route::get('dishes/create', 'Admin\DishesController@create')->name('dishes.create');
    Route::get('dishes/{category_str_id?}', 'Admin\DishesController@index')->name('dishes.index');
    Route::get('dishes/{category_str_id}/create', 'Admin\DishesController@create')->name('dishes.create_in_cat');
    Route::get('dishes/{dish_str_id}/destroy', 'Admin\DishesController@destroy')->name('dishes.destroy');
    Route::resource('dishes', 'Admin\DishesController')
        ->except(['index', 'create', 'destroy'])
        ->parameters([
            'dishes' => 'dish_str_id'
        ]);
    //


    //Выход с кабинета
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();
});
