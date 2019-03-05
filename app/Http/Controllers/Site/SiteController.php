<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Town;
use App\User;

class SiteController extends Controller
{
    protected $admin_categories;
    protected $town;

    public function __construct()
    {
        $this->admin_categories = User::getAdmin()->categories;
        $this->data['top_categories'] = $this->admin_categories;

        //Геленджик
        $this->town = Town::find(1);
    }
}
