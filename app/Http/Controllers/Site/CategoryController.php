<?php

namespace App\Http\Controllers\Site;

use App\Category;

class CategoryController extends SiteController
{
    public function index(Category $category)
    {
        $this->view = 'site.category';
        $this->data['category'] = $category;

        $this->data['restaurants'] = $this->town->restaurants->filter(function ($restaurant) use ($category){
            $restaurant->dishes = $restaurant->dishes->filter(function ($dish) use ($category){
                return $dish->category_id == $category->id ? $dish : false;
            });
            return count($restaurant->dishes) ? $restaurant : false;
        });

        return $this->render();
    }
}
