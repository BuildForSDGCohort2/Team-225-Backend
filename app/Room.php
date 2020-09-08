<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function hotel() {
        return $this->belongsTo('App\Hotel');
    }

    public function images() {
        return $this->morphMany('App\Image', 'imageable');
    }

}
