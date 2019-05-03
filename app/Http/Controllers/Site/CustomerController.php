<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

class CustomerController extends SiteController
{
    public function index()
    {
        $this->view = 'site.customer.home';

        $this->title = 'Личный кабинет ';
        $this->longtitle = 'Кабинет пользователя';

        return $this->render();
    }
}
