<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preventive extends Model
{
    protected $guarded = [];

    public function appointment(){
    	return $this->belongsTo(Appointment::class);
    }
    
}
