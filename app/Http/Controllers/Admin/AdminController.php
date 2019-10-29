<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $longtitle = '';

    public function __construct(){
        $this->checkUser();
    }

    protected function checkUser()
    {

        $this->middleware(function ($request, $next) {

            if(\Auth::user() && \Auth::user()->hasRole('customer')){
                return redirect()->route('site.home');
            }

            if(!\Auth::user() || (!\Auth::user()->hasAnyRole(['megaroot', 'root', 'boss', 'manager']))){
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

}
