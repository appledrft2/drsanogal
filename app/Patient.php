<?php

namespace App;

use App\User;
use App\Client;
use App\Appointment;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function client(){
    	return $this->belongsTo(Client::class);
    }
    public function appointments(){
    	return $this->hasMany(Appointment::class);
    }
}
