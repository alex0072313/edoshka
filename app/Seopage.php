<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seopage extends Model
{
    protected $table = 'seopages';

    protected $fillable = ['url', 'title', 'description', 'keywords'];
    public $timestamps = false;

}
