<?php
// Site
use App\Town;

Breadcrumbs::for('site.home', function ($trail) {

    if(count($domain = explode('.', request()->getHost())) > 2){
        $town = Town::where('alias', '=', $domain[0])->first();
    }else{
        $town = Town::find(1);
    }

    $trail->push('Рестораны '.($town->name2 ? $town->name2 : $town->name), route('site.home'));
});
Breadcrumbs::for('site.article', function ($trail, \App\Article $article) {
    $trail->parent('site.home');
    $trail->push($article->title, route('site.article', ['alias'=>$article->alias]));
});
Breadcrumbs::for('site.category', function ($trail, \App\Category $category) {
    $trail->parent('site.home');
    $trail->push($category->name, route('site.category', ['alias'=>$category->alias]));
});
Breadcrumbs::for('site.restaurant', function ($trail, \App\Restaurant $restaurant) {
    $trail->parent('site.home');
    $trail->push($restaurant->name, route('site.restaurant', ['alias'=>$restaurant->alias]));
});

Breadcrumbs::for('customer.home', function ($trail) {
    $trail->parent('site.home');
    $trail->push('Личный кабинет', route('customer.home'));
});

Breadcrumbs::for('customer.profile', function ($trail) {
    $trail->parent('customer.home');
    $trail->push('Профиль', route('customer.profile'));
});

Breadcrumbs::for('customer.orders', function ($trail) {
    $trail->parent('customer.home');
    $trail->push('Заказы', route('customer.orders'));
});
///

// Home
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('Панель управления', route('admin.home'));
});

Breadcrumbs::for('admin.restaurant.edit', function ($trail, $restaurant) {
    $trail->parent('admin.home');
    $trail->push('Данные ресторана', route('admin.restaurant.edit', $restaurant->id));
});

Breadcrumbs::for('admin.profile', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Профиль пользователя', route('admin.profile'));
});

//Категории
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Категории блюд', route('admin.categories.index'));
});
Breadcrumbs::for('admin.categories.edit', function ($trail, $category) {
    $trail->parent('admin.categories.index');
    $trail->push('Редактирование категории', route('admin.categories.edit', $category->id));
});
Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push('Создание категории', route('admin.categories.create'));
});
//

//Акции
Breadcrumbs::for('admin.specials.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Акции ресторанов', route('admin.specials.index'));
});
Breadcrumbs::for('admin.specials.edit', function ($trail, $special) {
    $trail->parent('admin.specials.index');
    $trail->push('Редактирование акции', route('admin.specials.edit', $special->id));
});
Breadcrumbs::for('admin.specials.create', function ($trail) {
    $trail->parent('admin.specials.index');
    $trail->push('Создание акции', route('admin.specials.create'));
});
//

//Статьи
Breadcrumbs::for('admin.articles.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Статьи', route('admin.articles.index'));
});
Breadcrumbs::for('admin.articles.edit', function ($trail, $article) {
    $trail->parent('admin.articles.index');
    $trail->push('Редактирование статьи', route('admin.articles.edit', $article->id));
});
Breadcrumbs::for('admin.articles.create', function ($trail) {
    $trail->parent('admin.articles.index');
    $trail->push('Создание статьи', route('admin.articles.create'));
});
//

//Рестораны
Breadcrumbs::for('admin.restaurants.index', function ($trail) {
    if(Auth::user()->hasRole('megaroot')){
        $trail->parent('admin.home');
        $trail->push('Рестораны', route('admin.restaurants.index'));
    }
});
Breadcrumbs::for('admin.restaurants.edit', function ($trail, $category) {
    if(Auth::user()->hasRole('megaroot')){
        $trail->parent('admin.restaurants.index');
    }else{
        $trail->parent('admin.home');
    }
    $trail->push('Редактирование ресторана', route('admin.restaurants.edit', $category->id));
});
Breadcrumbs::for('admin.restaurants.create', function ($trail) {
    if(Auth::user()->hasRole('megaroot')){
        $trail->parent('admin.restaurants.index');
    }else{
        $trail->parent('admin.home');
    }
    $trail->push('Создание ресторана', route('admin.restaurants.create'));
});
//

//Города
Breadcrumbs::for('admin.towns.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список городов', route('admin.towns.index'));
});
Breadcrumbs::for('admin.towns.edit', function ($trail, $user) {
    $trail->parent('admin.towns.index');
    $trail->push('Редактирование города', route('admin.towns.edit', $user));
});
Breadcrumbs::for('admin.towns.create', function ($trail) {
    $trail->parent('admin.towns.index');
    $trail->push('Добавление города', route('admin.towns.create'));
});

//Районы
Breadcrumbs::for('admin.districts.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список районов', route('admin.districts.index'));
});
Breadcrumbs::for('admin.districts.edit', function ($trail, $user) {
    $trail->parent('admin.districts.index');
    $trail->push('Редактирование района', route('admin.districts.edit', $user));
});
Breadcrumbs::for('admin.districts.create', function ($trail) {
    $trail->parent('admin.districts.index');
    $trail->push('Добавление района', route('admin.districts.create'));
});

//Покупатели
Breadcrumbs::for('admin.customers.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список покупателей', route('admin.customers.index'));
});

Breadcrumbs::for('admin.customers.show', function ($trail, $customer) {
    $trail->parent('admin.customers.index');
    $trail->push('Покупатель', route('admin.customers.show', $customer));
});

//Блюда
Breadcrumbs::for('admin.dishes.index', function ($trail, $category = false) {
    $trail->parent('admin.home');
    $trail->push('Блюда'.($category ? (': '.$category->name) : ''), ($category ? route('admin.dishes.index', 'category_'.$category->id) : route('admin.dishes.index')) );
});
Breadcrumbs::for('admin.dishes.edit', function ($trail, $dish) {
    $trail->parent('admin.dishes.index');
    $trail->push('Редактирование блюда', route('admin.dishes.edit', 'dish_'.$dish->id));
});
Breadcrumbs::for('admin.dishes.create', function ($trail) {
    $trail->parent('admin.dishes.index');
    $trail->push('Добавление блюда', route('admin.dishes.create'));
});

Breadcrumbs::for('admin.dishes.create_in_cat', function ($trail, $category) {
    $trail->parent('admin.dishes.index', $category);
    $trail->push('Добавление блюда', route('admin.dishes.create_in_cat', 'category_'.$category->id));
});
//

//Маркеры
Breadcrumbs::for('admin.markers.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список маркеров', route('admin.markers.index'));
});
Breadcrumbs::for('admin.markers.edit', function ($trail, $marker) {
    $trail->parent('admin.markers.index');
    $trail->push('Редактирование маркера', route('admin.markers.edit', $marker));
});
Breadcrumbs::for('admin.markers.create', function ($trail) {
    $trail->parent('admin.markers.index');
    $trail->push('Добавление маркера', route('admin.markers.create'));
});

//Кухни
Breadcrumbs::for('admin.kitchens.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список кухонь', route('admin.kitchens.index'));
});
Breadcrumbs::for('admin.kitchens.edit', function ($trail, $kitchen) {
    $trail->parent('admin.kitchens.index');
    $trail->push('Редактирование кухни', route('admin.kitchens.edit', $kitchen));
});
Breadcrumbs::for('admin.kitchens.create', function ($trail) {
    $trail->parent('admin.kitchens.index');
    $trail->push('Добавление кухни', route('admin.kitchens.create'));
});

//Слайды
Breadcrumbs::for('admin.slides.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список слайдов', route('admin.slides.index'));
});
Breadcrumbs::for('admin.slides.edit', function ($trail, $user) {
    $trail->parent('admin.slides.index');
    $trail->push('Редактирование слайда', route('admin.slides.edit', $user));
});
Breadcrumbs::for('admin.slides.create', function ($trail) {
    $trail->parent('admin.slides.index');
    $trail->push('Добавление слайда', route('admin.slides.create'));
});

//Области
Breadcrumbs::for('admin.helpmsgs.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список полей', route('admin.helpmsgs.index'));
});
Breadcrumbs::for('admin.helpmsgs.edit', function ($trail, $helpmsg) {
    $trail->parent('admin.helpmsgs.index');
    $trail->push('Редактирование поля', route('admin.helpmsgs.edit', ['helpmsg_name' => $helpmsg->name]));
});
Breadcrumbs::for('admin.helpmsgs.create', function ($trail) {
    $trail->parent('admin.helpmsgs.index');
    $trail->push('Добавление поля', route('admin.helpmsgs.create'));
});

//Seo
Breadcrumbs::for('admin.seopages.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список Seo тегов', route('admin.seopages.index'));
});
Breadcrumbs::for('admin.seopages.edit', function ($trail, $seopage) {
    $trail->parent('admin.seopages.index');
    $trail->push('Редактирование Seo тегов', route('admin.seopages.edit', ['town'=>$seopage->town_id, 'url'=>$seopage->url]));
});
Breadcrumbs::for('admin.seopages.create', function ($trail) {
    $trail->parent('admin.seopages.index');
    $trail->push('Добавление Seo тегов', route('admin.seopages.create'));
});


//megaroot
//Breadcrumbs::for('_company_list', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Список компаний', route('_company_list'));
//});
//Breadcrumbs::for('_company_edit', function ($trail, $company) {
//    $trail->parent('_company_list');
//    $trail->push('Компания', route('_company_edit', $company));
//});

Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Управляющие', route('admin.users.index'));
});

Breadcrumbs::for( 'admin.users.edit', function ($trail, $user) {
    $trail->parent(auth()->user()->hasRole('boss') ? 'admin.home' : 'admin.users.index');
    $trail->push('Редактирование пользователя', route('admin.users.edit', $user));
});

Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Добавление пользователя', route('admin.users.create'));
});
//

//Представители
Breadcrumbs::for('admin.presents.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Список представителей', route('admin.presents.index'));
});

Breadcrumbs::for('admin.presents.edit', function ($trail, $user) {
    $trail->parent(!auth()->user()->hasRole('megaroot') ? 'admin.home' : 'admin.presents.index');
    $trail->push('Редактирование представителя', route('admin.presents.edit', $user));
});

Breadcrumbs::for('admin.presents.create', function ($trail) {
    $trail->parent('admin.presents.index');
    $trail->push('Добавление представителя', route('admin.presents.create'));
});
