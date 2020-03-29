<?php
Route::match(['get', 'post'], '/testfood', 'Delivery\DeliveryController@index');

//Админка
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', 'Admin\HomeController@index')->name('home');
    Route::post('/orders_report', 'Admin\HomeController@ordersReport')->name('orders_report');

    //Заказы
    Route::get('/orders/{order}/destroy', 'Admin\OrdersController@destroy')->name('orders.destroy');
    Route::post('/orders/accept', 'Admin\OrdersController@accept')->name('orders.accept');

    Route::match(['get', 'post'], '/orders/{order}/change_sum', 'Admin\OrdersController@change_sum')->name('orders.change_sum');
    Route::match(['get', 'post'], '/orders/{order}/cancle', 'Admin\OrdersController@cancle')->name('orders.cancle');

    Route::post('/orders/append', 'Admin\HomeController@append')->name('orders.append');
    Route::post('/orders/get_totals', 'Admin\HomeController@getTotals')->name('orders.get_totals');

    Route::resource('orders', 'Admin\OrdersController')->except(['destroy']);

    //Профиль
    Route::match(['get', 'post'], '/profile', 'Admin\ProfileController@index')->name('profile');

    //Категории блюд
    Route::get('/categories/{category}/destroy', 'Admin\CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/sort', 'Admin\CategoryController@sort')->name('categories.sort');

    Route::get('/categories/clearsort/{restaurant_id}', 'Admin\CategoryController@clearsort')->name('categories.clearsort');

    Route::resource('categories', 'Admin\CategoryController')->except(['destroy', 'show']);

    //Блюда
    Route::post('dishes/find_repeat', 'Admin\DishesController@findRepeat')->name('dishes.find_repeat');
    Route::post('dishes/recomendeds_random', 'Admin\DishesController@recomendedsRandom')->name('dishes.recomendeds_random');

    Route::get('dishes/create', 'Admin\DishesController@create')->name('dishes.create');
    Route::get('dishes/{dish}/copy', 'Admin\DishesController@copy')->name('dishes.copy');

    //Route::get('dishes/{category_str_id?}/{restaurant_str_id?}', 'Admin\DishesController@index')->name('dishes.index');
    //Route::get('dishes/{category_str_id?}/{restaurant_str_id?}/create', 'Admin\DishesController@create')->name('dishes.create_in_cat');

    Route::get('dishes/{dish}/destroy', 'Admin\DishesController@destroy')->name('dishes.destroy');
    Route::resource('dishes', 'Admin\DishesController')
        ->except(['destroy'])
        ->parameters([
            'dishes' => 'dish_str_id'
        ]);

    //Пользователи
    Route::get('/users/{user}/destroy', 'Admin\UserController@destroy')->name('users.destroy');
    Route::resource('users', 'Admin\UserController')->except('destroy');

    //Представители
    Route::get('/presents/{present}/destroy', 'Admin\PresentController@destroy')->name('presents.destroy');
    Route::resource('presents', 'Admin\PresentController')->except('destroy');

    //Районы
    Route::get('/districts/{district}/destroy', 'Admin\DistrictsController@destroy')->name('districts.destroy');
    Route::resource('districts', 'Admin\DistrictsController')->except('destroy');

    //Акции
    Route::get('/specials/{special}/destroy', 'Admin\SpecialsController@destroy')->name('specials.destroy');
    Route::resource('specials', 'Admin\SpecialsController')->except('destroy');

    //Выход с кабинета
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    //Директор
    Route::group(['middleware' => ['role:boss|megaroot|root']], function () {
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

        //Кухни
        Route::get('/kitchens/{marker}/destroy', 'Admin\KitchensController@destroy')->name('kitchens.destroy');
        Route::resource('kitchens', 'Admin\KitchensController')->except('destroy');

        //Слайды
        Route::get('/slides/{slide}/destroy', 'Admin\SlidesController@destroy')->name('slides.destroy');
        Route::resource('slides', 'Admin\SlidesController')->except('destroy');

        //Статьи
        Route::get('/articles/{article}/destroy', 'Admin\ArticleController@destroy')->name('articles.destroy');
        Route::resource('articles', 'Admin\ArticleController')->except(['destroy', 'show']);

        //Поля
        //Route::get('/helpmsgs/{page?}/{name?}', 'Admin\HelpmsgsController@destroy')->name('helpmsgs.destroy');

//        Route::get('/helpmsgs/{helpmsg_name}/edit', 'Admin\HelpmsgsController@edit')->name('helpmsgs.edit');
//        Route::resource('helpmsgs', 'Admin\HelpmsgsController')->except(['destroy', 'edit']);

        Route::get('/helpmsgs', 'Admin\HelpmsgsController@index')->name('helpmsgs.index');
        Route::get('/helpmsgs/{page?}/{name?}',  'Admin\HelpmsgsController@helpmsgEditForm')->name('helpmsgs.edit')->where('name','[\w-]+');
        Route::post('/helpmsgs', 'Admin\HelpmsgsController@helpmsgSave')->name('helpmsgs.save');

        //Seo теги
        Route::get('/seopages', 'Admin\SeopagesController@index')->name('seopages.index');
        Route::get('/seopages/{url?}/{town?}',  'Admin\SeopagesController@form')->name('seopages.edit');
        Route::post('/seopages', 'Admin\SeopagesController@save')->name('seopages.save');

        //Покупатели
        Route::post('/customers/append', 'Admin\CustomerController@append')->name('customers.append');
        Route::get('/customers/{user}/destroy', 'Admin\CustomerController@destroy')->name('customers.destroy');
        Route::resource('customers', 'Admin\CustomerController')->except('destroy');

    });
});
////////////////////////////////////////////////////////

Route::middleware('guest')->group(function () {
    //Вход, регистрация, восстановление пароля
    Auth::routes();

    Route::post('/customer_login', 'Auth\LoginController@customer_login')->name('customer_login');

    Route::get('login/{provider}', 'Site\SocialController@redirect')->name('login_soc');
    Route::get('login/{provider}/callback','Site\SocialController@Callback')->name('login_soc_callback');
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/', 'Site\CustomerController@index')->name('home');

    Route::match(['get', 'post'], '/profile/{user?}', 'Site\CustomerController@profile')->name('profile');

    Route::get('/orders', 'Site\CustomerController@orders')->name('orders');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('subdomain')->group(function () {
    Route::get('/', 'Site\HomeController@index')->name('site.home');
    Route::get('/category/{category_alias}/', 'Site\CategoryController@index')->name('site.category');
    Route::get('/restaurant/{restaurant_alias}', 'Site\RestaurantController@index')->name('site.restaurant');
});


//Сохранение подукта в cookie
Route::post('/dishes_viewed_save/{id}', 'Site\SiteController@dishes_viewed_save')->name('site.dishes_viewed_save');

//Получение продукта для окна
Route::post('/get_dish_for_modal', 'Site\SiteController@get_dish_for_modal')->name('site.get_dish_for_modal');

//Корзина
Route::post('/dishes_cart', 'Site\CartController@init')->name('site.dishes_cart');

//Оформление
Route::post('/send_order', 'Site\OrderController@send')->name('site.send_order');

//Поиск
Route::post('/search', 'Site\SearchController@query')->name('site.search');

//Карта сайта
Route::get('/sitemap.xml', 'Site\SitemapController@index')->name('site.sitemap');

Route::get('/{article_alias}', 'Site\ArticleController@index')->name('site.article');
