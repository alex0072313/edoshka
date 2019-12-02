<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'name2', 'name3', 'alias', 'town_id'];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
