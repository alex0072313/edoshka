<?php

namespace App\Http\Controllers\Site;

class CategoryController extends SiteController
{
    public function index()
    {
        $this->view = 'site.home';

        return $this->render();
    }
}
