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


Route::middleware('auth')->group(function () {
    //Кабинет

});

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();
});
