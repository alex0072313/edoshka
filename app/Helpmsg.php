<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpmsg extends Model
{
    protected $table = 'helpmsg';

    protected $guarded = ['id'];

    public $timestamps = false;

    public static function getByPage($page){
        $data = [];

        $r = self::all()->where('page', $page);

        if($page != 'site-home'){
            $r = $r->merge(self::all()->where('page', '=', 'site-home'));
        }

        foreach ($r->toArray() as $config){
            $data[$config['name']] = $config;
        }
        return $data;
    }

    public static function getByName($name){
        return self::where('name', $name)->first();
    }
}
