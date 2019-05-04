<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Customer;

class CustomerController extends SiteController
{
    public function __construct()
    {
        $this->middleware(Customer::class);
        parent::__construct();
    }

    public function index()
    {
        $this->view = 'site.customer.home';

        $this->title = 'Личный кабинет ';
        $this->longtitle = 'Кабинет пользователя';

        return $this->render();
    }
}
