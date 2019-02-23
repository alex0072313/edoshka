<?php

namespace App\Http\Controllers\Site;

class RestaurantController extends SiteController
{
    public function index()
    {
        $this->view = 'site.home';

        return $this->render();
    }
}
