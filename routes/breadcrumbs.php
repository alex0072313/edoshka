<?php
// Home
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('Панель управления', route('admin.home'));
});

Breadcrumbs::for('admin.restaurant', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Данные ресторана', route('admin.restaurant'));
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