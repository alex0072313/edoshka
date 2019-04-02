<?php

namespace App\Repositories;

use Image;
use Storage;

abstract class DishRepository extends Repository
{

    public static function createImage($imgfile, $dish){

        $sizes = getimagesize($imgfile);
        $img = Image::make($imgfile);

        //origin
        if(($sizes[0] > 1920) || ($sizes[1] > 1080)){
            $img->fit(1920, 1080, function ($constraint) {
                $constraint->upsize();
            });
        }
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/src.jpg', (string) $img->encode());

//        $img->fit(539, 512, function ($constraint) {
//            $constraint->upsize();
//        });
        $img->resize(539, 512, function($img) {
            $img->aspectRatio();
            $img->upsize();
        })->resizeCanvas(539, 512, 'center', false, '#ffffff');
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/img_l.jpg', (string) $img->encode());

//        $img->fit(236, 228, function ($constraint) {
//            $constraint->upsize();
//        });
        $img->resize(236, 228, function($img) {
            $img->aspectRatio();
            $img->upsize();
        })->resizeCanvas(236, 228, 'center', false, '#ffffff');
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/img_m.jpg', (string) $img->encode());

//        $img->fit(120, 120, function ($constraint) {
//            $constraint->upsize();
//        });
        $img->resize(120, 120, function($img) {
            $img->aspectRatio();
            $img->upsize();
        })->resizeCanvas(120, 120, 'center', false, '#ffffff');
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/img_s.jpg', (string) $img->encode());

//        $img->fit(60, 60, function ($constraint) {
//            $constraint->upsize();
//        });
        $img->resize(60, 60, function($img) {
            $img->aspectRatio();
            $img->upsize();
        })->resizeCanvas(60, 60, 'center', false, '#ffffff');
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/img_xs.jpg', (string) $img->encode());

//        $img->fit(36, 36, function ($constraint) {
//            $constraint->upsize();
//        });


        $img->resize(36, 36, function($img) {
            $img->aspectRatio();
            $img->upsize();
        })->resizeCanvas(36, 36, 'center', false, '#ffffff');
        Storage::disk('public')->put('dish_imgs/'.$dish->id.'/img_xxs.jpg', (string) $img->encode());

    }

}
