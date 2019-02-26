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


Route::middleware('role:admin|owner')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', 'Admin\HomeController@index')->name('home');

    //Route::get('/profile', 'Admin\ProfileController@index')->name('profile');
    //Route::post('/profile', 'Admin\ProfileController@update')->name('profile_update');

    Route::match(['get', 'post'], '/profile', 'Admin\ProfileController@index')->name('profile');

    Route::match(['get', 'post'], '/restaurant', 'Admin\RestaurantController@index')->name('restaurant');

    //Route::any('/owner', 'Admin\OwnerController@index')->name('owner');
    //Route::resource('dishes', 'Admin\DishesController');

    //Выход с кабинета
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();
});
