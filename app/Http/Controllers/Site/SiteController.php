<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    protected
        $view = '',
        $data = [];

    protected function render()
    {
        return view($this->view, $this->data);
    }
}
