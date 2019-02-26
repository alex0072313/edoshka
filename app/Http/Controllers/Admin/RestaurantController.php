<?php

namespace App\Http\Controllers\Admin;

use App\Restaurant;

class RestaurantController extends AdminController
{
    public function index(Restaurant $restaurant)
    {
        $this->title = 'Данные ресторана';

        $this->view = 'admin.restaurant';

        return $this->render();
    }
}
