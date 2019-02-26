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