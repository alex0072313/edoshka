<?php

namespace App\Http\Controllers\Delivery;

use App\Category;
use App\Dish;
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
                case 'products':
                    $this->getProducts($request->get('cat_id'));
                break;
            }
        }else{
            $this->response = 'Type not exist!';
        }

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

    protected function getProducts($cat_id)
    {
        $products = Category::find($cat_id)->dishes;

        $this->response = $products->map(function ($product){
            return [
                'id' => $product->id,
                'name' => $product->name,
            ];
        });
    }
}
