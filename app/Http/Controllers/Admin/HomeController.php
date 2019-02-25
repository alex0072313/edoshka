<?php

namespace App\Http\Controllers\Admin;

class HomeController extends AdminController
{
    public function index()
    {
        $this->view = 'admin.home';

        return $this->render();
    }
}
