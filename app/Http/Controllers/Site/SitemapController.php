<?php

namespace App\Http\Controllers\Site;

use App\Article;
use App\Category;
use App\Restaurant;

class SitemapController extends SiteController
{

    public function index()
    {
        $sitemap = \App::make('sitemap');
        //$sitemap->setCache('site.sitemap', 60);

        //if (!$sitemap->isCached()) {

            $categories = Category::all()->sortBy('created_at');

            $sitemap->add(route('site.home'), $categories->max('updated_at'), '1.0', 'monthly');
            foreach ($categories as $category) {
                $images = [];
                if(\Storage::disk('public')->exists('category_imgs/'.$category->id.'/src.jpg')){
                    $images = [
                        ['url' => \Storage::disk('public')->url('category_imgs/'.$category->id.'/src.jpg'), 'title' => $category->name],
                    ];
                }
                $sitemap->add(route('site.category', $category->alias), $category->updated_at, '1.0', 'daily', $images);
            }

            $restaurants = Restaurant::all()->sortBy('created_at');

            foreach ($restaurants as $restaurant) {
                $images = [];
                if(\Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/src.jpg')){
                    $images = [
                        ['url' => \Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg'), 'title' => $restaurant->name],
                    ];
                }
                $sitemap->add(route('site.restaurant', $restaurant->alias), $restaurant->updated_at, '0.9', 'monthly', $images);
            }
        //}

        return $sitemap->render('xml');
    }
}
