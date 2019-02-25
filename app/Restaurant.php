<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
