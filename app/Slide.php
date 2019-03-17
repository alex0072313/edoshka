<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['title', 'image', 'href', 'pos'];

    public function delete()
    {
        \Storage::disk('public')->deleteDirectory('slide_imgs/'.$this->id);
        return parent::delete();
    }
}
