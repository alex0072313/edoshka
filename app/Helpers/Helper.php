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

if (!function_exists('valid_phone')) {

    function valid_phone($phone = '', $prefix = '+7')
    {
        preg_match_all('!\d+!', $phone, $matches);
        $phone = implode('', $matches[0]);
        if(strlen($phone) == 11){
            return $prefix.substr($phone, 1);
        }
        return null;
    }

}

if (!function_exists('send_sms')) {

    function send_sms($text, $phone)
    {
        $client = new \Twilio\Rest\Client(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));
        $client->messages->create(
            $phone,
            array(
                'from' => getenv('TWILIO_FROM_PHONE'),
                'body' => $text
            )
        );
    }

}

