<?php

namespace App\Http\Controllers\Delivery;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller {

    protected $response = [];

    public function index(Request $request)
    {
        if($type = $request->get('type')){
            switch ($type){
                case 'categories':
                    $this->getCategories();
                    break;
            }
        }else{
            $this->response = 'Type not exist!';
        }

        //$this->getCategories();

        return response()->json($this->response);
    }

    protected function getCategories()
    {
        $categories = Category::all();

        $this->response = $categories->map(function ($category){
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
    }
}
