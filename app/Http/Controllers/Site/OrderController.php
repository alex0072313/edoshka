<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function send()
    {
        return response()->json(request()->all());
    }
}
