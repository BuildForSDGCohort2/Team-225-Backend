<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $guarded = [];
    protected $table = 'hotel_booking';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }
}
