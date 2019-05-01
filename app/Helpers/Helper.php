<?php
if (!function_exists('qs_url')) {

    function qs_url($path = null, $qs = array(), $secure = null)
    {

        if(\Illuminate\Support\Facades\Route::has($path)){
            $path = route($path);
        }

        $url = app('url')->to($path, $secure);
        if (count($qs)){

            foreach($qs as $key => $value){
                $qs[$key] = sprintf('%s=%s',$key, urlencode($value));
            }
            $url = sprintf('%s?%s', $url, implode('&', $qs));
        }
        return $url;
    }

}
