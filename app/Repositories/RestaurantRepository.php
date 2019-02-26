<?php

namespace App\Repositories;

use Image;
use Storage;

abstract class RestaurantRepository extends Repository
{
    public static function createThumb($imgfile, $restaurant){
        $img = Image::make($imgfile);

        //origin
        Storage::disk('public')->put('restaurant_imgs/'.$restaurant->id.'/src.jpg', (string) $img->encode());

        $img->fit(220, 106, function ($constraint) {
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