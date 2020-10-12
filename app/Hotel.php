<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    protected $guarded = [];
    protected $with = ['images'];

    public function rooms() {
        return $this->hasMany('App\Room');
    }

    public function images() {
        return $this->morphMany('App\Image', 'imageable');
    }
}
