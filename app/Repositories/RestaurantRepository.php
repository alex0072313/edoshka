<?php

namespace App\Repositories;

use Image;
use Storage;

abstract class RestaurantRepository extends Repository
{
    public static function createThumb($imgfile, $restaurant){

        $sizes = getimagesize($imgfile);
        $img = Image::make($imgfile);

        //origin
        if(($sizes[0] > 1920) || ($sizes[1] > 1080)){
            $img->fit(1920, 1080, function ($constraint) {
                $constraint->upsize();
            });
        }
        Storage::disk('public')->put('restaurant_imgs/'.$restaurant->id.'/src.jpg', (string) $img->encode());

        $img->fit(220, 220, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('restaurant_imgs/'.$restaurant->id.'/thumb_m.jpg', (string) $img->encode());

        $img->fit(120, 120, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('restaurant_imgs/'.$restaurant->id.'/thumb_s.jpg', (string) $img->encode());

        $img->fit(36, 36, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg', (string) $img->encode());

    }

}