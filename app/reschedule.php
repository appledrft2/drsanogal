<?php

namespace App;

use App\Appointment;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    protected $guarded = [];

    public function appointment(){
    	return $this->belongsTo(Appointment::class);
    }
}
