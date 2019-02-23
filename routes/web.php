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

Route::get('/', function () {
    return view('site.home');
});

//Route::get('/rest', function () {
//    return view('site.rest');
//});

Route::get('/cat/rolls', function () {
    return view('site.category');
});

Route::get('/rest/sushi-storm', function () {
    return view('site.shop');
});
