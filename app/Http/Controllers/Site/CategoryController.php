<?php

namespace App\Http\Controllers\Site;

class CategoryController extends SiteController
{
    public function index()
    {
        $this->view = 'site.category';

        return $this->render();
    }
}
