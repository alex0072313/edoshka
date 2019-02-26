<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'address', 'description'
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
