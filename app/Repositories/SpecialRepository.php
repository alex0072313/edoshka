<?php

namespace App\Repositories;

use Image;
use Storage;

abstract class SpecialRepository extends Repository
{

    public static function createImage($imgfile, $special){

        $sizes = getimagesize($imgfile);
        $img = Image::make($imgfile);

        //origin
        if(($sizes[0] > 1920) || ($sizes[1] > 1080)){
            $img->fit(1920, 1080, function ($constraint) {
                $constraint->upsize();
            });
        }

        Storage::disk('public')->put('special_imgs/'.$special->id.'/src.jpg', (string) $img->encode());

        $img->fit(236, 228, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('special_imgs/'.$special->id.'/img_m.jpg', (string) $img->encode());

        $img->fit(120, 120, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('special_imgs/'.$special->id.'/img_s.jpg', (string) $img->encode());

        $img->fit(36, 36, function ($constraint) {
            $constraint->upsize();
        });
        Storage::disk('public')->put('special_imgs/'.$special->id.'/img_xs.jpg', (string) $img->encode());

    }

}
