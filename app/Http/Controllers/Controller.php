<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $is_megaroot = null;

    protected
        $title = '',
        $longtitle = '',
        $view = '',
        $data = [];

    protected function render()
    {
        $merge['title'] = $this->title ? $this->title : '';
        $merge['longtitle'] = $this->longtitle ? $this->longtitle : '';

        if($user = auth()->user()){
            $merge['is_megaroot'] = $this->is_megaroot = auth()->user()->hasRole('megaroot');
        }else{
            $merge['is_megaroot'] = null;
        }

        return view($this->view, $this->data, $merge);
    }
}
