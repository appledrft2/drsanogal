<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function patient(){
    	return $this->belongsTo(Patient::class);
    }

    public function preventives(){
    	return $this->hasMany(Preventive::class);
    }
}
